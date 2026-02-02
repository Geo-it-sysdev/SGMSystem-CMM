<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('tcpdf');
    }

public function generate_report_card()
{
    $grade = $this->input->get('grade');
    $section = $this->input->get('section');

    $students = $this->fetch_students_report_card($grade, $section)['data'];

    // Init PDF with custom header
    $pdf = new class extends TCPDF {
        public $runningDate;

        public function Header() {
            $currentDate = date('Y-m-d');
            $html = '
            <br><br>
            <table style="width:100%; font-style:italic; color:grey; font-size:7px; padding:0; margin:0;">
                <tr>
                    <td style="text-align:left;">Running Date: ' . $this->runningDate . '</td>
                    <td style="text-align:right;">Page ' . $this->getAliasNumPage() . ' of ' . $this->getAliasNbPages() . '</td>
                </tr>
            </table>
            <p style="text-align:center; margin:0; padding:0; font-size:10px">
                <strong>STUDENT GRADING MANAGEMENT SYSTEM</strong><br>
                <strong>GENERATE REPORT </strong><br>
                <strong>' . strtoupper(date("F d, Y", strtotime($currentDate))) . '</strong>
            </p>
            ';
            $this->writeHTML($html, true, false, false, false, '');
        }
    };

    $pdf->runningDate = date('Y-m-d H:i:s');

    $pdf->SetCreator('School System');
    $pdf->SetAuthor('School Admin');
    $pdf->SetTitle('Student Report Cards');
    $pdf->setPrintHeader(true);
    $pdf->setPrintFooter(false);

    $pdf->SetMargins(10, 35, 10); // leave space for header
    $pdf->SetAutoPageBreak(TRUE, 15);
    $pdf->SetFont('helvetica', '', 10);

    $pdf->AddPage('L', 'A4'); // A4 landscape

    // Table HTML with percentage widths
    $html = '
    <table cellspacing="0" cellpadding="3" style="width:100%; border-collapse: collapse;" border="1">
        <thead>
            <tr style="background-color: #ccc; font-weight: bold; text-align: center;">
                <th style="width:18%;">Student Name</th>
                <th style="width:10%;">Section</th>
                <th style="width:25%;">Subject</th>
                <th style="width:12%;">1st Q</th>
                <th style="width:12%;">2nd Q</th>
                <th style="width:12%;">3rd Q</th>
                <th style="width:11%;">4th Q</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($students as $student) {
        $studentReport = $this->fetch_final_average($student['student_name'], $student['grade_level'], $student['section']);
        $data = $studentReport['data'];
        $rowspan = count($data);

        $firstRow = true;
        foreach ($data as $row) {
            $html .= '<tr>';
            if ($firstRow) {
                $html .= '<td rowspan="' . $rowspan . '" style="width:18%;">' . $student['student_name'] . '</td>';
                $html .= '<td rowspan="' . $rowspan . '" style="width:10%; text-align:center;">' . $student['section'] . '</td>';
                $firstRow = false;
            }
            $html .= '<td style="width:25%;">' . $row['subject'] . '</td>';
            $html .= '<td style="width:12%; text-align:center;">' . $row['q1'] . '</td>';
            $html .= '<td style="width:12%; text-align:center;">' . $row['q2'] . '</td>';
            $html .= '<td style="width:12%; text-align:center;">' . $row['q3'] . '</td>';
            $html .= '<td style="width:11%; text-align:center;">' . $row['q4'] . '</td>';
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('report_cards.pdf', 'I');
}



    // --- Fetch students ---
    private function fetch_students_report_card($grade=null, $section=null)
    {
        $this->db->select('fullname AS student_name, grade_level, section, created_at');
        $this->db->from('tbl_students');
        if (!empty($grade)) $this->db->where('grade_level', $grade);
        if (!empty($section)) $this->db->where('section', $section);
        $query = $this->db->get();
        return ['data'=>$query->result_array()];
    }

    // --- Fetch grades ---
    private function fetch_final_average($student_name, $grade_level, $section)
    {
        $user_id   = $this->session->userdata('po_user');      
        $user_type = $this->session->userdata('user_type');

        // Weight rules
        if (in_array($grade_level, ['Grade 7','Grade 8','Grade 9','Grade 10'])) {
            $weight_WW = 0.30; $weight_PT = 0.50; $weight_QA = 0.20;
        } else {
            $weight_WW = 0.25; $weight_PT = 0.50; $weight_QA = 0.25;
        }

        $this->db->select('a.subject, a.quarter, a.description AS activity_type, a.overall AS overall_score, b.score, d.full_name AS teacher, c.created_at');
        $this->db->from('tbl_activities_header AS a');
        $this->db->join('tbl_activities_lines AS b','b.activities_id_header = a.id','left');
        $this->db->join('tbl_students AS c','c.id = b.student_id','left');
        $this->db->join('tbl_users AS d','d.id = a.user_id','left');
        $this->db->where('a.grade_level', $grade_level);
        $this->db->where('b.student_name', $student_name);
        $this->db->where('b.section', $section);
        $this->db->where('c.status', 'active');
        if (!in_array($user_type, ['Principal','Registrar','Guidance Councilor','Admin'])) {
            $this->db->where('a.user_id', $user_id);
        }

        $query = $this->db->get()->result();

        $subjects = [];
        foreach($query as $row){
            if(!isset($subjects[$row->subject])){
                $subjects[$row->subject] = ['WW'=>[],'PT'=>[],'QA'=>[]];
            }
            switch($row->activity_type){
                case 'Written Works': $subjects[$row->subject]['WW'][] = $row; break;
                case 'Performance Task': $subjects[$row->subject]['PT'][] = $row; break;
                case 'Quarterly Assessment': $subjects[$row->subject]['QA'][] = $row; break;
            }
        }

        $data = [];
        foreach($subjects as $subject => $subData){
            $finalGradesPerQuarter = [];
            foreach(['1st Quarter','2nd Quarter','3rd Quarter','4th Quarter'] as $quarter){
                $WW_total = $WW_overall = 0;
                foreach($subData['WW'] as $w){ if($w->quarter==$quarter){ $WW_total+=$w->score; $WW_overall+=$w->overall_score; } }
                $WW_percent = $WW_overall ? ($WW_total/$WW_overall*100) : 0;

                $PT_total = $PT_overall = 0;
                foreach($subData['PT'] as $p){ if($p->quarter==$quarter){ $PT_total+=$p->score; $PT_overall+=$p->overall_score; } }
                $PT_percent = $PT_overall ? ($PT_total/$PT_overall*100) : 0;

                $QA_total = $QA_overall = 0;
                foreach($subData['QA'] as $qTask){ if($qTask->quarter==$quarter){ $QA_total+=$qTask->score; $QA_overall+=$qTask->overall_score; } }
                $QA_percent = $QA_overall ? ($QA_total/$QA_overall*100) : 0;

                $finalQuarter = ($WW_percent*$weight_WW)+($PT_percent*$weight_PT)+($QA_percent*$weight_QA);
                $finalGradesPerQuarter[] = round($finalQuarter,2);
            }

            if(($finalGradesPerQuarter[0]>0 || $finalGradesPerQuarter[1]>0) || ($finalGradesPerQuarter[2]>0 || $finalGradesPerQuarter[3]>0)){
                $data[] = [
                    'subject' => $subject,
                    'q1' => $finalGradesPerQuarter[0],
                    'q2' => $finalGradesPerQuarter[1],
                    'q3' => $finalGradesPerQuarter[2],
                    'q4' => $finalGradesPerQuarter[3],
                    'final_grade' => round(array_sum($finalGradesPerQuarter)/4,2),
                    'created_at' => !empty($query) ? $query[0]->created_at : null
                ];
            }
        }

        $school_year_start = !empty($query) ? date('Y', strtotime($query[0]->created_at)) : date('Y');

        return ['data'=>$data,'school_year_start'=>$school_year_start];
    }
}
