<body>

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php
            $user_id = $this->session->userdata("po_user");
            if (isset($user_id)) {
                $user = $this->AuthModel->get_user_by_user_id($user_id);
            }
            ?>

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
                                <h4 class="mb-sm-0">Students Activity</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Activity Setup</li>
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
                                                <?= $grade ?> Report Card
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
                                        <div class="tab-pane fade <?= $show_class ?>" id="<?= $grade_id ?>-student"
                                            data-grade="<?= $grade ?>">
                                            <div class="card p-3">
                                                <h5 class="mb-3"><?= $grade ?> Activity</h5>
                                                <?php if($is_admin || $grade_levels): ?>
                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <?php if ($this->session->userdata('user_type') === 'Admin' || $this->session->userdata('user_type') === 'Registrar' || $this->session->userdata('user_type') === 'Principal'): ?>
                                                    <button type="button"
                                                        class="btn btn-outline-success addActivityBtn rounded-pill btn-border"
                                                        data-bs-toggle="modal" data-bs-target="#ActivityModal"
                                                        data-grade="<?= $grade ?>">
                                                        <i class="ri-add-line align-bottom "></i> Add Activity
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                                <?php endif; ?>

                                                <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3 "
                                                    id="sectionTabs_<?= $grade_id ?>" role="tablist"></ul>


                                                <table id="activityTable_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle activityTable"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Grade Level</th>
                                                            <th>Section</th>
                                                            <th>School Year</th>
                                                            <th>Action</th>
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


        <!-- Final Average per Student Modal -->
        <div class="modal fade" id="finalAverageStudentModal" tabindex="-1"
            aria-labelledby="finalAverageStudentModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Final Average</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 equal-width">
                            <div class="col">
                                <label for="student_name" class="form-label">Student Name</label>
                                <input type="text" id="student_name" name="student_name"
                                    class="form-control underline-input" autocomplete="off" readonly
                                    style="text-align:center;">
                            </div>
                            <div class="col">
                                <label for="student_grade_level" class="form-label">Grade Level</label>
                                <input type="text" id="student_grade_level" name="student_grade_level"
                                    class="form-control underline-input" autocomplete="off" readonly
                                    style="text-align:center;">
                            </div>
                            <div class="col">
                                <label for="final_average" class="form-label">General Average </label>
                                <input type="text" id="final_average" name="final_average"
                                    class="form-control underline-input" autocomplete="off" readonly
                                    style="text-align:center;">
                            </div>
                        </div>

                        <!-- Single table for Grades 7–10 -->
                        <div id="grades7to10TableDiv" class="table-responsive" style="display:none;">
                            <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%" id="grades7to10Table">
                                <thead class="table-light">
                                    <tr>
                                        <th>Subject</th>
                                        <th>1st Quarter</th>
                                        <th>2nd Quarter</th>
                                        <th>3rd Quarter</th>
                                        <th>4th Quarter</th>
                                        <th>Final Average</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <!-- Separate tables for Grades 11–12 -->
                        <div id="grades11to12TableDiv" style="display:none;">
                            <h5>First Semester</h5>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%" id="firstSemesterTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Subject</th>
                                            <th>1st Quarter</th>
                                            <th>2nd Quarter</th>
                                            <th>Final Average</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <h5>Second Semester</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%" id="secondSemesterTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Subject</th>
                                            <th>3rd Quarter</th>
                                            <th>4th Quarter</th>
                                            <th>Final Average</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div class="row mb-3 equal-width mt-3">
                                <div class="col">
                                    <label for="general_average_first_sem" class="form-label">General Average First
                                        Semester</label>
                                    <input type="text" id="general_average_first_sem" name="general_average_first_sem"
                                        class="form-control underline-input" autocomplete="off" readonly
                                        style="text-align:center;">
                                </div>
                                <div class="col">
                                    <label for="general_average_second_sem" class="form-label">General Average Second
                                        Semester</label>
                                    <input type="text" id="general_average_second_sem" name="general_average_second_sem"
                                        class="form-control underline-input" autocomplete="off" readonly
                                        style="text-align:center;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-success btn-border" id="btnPrintFinalAverage">
                            <i class="ri-printer-fill me-1"></i> Print
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">
                            <i class="ri-close-fill me-1"></i> Close
                        </button>

                    </div>
                </div>
            </div>
        </div>



        <script>
        $(document).ready(function() {
            let tables = {};

            function initTable(grade_id, grade_name) {
                let table = $('#activityTable_' + grade_id).DataTable({
                    "processing": true,
                    "serverSide": false,
                    "destroy": true,
                    "ajax": {
                        "url": "<?= base_url('StudentController/fetch_students_report_card') ?>",
                        "type": "GET",
                        "data": {
                            grade: grade_name
                        }
                    },
                    "columns": [{
                            "data": "student_name"
                        },
                        {
                            "data": "grade_level"
                        },
                        {
                            "data": "section"
                        },
                        {
                            data: 'created_at',
                            render: function(data) {
                                if (!data) return '';
                                const year = new Date(data).getFullYear();
                                return `${year}–${year + 1}`;
                            }
                        },
                        {
                            "data": "action",
                            "orderable": false,
                            "searchable": false
                        }
                    ],
                    "language": {
                        "infoFiltered": ""
                    }
                });


                tables[grade_id] = table;

                // Generate Section filter buttons
                table.on('xhr', function() {
                    let data = table.ajax.json().data;
                    let sections = [...new Set(data.map(d => d.section))].sort();
                    let sectionTabs = $(`#sectionTabs_${grade_id}`);
                    sectionTabs.empty();

                    // Add buttons for each section only
                    sections.forEach((section, index) => {
                        let activeClass = index === 0 ? 'active' : '';
                        sectionTabs.append(`
                    <li class="nav-item">
                        <button class="nav-link ${activeClass}" data-section="${section}" type="button">${section}</button>
                    </li>
                `);
                    });

                    // Filter by Section
                    sectionTabs.find('button').click(function() {
                        let section = $(this).data('section');
                        sectionTabs.find('button').removeClass('active');
                        $(this).addClass('active');

                        table.column(2).search('^' + section + '$', true, false).draw();
                    });

                    // Automatically filter by the first section
                    let firstSectionButton = sectionTabs.find('button').eq(0);
                    if (firstSectionButton.length) {
                        firstSectionButton.click();
                    }
                });
            }

            // Initialize the first grade tab
            let firstPane = $('.tab-pane.show.active');
            let firstGradeId = firstPane.attr('id').replace('-student', '');
            let firstGradeName = firstPane.data('grade');
            initTable(firstGradeId, firstGradeName);

            // Handle grade tab switching
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let target = $(e.target).attr("href");
                let grade_id = target.replace('#', '').replace('-student', '');
                let grade_name = $('#' + grade_id + '-student').data('grade');

                if (!tables[grade_id]) {
                    initTable(grade_id, grade_name);
                } else {
                    tables[grade_id].ajax.reload(null, false);
                }
            });


            // ----------------------------
            // VIEW STUDENT FINAL AVERAGE
            // ----------------------------
            $(document).on('click', '.viewStudentBtn', function() {

                let student_name = $(this).data('name');
                let grade_level = $(this).data('grade');
                let section = $(this).data('section');

                // Fill top inputs
                $('#student_name').val(student_name);
                $('#student_grade_level').val(grade_level);

                // Reset tables
                $('#grades7to10Table tbody').empty();
                $('#firstSemesterTable tbody').empty();
                $('#secondSemesterTable tbody').empty();

                $('#grades7to10TableDiv').hide();
                $('#grades11to12TableDiv').hide();

                // Fetch grades
                $.ajax({
                    url: "<?= base_url('StudentController/fetch_final_average') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        student_name: student_name,
                        grade_level: grade_level,
                        section: section
                    },
                    success: function(res) {

                        let data = res.data || [];

                        // Build School Year from backend
                        let schoolYear = res.school_year_start ?
                            res.school_year_start + '–' + (parseInt(res.school_year_start) +
                                1) :
                            'N/A';

                        // Store global student info for printing
                        window.currentStudent = {
                            name: student_name,
                            gradeLevel: grade_level,
                            teacher: data.length > 0 ? data[0].teacher ?? '' : '',
                            schoolYear: schoolYear
                        };

                        // Fill teacher and school year inputs
                        $('#teacher_name').val(window.currentStudent.teacher);
                        $('#school_year').val(window.currentStudent.schoolYear);

                        if (['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'].includes(
                                grade_level)) {
                            $('#grades7to10TableDiv').show();

                            let totalFinal = 0;
                            let count = 0;

                            data.forEach(row => {
                                $('#grades7to10Table tbody').append(`
                        <tr>
                            <td>${row.subject}</td>
                            <td>${row.q1}</td>
                            <td>${row.q2}</td>
                            <td>${row.q3}</td>
                            <td>${row.q4}</td>
                            <td><strong>${row.final_grade}</strong></td>
                        </tr>
                    `);

                                totalFinal += parseFloat(row.final_grade);
                                count++;
                            });

                            $('#final_average').val(count ? (totalFinal / count).toFixed(
                                2) : '0');

                        } else {
                            $('#grades11to12TableDiv').show();

                            let firstSem = 0,
                                secondSem = 0,
                                fsCount = 0,
                                ssCount = 0;

                            data.forEach(row => {
                                if (row.q1 > 0 || row.q2 > 0) {
                                    $('#firstSemesterTable tbody').append(`
                            <tr>
                                <td>${row.subject}</td>
                                <td>${row.q1}</td>
                                <td>${row.q2}</td>
                                <td>${((row.q1 + row.q2) / 2).toFixed(2)}</td>
                            </tr>
                        `);
                                    firstSem += (row.q1 + row.q2) / 2;
                                    fsCount++;
                                }

                                if (row.q3 > 0 || row.q4 > 0) {
                                    $('#secondSemesterTable tbody').append(`
                            <tr>
                                <td>${row.subject}</td>
                                <td>${row.q3}</td>
                                <td>${row.q4}</td>
                                <td>${((row.q3 + row.q4) / 2).toFixed(2)}</td>
                            </tr>
                        `);
                                    secondSem += (row.q3 + row.q4) / 2;
                                    ssCount++;
                                }
                            });

                            $('#general_average_first_sem').val(fsCount ? (firstSem /
                                fsCount).toFixed(2) : '0');
                            $('#general_average_second_sem').val(ssCount ? (secondSem /
                                ssCount).toFixed(2) : '0');
                            $('#final_average').val(((firstSem + secondSem) / (fsCount +
                                ssCount)).toFixed(2));
                        }

                        $('#finalAverageStudentModal').modal('show');
                    }
                });
            });

            // ----------------------------
            // PRINT FINAL AVERAGE
            // ----------------------------
            $(document).on("click", "#btnPrintFinalAverage", function() {

                let student = window.currentStudent || {};
                let studentName = student.name || $('#student_name').val();
                let gradeLevel = student.gradeLevel || $('#student_grade_level').val();
                let teacherName = student.teacher || $('#teacher_name').val();
                let schoolYear = student.schoolYear || $('#school_year').val() || 'N/A';
                let generalAverage = $('#final_average').val() || '0';

                let printContent = '';

                if (['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'].includes(gradeLevel)) {
                    printContent = `
        <h2 style="text-align:center; margin-bottom:20px;">Student Report Card</h2>
        <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
            <div>
                <strong>Name Student:</strong> ${studentName}<br>
                <strong>Grade Level:</strong> ${gradeLevel}<br>
            </div>
            <div style="text-align:right;">
                <strong>General Average:</strong> ${generalAverage}<br>
                <strong>School Year:</strong> ${schoolYear}
            </div>
        </div>
        <table class="print-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>1st Quarter</th>
                    <th>2nd Quarter</th>
                    <th>3rd Quarter</th>
                    <th>4th Quarter</th>
                    <th>Final Average</th>
                </tr>
            </thead>
            <tbody>
                ${$('#grades7to10Table tbody').html()}
            </tbody>
        </table>`;
                } else {
                    let firstSemGA = $('#general_average_first_sem').val() || '0';
                    let secondSemGA = $('#general_average_second_sem').val() || '0';
                    let hasSecondSemSubjects = $('#secondSemesterTable tbody tr').length > 0;

                    printContent = `
        <h2 style="text-align:center; margin-bottom:20px;">Student Report Card</h2>
        <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
            <div>
                <strong>Name Student:</strong> ${studentName}<br>
                <strong>Grade Level:</strong> ${gradeLevel}<br>
            </div>
            <div style="text-align:right;">
                <strong>General Average:</strong> ${generalAverage}<br>
                <strong>School Year:</strong> ${schoolYear}
            </div>
        </div>
        <h3 style="margin-top:30px;">First Semester</h3>
        <table class="print-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>1st Quarter</th>
                    <th>2nd Quarter</th>
                    <th>Final Average</th>
                </tr>
            </thead>
            <tbody>
                ${$('#firstSemesterTable tbody').html()}
            </tbody>
        </table>
        <p><strong>General Average (1st Semester):</strong> ${firstSemGA}</p>`;

                    if (hasSecondSemSubjects) {
                        printContent += `
            <h3 style="margin-top:30px;">Second Semester</h3>
            <table class="print-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>3rd Quarter</th>
                        <th>4th Quarter</th>
                        <th>Final Average</th>
                    </tr>
                </thead>
                <tbody>
                    ${$('#secondSemesterTable tbody').html()}
                </tbody>
            </table>
            <p><strong>General Average (2nd Semester):</strong> ${secondSemGA}</p>`;
                    }
                }

                let printWindow = window.open('', '', 'width=1000,height=900');
                printWindow.document.write(`
        <html>
        <head>
            <title>Student Report Card</title>
            <style>
                body { font-family: Arial; padding: 25px; }
                h2, h3 { margin: 10px 0; }
                table { width:100%; border-collapse:collapse; margin-bottom: 20px; }
                .print-table th, .print-table td { border: 1px solid #000; padding: 8px; text-align: center; }
                .print-table th { background: #eee; }
                div { font-size: 14px; }
                p { font-weight: bold; }
            </style>
        </head>
        <body>
            ${printContent}
        </body>
        </html>
    `);
                printWindow.document.close();
                printWindow.print();
            });



        });
        </script>


    </div>
    </div>