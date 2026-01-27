<style>
#studentTableG8 tbody tr td {
    color: #212529 !important;
    opacity: 1 !important;
}

#studentTableG8 thead th {
    color: #000 !important;
    font-weight: 600;
}

#studentTableG8 .btn {
    opacity: 1 !important;
}
</style>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">





        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Final Grades</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Final Grades</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="border">
                                    <!-- NAV PILLS -->
                                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3 flex-wrap">
                                        <?php
                                            $all_grades = ['Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
                                            $active_set = false;

                                            foreach ($all_grades as $grade):
                                                if (in_array('All',$grade_levels) || in_array($grade,$grade_levels)):
                                                    $grade_id = strtolower(str_replace(' ','',$grade));
                                                    $active_class = (!$active_set)?'active':'';
                                                    $active_set = true;
                                            ?>
                                        <li class="nav-item">
                                            <a href="#<?= $grade_id ?>-student" data-bs-toggle="tab"
                                                class="nav-link <?= $active_class ?>">
                                                <?= $grade ?> Final Grades
                                            </a>
                                        </li>
                                        <?php endif; endforeach; ?>
                                    </ul>

                                    <!-- TAB CONTENT -->
                                    <div class="tab-content">
                                        <?php
                    $tab_first = true;
                    foreach ($all_grades as $grade):
                        if (in_array('All',$grade_levels) || in_array($grade,$grade_levels)):
                            $grade_id = strtolower(str_replace(' ','',$grade));
                            $show_class = $tab_first?'show active':'';
                            $tab_first = false;
                    ?>
                                        <div class="tab-pane fade <?= $show_class ?>" id="<?= $grade_id ?>-student">
                                            <div class="card p-3">
                                                <h5 class="mb-3"><?= $grade ?> Grading</h5>
                                                <?php if($is_admin || $grade_levels): ?>

                                                <?php endif; ?>
                                                <table id="activityTable_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle activityTable"
                                                    style="width:100%">

                                                    <thead>
                                                        <tr>
                                                            <th>Grade Level</th>
                                                            <th>Teacher </th>
                                                            <th>Section </th>
                                                            <th>Subjects</th>
                                                            <th>Quarter</th>
                                                            <?php if($is_admin || $grade_levels): ?><th>Action</th>
                                                            <?php endif; ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php endif; endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end container-fluid -->
            </div> <!-- end page-content -->
        </div> <!-- end main-content -->




        <!-- Final Grades Modal -->
        <div class="modal fade" id="finalGradesModal" tabindex="-1" aria-labelledby="finalGradesModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Final Grades</h5>
                         
                    </div>
                    <br>

                  <div class="ms-4"> 
                    <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3" id="sectionTabs" role="tablist">
                    </ul>
                </div>


                    <div class="modal-body">
                        <div class="row mb-3 equal-width">
                            <div class="col"> <label for="grade_level" class="form-label">Grade Level</label> <input
                                    type="text" id="grade_level" name="grade_level" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;"> </div>
                            <div class="col"> <label for="quarter" class="form-label">Quarter</label> <input type="text"
                                    id="quarter" name="quarter" class="form-control underline-input" autocomplete="off"
                                    readonly style="text-align:center;"> </div>
                            <div class="col"> <label for="subjects" class="form-label">Subjects</label> <input
                                    type="text" id="subjects" name="subjects" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;"> </div>
                            <div class="col"> <label for="full_name" class="form-label">Teacher</label> <input
                                    type="text" id="full_name" name="full_name" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;"> </div>
                        </div> <!-- Grades Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%" id="finalGradesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student</th>
                                        <th>Section</th>
                                        <th>Final Grades</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btnPrintFinalStudentGrades">Print</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Grades Student Modal -->
        <div class="modal fade" id="studentDetailsModal" tabindex="-1" aria-labelledby="studentDetailsModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Student Details Grades</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 equal-width">
                            <div class="col"> <label for="student" class="form-label">Student</label> <input type="text"
                                    id="student" name="student" class="form-control underline-input" autocomplete="off"
                                    readonly style="text-align:center;"> </div>
                            <div class="col"> <label for="quarters" class="form-label">Quarter</label> <input
                                    type="text" id="quarters" name="quarters" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;"> </div>
                            <div class="col"> <label for="final_grades" class="form-label">Final Grades</label> <input
                                    type="text" id="final_grades" name="final_grades"
                                    class="form-control underline-input" autocomplete="off" readonly
                                    style="text-align:center;"> </div>
                            <div class="col"> <label for="subject" class="form-label">Subject</label> <input type="text"
                                    id="subject" name="subject" class="form-control underline-input" autocomplete="off"
                                    readonly style="text-align:center;"> </div>
                        </div> <!-- Grades Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%" id="studentFinalGradesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date Activity</th>
                                        <th>Activity Type</th>
                                        <th>Description</th>
                                        <th>Score Overall </th>
                                        <th>Score</th>
                                        <th>Score Ratings (%)</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row mb-3 equal-width">
                            <div class="col"> <label for="total_written_works" class="form-label">Total Score / Overall
                                    - Written
                                    Works</label> <input type="text" id="total_written_works" name="total_written_works"
                                    class="form-control underline-input" autocomplete="off" readonly
                                    style="text-align:center;"> </div>
                            <div class="col"> <label for="total_performance_task" class="form-label">Total Score /
                                    Overall
                                    - Performance
                                    Task</label> <input type="text" id="total_performance_task"
                                    name="total_performance_task" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;"> </div>
                            <div class="col"> <label for="total_quarterly_assessment" class="form-label">Total Score /
                                    Overall
                                    - Quarterly
                                    Assessment</label> <input type="text" id="total_quarterly_assessment"
                                    name="total_quarterly_assessment" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;"> </div>
                            <input type="hidden" id="section">
                            <input type="hidden" id="teacher">

                        </div> <!-- Grades Table -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btnPrintFinalGrades">Print</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>





        <script>
        $(document).ready(function() {
            let isSwitchingModal = false;
let finalGradesTableInstance = null;

            // Initialize all activity tables
            $('.activityTable').each(function() {
                let table = $(this);
                let grade_id = table.attr('id').replace('activityTable_', '');
                let grade_name = grade_id.replace(/([a-z]+)([0-9]+)/i, function(_, p1, p2) {
                    return p1.charAt(0).toUpperCase() + p1.slice(1) + ' ' + p2;
                });

                table.DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    processing: true,
                    ajax: {
                        url: "<?= site_url('StudentController/fetch_activities'); ?>",
                        type: 'POST',
                        data: {
                            grade_level: grade_name
                        },
                        dataSrc: 'data',
                        cache: false // prevent caching
                    },
                    columns: [{
                            data: 'grade_level'
                        },
                        {
                            data: 'full_name'
                        },
                        {
                            data: 'section'
                        },
                        {
                            data: 'subject'
                        },
                        {
                            data: 'quarter'
                        },
                        <?php if($is_admin || $grade_levels): ?> {
                            data: 'id',
                            render: function(data, type, row) {
                                return `<button class="btn btn-sm btn-outline-info viewBtn" 
                        data-id="${data}" 
                        data-section="${row.section}" 
                        data-subject="${row.subject}" 
                        data-quarter="${row.quarter}" 
                        data-full_name="${row.full_name}" 
                        data-grade_level="${row.grade_level}">
                        <i class="ri-eye-line"></i> Grades Details
                    </button>`;
                            },
                            orderable: false,
                            searchable: false
                        }
                        <?php endif; ?>
                    ],
                    order: [
                        [5, 'desc']
                    ], // Sort by activity_date descending
                    destroy: true
                });
            });


            // Reload table on tab switch
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let target = $(e.target).attr('href').replace('#', '').replace('-student', '');
                let table = $('#activityTable_' + target);
                if ($.fn.DataTable.isDataTable(table)) {
                    table.DataTable().ajax.reload(null, false);
                }
            });

           $(document).on('click', '.viewBtn', function () {
            let section = $(this).data('section'); // e.g., "A | B | C"
            let subject = $(this).data('subject');
            let quarter = $(this).data('quarter');
            let grade_level = $(this).data('grade_level');
            let full_name = $(this).data('full_name');

            // Fill modal inputs
            $('#grade_level').val(grade_level);
            $('#quarter').val(quarter);
            $('#subjects').val(subject);
            $('#full_name').val(full_name);

            // Destroy existing table if exists
            if ($.fn.DataTable.isDataTable('#finalGradesTable')) {
                $('#finalGradesTable').DataTable().destroy();
            }
            $('#finalGradesTable tbody').empty();

            // Create section tabs dynamically, sorted alphabetically
            let sectionsArr = section.split(' | ').sort();
            let tabsHtml = '';
            sectionsArr.forEach((sec, index) => {
                tabsHtml += `
                    <li class="nav-item">
                        <a class="nav-link ${index === 0 ? 'active' : ''}" data-section="${sec}" href="#" role="tab">${sec}</a>
                    </li>
                `;
            });
            $('#sectionTabs').html(tabsHtml);

            // Initialize DataTable
            let finalGradesTableInstance = $('#finalGradesTable').DataTable({
                ajax: {
                    url: "<?= site_url('StudentController/fetch_final_grades'); ?>",
                    type: 'POST',
                    data: {
                        section: sectionsArr.join(' | '), // send all sections
                        subject,
                        quarter,
                        grade_level
                    },
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'student_name' },
                    { data: 'section' },
                    { data: 'final_grade' },
                    {
                        data: 'remarks',
                        render: function (data) {
                            let badgeClass = 'bg-secondary';
                            if (data === "Outstanding") badgeClass = "bg-success";
                            else if (data === "Very Satisfactory") badgeClass = "bg-primary";
                            else if (data === "Satisfactory") badgeClass = "bg-info";
                            else if (data === "Fair") badgeClass = "bg-warning text-dark";
                            else if (data === "Did Not Meet Expectations") badgeClass = "bg-danger";
                            else if (data === "Failure") badgeClass = "bg-dark";
                            return `<span class="badge ${badgeClass}">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function (d) {
                            return `<button class="btn btn-sm btn-outline-primary viewDetailsBtn"
                                data-student_name="${d.student_name}"
                                data-section="${d.section}"
                                data-subject="${subject}"
                                data-quarter="${quarter}"
                                data-full_name="${full_name}"
                                data-grade_level="${grade_level}"
                                data-final_grade="${d.final_grade}">
                                <i class="bi bi-journal-text"></i> View Details
                            </button>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                paging: true,
                searching: true,
                initComplete: function() {
                    // Automatically filter DataTable by the active tab on load
                    let activeSection = $('#sectionTabs .nav-link.active').data('section');
                    finalGradesTableInstance.column(1).search('^' + activeSection + '$', true, false).draw();
                }
            });

            // Filter table when tab clicked
            $(document).off('click', '#sectionTabs .nav-link').on('click', '#sectionTabs .nav-link', function(e) {
                e.preventDefault();
                $('#sectionTabs .nav-link').removeClass('active');
                $(this).addClass('active');

                let selectedSection = $(this).data('section');
                finalGradesTableInstance.column(1).search('^' + selectedSection + '$', true, false).draw();
            });

            // Show modal
            $('#finalGradesModal').modal('show');
        });




            // Print button click
            $(document).on('click', '#btnPrintFinalStudentGrades', function() {
                let subject = $('#subjects').val();
                let quarter = $('#quarter').val();
                let grade_level = $('#grade_level').val();
                let full_name = $('#full_name').val();

                let table = $('#finalGradesTable').DataTable();
                let data = table.rows({
                    search: 'applied'
                }).data();

                let printWindow = window.open('', '', 'height=600,width=900');

                printWindow.document.write('<html><head><title>Student Report Grades</title>');
                printWindow.document.write('<style>');
                printWindow.document.write('body{font-family: Arial, sans-serif;}');
                printWindow.document.write('h2{text-align: center;}');
                printWindow.document.write(
                    'table{width: 100%; border-collapse: collapse; margin-top: 20px;}');
                printWindow.document.write(
                    'th, td{border: 1px solid #000; padding: 8px; text-align: left;}');
                printWindow.document.write('th{background-color: #f2f2f2;}');
                printWindow.document.write(
                    '.header-table td{border: none; padding: 4px;}'); // No border for header
                printWindow.document.write('</style>');
                printWindow.document.write('</head><body>');

                printWindow.document.write('<h2>Students Grades Report </h2>');

                // Header with left/right alignment
                printWindow.document.write('<table class="header-table">');
                printWindow.document.write('<tr>');
                printWindow.document.write('<td style="text-align:left;">Subject: ' + subject +
                    '</td>');
                printWindow.document.write('<td style="text-align:right;">Quarter: ' + quarter +
                    '</td>');
                printWindow.document.write('</tr>');
                printWindow.document.write('<tr>');
                printWindow.document.write('<td style="text-align:left;">Teacher: ' + full_name +
                    '</td>');
                printWindow.document.write('<td style="text-align:right;">Grade Level: ' + grade_level +
                    '</td>');
                printWindow.document.write('</tr>');
                printWindow.document.write('</table>');

                // Main data table
                printWindow.document.write('<table>');
                printWindow.document.write(
                    '<thead><tr><th>Student Name</th><th>Section</th><th>Final Grades</th><th>Remarks</th></tr></thead>'
                );
                printWindow.document.write('<tbody>');

                for (let i = 0; i < data.length; i++) {
                    printWindow.document.write('<tr>');
                    printWindow.document.write('<td>' + data[i].student_name + '</td>');
                    printWindow.document.write('<td>' + data[i].section + '</td>');
                    printWindow.document.write('<td>' + data[i].final_grade + '</td>');
                    printWindow.document.write('<td>' + data[i].remarks + '</td>');
                    printWindow.document.write('</tr>');
                }

                printWindow.document.write('</tbody></table>');

                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });



            $(document).on('click', '.viewDetailsBtn', function() {
                let student_name = $(this).data('student_name');
                let section = $(this).data('section');
                let subject = $(this).data('subject');
                let quarter = $(this).data('quarter');
                let full_name = $(this).data('full_name');
                let grade_level = $(this).data('grade_level');
                let final_grade = $(this).data('final_grade');

                // Fill modal inputs
                $('#student').val(student_name);
                $('#quarters').val(quarter);
                $('#final_grades').val(final_grade);
                $('#subject').val(subject);
                $('#section').val(section);
                $('#full_name').val(full_name);


                // Destroy existing table if it exists
                if ($.fn.DataTable.isDataTable('#studentFinalGradesTable')) {
                    $('#studentFinalGradesTable').DataTable().clear().destroy();
                }
                $('#studentFinalGradesTable tbody').empty();

                // Fetch student activity details
                let table = $('#studentFinalGradesTable').DataTable({
                    ajax: {
                        url: "<?= site_url('StudentController/fetch_student_details'); ?>",
                        type: 'POST',
                        data: {
                            student_name: student_name,
                            section: section,
                            subject: subject,
                            quarter: quarter,
                            grade_level: grade_level
                        },
                        dataSrc: 'data'
                    },
                    columns: [{
                            data: 'activity_date'
                        },
                        {
                            data: 'activity_type'
                        },
                        {
                            data: 'description',
                            render: function(data, type, row) {

                                let percentage = '';
                                let bgClass = '';

                                let gradeNum = parseInt(row.grade_level.replace(
                                    "Grade ", ""));

                                let written = '30%';
                                let performance = '50%';
                                let quarterly = '20%';

                                if (gradeNum >= 11) {
                                    written = '25%';
                                    performance = '50%';
                                    quarterly = '25%';
                                }

                                if (data === 'Written Works') {
                                    bgClass = 'bg-primary text-white';
                                    percentage = `(${written})`;
                                } else if (data === 'Performance Task') {
                                    bgClass = 'bg-success text-white';
                                    percentage = `(${performance})`;
                                } else if (data === 'Quarterly Assessment') {
                                    bgClass = 'bg-warning text-dark';
                                    percentage = `(${quarterly})`;
                                }

                                return `<span class="badge ${bgClass}">${data} ${percentage}</span>`;
                            }
                        },
                        {
                            data: 'overall'
                        },
                        {
                            data: 'score'
                        },
                        {
                            data: 'ratings'
                        },
                        {
                            data: 'remarks',
                            render: function(data) {
                                if (data === "Passed") {
                                    return `<span class="badge bg-success">${data}</span>`;
                                } else {
                                    return `<span class="badge bg-danger">${data}</span>`;
                                }
                            }
                        }

                    ],
                    order: [
                        [0, 'desc'],
                        [1, 'desc']
                    ],
                    responsive: true,
                    paging: true,
                    searching: true,
                    destroy: true,
                    drawCallback: function(settings) {
                        // Initialize totals
                        let totalWrittenScore = 0,
                            totalWrittenOverall = 0,
                            totalPerformanceScore = 0,
                            totalPerformanceOverall = 0,
                            totalQuarterlyScore = 0,
                            totalQuarterlyOverall = 0;

                        // Sum scores and overalls per activity type
                        this.api().rows().data().each(function(row) {
                            let score = parseFloat(row.score) || 0;
                            let overall = parseFloat(row.overall) || 0;

                            if (row.description === 'Written Works') {
                                totalWrittenScore += score;
                                totalWrittenOverall += overall;
                            } else if (row.description === 'Performance Task') {
                                totalPerformanceScore += score;
                                totalPerformanceOverall += overall;
                            } else if (row.description === 'Quarterly Assessment') {
                                totalQuarterlyScore += score;
                                totalQuarterlyOverall += overall;
                            }
                        });

                        // Helper function to format number: remove decimal if integer
                        function formatNumber(n) {
                            return Number.isInteger(n) ? n : n.toFixed(2);
                        }

                        // Display totals as score / overall
                        $('#total_written_works').val(
                            `${formatNumber(totalWrittenScore)} / ${formatNumber(totalWrittenOverall)}`
                        );
                        $('#total_performance_task').val(
                            `${formatNumber(totalPerformanceScore)} / ${formatNumber(totalPerformanceOverall)}`
                        );
                        $('#total_quarterly_assessment').val(
                            `${formatNumber(totalQuarterlyScore)} / ${formatNumber(totalQuarterlyOverall)}`
                        );
                    }

                });

               isSwitchingModal = true;
                $('#finalGradesModal').modal('hide');
                $('#studentDetailsModal').modal('show');


            });






            $(document).on('click', '#btnPrintFinalGrades', function() {
                // Student info
                let studentName = $('#student').val();
                let quarter = $('#quarters').val();
                let section = $('#section').val();
                let full_name = $('#full_name').val();
                let subject = $('#subject').val();
                let finalGrade = $('#final_grades').val();

                // Reference DataTable
                let table = $('#studentFinalGradesTable').DataTable();

                // Build table HTML
                let tableHtml = '<table><thead><tr>';
                table.columns().every(function() {
                    tableHtml += `<th>${$(this.header()).text()}</th>`;
                });
                tableHtml += '</tr></thead><tbody>';

                table.rows({
                    search: 'applied',
                    order: 'applied'
                }).every(function(rowIdx) {
                    tableHtml += '<tr>';
                    table.columns().every(function(colIdx) {
                        let cellData = table.cell(rowIdx, colIdx).render(
                            'display'); // get rendered HTML
                        tableHtml += `<td>${cellData}</td>`;
                    });
                    tableHtml += '</tr>';
                });
                tableHtml += '</tbody></table>';

                // Totals
                let totalWritten = $('#total_written_works').val() || '';
                let totalPerformance = $('#total_performance_task').val() || '';
                let totalQuarterly = $('#total_quarterly_assessment').val() || '';

                // Open print window
                let printWindow = window.open('', '', 'height=900,width=1200');
                printWindow.document.write('<html><head><title>Student Final Grades</title>');
                printWindow.document.write('<style>');
                printWindow.document.write(`
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    h3 { text-align: center; }
                    .header-row { display: flex; justify-content: space-between; margin-bottom: 10px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid black; padding: 5px; text-align: left; }
                    .totals { margin-top: 20px; }
                    .totals p { margin: 5px 0; }
                `);
                printWindow.document.write('</style></head><body>');

                // Header
                printWindow.document.write('<h3>Student Quarter Grades Report</h3>');
                printWindow.document.write('<div class="header-row">');
                printWindow.document.write(
                    `<div><strong>Student Name :</strong> ${studentName}<br><strong>Subject:</strong> ${subject} <br><strong>Section :</strong> ${section}</div>`
                );
                printWindow.document.write(
                    `<div><strong>Quarter :</strong> ${quarter}<br><strong>Final Grades:</strong> ${finalGrade}<br><strong>Teacher:</strong> ${full_name}</div>`
                );
                printWindow.document.write('</div>');

                // Table
                printWindow.document.write(tableHtml);

                // Totals
                printWindow.document.write('<div class="totals">');
                printWindow.document.write(
                    `<p>Total Score/Overall - Written Works : ${totalWritten}</p>`);
                printWindow.document.write(
                    `<p>Total Score/Overall - Performance Task : ${totalPerformance}</p>`);
                printWindow.document.write(
                    `<p>Total Score/Overall - Quarterly Assessment : ${totalQuarterly}</p>`);
                printWindow.document.write('</div>');

                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
            });


            $('#finalGradesModal').on('hidden.bs.modal', function () {
                if (isSwitchingModal) return; 

                // Real close → clean up
                if ($.fn.DataTable.isDataTable('#finalGradesTable')) {
                    $('#finalGradesTable').DataTable().clear().destroy();
                }
                $('#finalGradesTable tbody').empty();
            });


            $('#studentDetailsModal').on('hidden.bs.modal', function () {
                isSwitchingModal = false;

                $('#finalGradesModal').modal('show');

                setTimeout(() => {
                    if (finalGradesTableInstance) {
                        finalGradesTableInstance.columns.adjust().responsive.recalc();
                    }
                }, 200);
            });



        });
        </script>
    </div>
    </div>