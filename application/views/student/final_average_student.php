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
                                <h4 class="mb-sm-0">Final Average</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Final Average</li>
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
                                                class="nav-link gradeTab <?= $active_class ?>"
                                                data-grade="<?= $grade_id ?>" data-grade-text="<?= $grade ?>">
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
                                                <h5 class="mb-3"><?= $grade ?> Average</h5>
                                                <?php if($is_admin || $grade_levels): ?>

                                                <?php endif; ?>
                                                <table id="activityTable_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle activityTable"
                                                    style="width:100%">

                                                    <thead>
                                                        <tr>
                                                            <th>Grade Level</th>
                                                            <th>Section</th>
                                                            <th>Teacher</th>
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


        <!-- Final Average Modal -->
        <div class="modal fade" id="finalAverageModal" tabindex="-1" aria-labelledby="finalAverageModalLabel"
            aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Final Average Details</h5>
                    </div>
                    <br>
                    <div class="ms-4">
                        <!-- Adds left margin -->
                        <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3" id="sectionTabs"
                            role="tablist"></ul>
                    </div>



                    <div class="modal-body">
                        <div class="row mb-3 equal-width">
                            <div class="col">
                                <label for="grade_level" class="form-label">Grade Level</label>
                                <input type="text" id="grade_level" name="grade_level"
                                    class="form-control underline-input" autocomplete="off" readonly
                                    style="text-align:center;">
                            </div>
                            <div class="col">
                                <label for="teacher" class="form-label">Teacher</label>
                                <input type="text" id="teacher" name="teacher" class="form-control underline-input"
                                    autocomplete="off" readonly style="text-align:center;">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%" id="finalGradesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Section</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">
                            <i class="ri-close-fill me-1"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

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
                            <div class="col">
                                <label for="teacher_name" class="form-label">Teacher</label>
                                <input type="text" id="teacher_name" name="teacher_name"
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
        let loadedTables = {};

        $(document).ready(function() {

            // Load first active tab (optional)
            let firstTab = $('.gradeTab.active');
            if (firstTab.length) {
                loadGradeTable(firstTab.data('grade'), firstTab.data('grade-text'));
            }

            // On grade tab change
            $(document).on('shown.bs.tab', '.gradeTab', function() {
                let gradeId = $(this).data('grade');
                let gradeText = $(this).data('grade-text');
                loadGradeTable(gradeId, gradeText);
            });

            // Click "View Student" button
            $(document).on('click', '.view-btn', function() {
                let table = $(this).closest('table').DataTable();
                let rowData = table.row($(this).closest('tr')).data();

                $('#grade_level').val(rowData.grade_level);
                $('#teacher').val(rowData.full_name);

                $.ajax({
                    url: '<?= base_url("StudentController/fetch_students_by_section") ?>',
                    type: 'POST',
                    data: {
                        section: rowData.section
                    },
                    dataType: 'json',
                    success: function(res) {
                        if ($.fn.DataTable.isDataTable('#finalGradesTable')) {
                            $('#finalGradesTable').DataTable().clear().destroy();
                        }

                        let sections = [...new Set(res.data.map(s => s.section))];

                        let tabsHtml = '';
                        sections.forEach((section, index) => {
                            tabsHtml += `
                    <li class="nav-item">
                        <a class="nav-link ${index === 0 ? 'active' : ''}" 
                           data-section="${section}" 
                           href="#" role="tab">
                           ${section}
                        </a>
                    </li>`;
                        });
                        $('#sectionTabs').html(tabsHtml);

                        let dataTable = $('#finalGradesTable').DataTable({
                            data: res.data,
                            columns: [{
                                    data: 'student_name'
                                },
                                {
                                    data: 'section'
                                },
                                {
                                    data: null,
                                    render: function(row) {
                                        return `<button class="btn btn-sm btn-outline-primary btn-border view-final-average"
                                        data-student-name="${row.student_name}"
                                        data-grade-level="${row.grade_level}"
                                        data-section="${row.section}"
                                        data-teacher-name="${row.teacher}">
                                        <i class='ri-eye-line'></i> View Average
                                    </button>`;
                                    }
                                }
                            ],
                            infoCallback: function(settings, start, end, max, total,
                                pre) {
                                return `Showing ${start} to ${end} of ${total} entries`;
                            }
                        });


                        $('#sectionTabs a').off('click').on('click', function(e) {
                            e.preventDefault();
                            $('#sectionTabs a').removeClass('active');
                            $(this).addClass('active');

                            let selectedSection = $(this).data('section');
                            dataTable.column(1).search(selectedSection)
                                .draw();
                        });

                        if (sections.length > 0) {
                            dataTable.column(1).search(sections[0]).draw();
                        }
                    }
                });

                $('#finalAverageModal').modal('show');
            });



           $(document).on('click', '.view-final-average', function() {
    let studentName = $(this).data('student-name');
    let gradeLevel = $(this).data('grade-level');
    let section = $(this).data('section');
    let teacherName = $(this).data('teacher-name');

    // Fill hidden inputs (optional, keeps your code intact)
    $('#student_name').val(studentName);
    $('#student_grade_level').val(gradeLevel);
    $('#teacher_name').val(teacherName);

    // Hide all tables initially
    $('#grades7to10TableDiv, #grades11to12TableDiv').hide();
    $('#grades7to10Table tbody, #firstSemesterTable tbody, #secondSemesterTable tbody').empty();

    $.ajax({
        url: '<?= base_url("StudentController/fetch_final_average") ?>',
        type: 'POST',
        data: {
            student_name: studentName,
            grade_level: gradeLevel,
            section: section
        },
        dataType: 'json',
        success: function(res) {

            // ✅ CALCULATE SCHOOL YEAR FROM res.school_year_start (c.created_at)
            let startYear = parseInt(res.school_year_start); // e.g., "2026-01-23" → 2026
            let endYear = startYear + 1;
            let schoolYear = `${startYear}–${endYear}`;

            // Save to a JS object for print
            window.currentStudent = {
                name: studentName,
                gradeLevel: gradeLevel,
                teacher: teacherName,
                schoolYear: schoolYear
            };

            // ----------------------------
            // KEEP YOUR TABLE LOGIC INTACT
            // ----------------------------
            if (['Grade 7','Grade 8','Grade 9','Grade 10'].includes(gradeLevel)) {
                $('#grades7to10TableDiv').show();
                let totalGeneral = 0;
                res.data.forEach(item => {
                    let finalAvg = ((parseFloat(item.q1)+parseFloat(item.q2)+parseFloat(item.q3)+parseFloat(item.q4))/4).toFixed(2);
                    $('#grades7to10Table tbody').append(`
                        <tr>
                            <td>${item.subject}</td>
                            <td>${item.q1}</td>
                            <td>${item.q2}</td>
                            <td>${item.q3}</td>
                            <td>${item.q4}</td>
                            <td>${finalAvg}</td>
                        </tr>
                    `);
                    totalGeneral += parseFloat(finalAvg);
                });
                $('#final_average').val(res.data.length ? (totalGeneral/res.data.length).toFixed(2) : 0);

            } else if (['Grade 11','Grade 12'].includes(gradeLevel)) {
                $('#grades11to12TableDiv').show();
                let totalFirstSem = 0, totalSecondSem = 0, firstCount = 0, secondCount = 0;

                res.data.forEach(item => {
                    if(item.q1>0 || item.q2>0){
                        let q1 = item.q1||0, q2=item.q2||0;
                        let firstSemAvg = ((q1+q2)/((q1>0 && q2>0)?2:1)).toFixed(2);
                        $('#firstSemesterTable tbody').append(`
                            <tr>
                                <td>${item.subject}</td>
                                <td>${q1}</td>
                                <td>${q2}</td>
                                <td>${firstSemAvg}</td>
                            </tr>
                        `);
                        totalFirstSem += parseFloat(firstSemAvg);
                        firstCount++;
                    }
                    if(item.q3>0 || item.q4>0){
                        let q3=item.q3||0, q4=item.q4||0;
                        let secondSemAvg = ((q3+q4)/((q3>0 && q4>0)?2:1)).toFixed(2);
                        $('#secondSemesterTable tbody').append(`
                            <tr>
                                <td>${item.subject}</td>
                                <td>${q3}</td>
                                <td>${q4}</td>
                                <td>${secondSemAvg}</td>
                            </tr>
                        `);
                        totalSecondSem += parseFloat(secondSemAvg);
                        secondCount++;
                    }
                });

                $('#general_average_first_sem').val(firstCount ? (totalFirstSem/firstCount).toFixed(2) : 0);
                $('#general_average_second_sem').val(secondCount ? (totalSecondSem/secondCount).toFixed(2) : 0);
                $('#final_average').val((firstCount+secondCount) ? ((totalFirstSem+totalSecondSem)/(firstCount+secondCount)).toFixed(2) : 0);
            }

            // Show modal
            new bootstrap.Modal(document.getElementById('finalAverageStudentModal'), { backdrop: 'static' }).show();
        }
    });
});

// ----------------------------
// PRINT LOGIC
// ----------------------------
$(document).on("click", "#btnPrintFinalAverage", function() {
    let student = window.currentStudent || { name: "N/A", gradeLevel: "N/A", teacher: "N/A", schoolYear: "N/A" };
    let gradeLevel = student.gradeLevel;
    let studentName = student.name;
    let teacherName = student.teacher;
    let schoolYear = student.schoolYear;
    let generalAverage = $('#final_average').val();

    let printContent = "";

    if (['Grade 7','Grade 8','Grade 9','Grade 10'].includes(gradeLevel)) {
        printContent = `
        <h2 style="text-align:center; margin-bottom:20px;">Student Report Card</h2>
        <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
            <div>
                <strong>Name Student:</strong> ${studentName}<br>
                <strong>Grade Level:</strong> ${gradeLevel}<br>
                <strong>Teacher:</strong> ${teacherName}
            </div>
            <div style="text-align:right;">
                <strong>General Average:</strong> ${generalAverage}<br>
                <strong>School Year:</strong> ${schoolYear}
            </div>
        </div>
        <table class="print-table">
            <thead>
                <tr>
                    <th>Subjects</th>
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
        let firstSemGA = $('#general_average_first_sem').val();
        let secondSemGA = $('#general_average_second_sem').val();
        let hasSecondSemSubjects = $('#secondSemesterTable tbody tr').length > 0;

        printContent = `
        <h2 style="text-align:center; margin-bottom:20px;">Student Report Card</h2>
        <div style="display:flex; justify-content:space-between; margin-bottom:20px;">
            <div>
                <strong>Name Student:</strong> ${studentName}<br>
                <strong>Grade Level:</strong> ${gradeLevel}<br>
                <strong>Teacher:</strong> ${teacherName}
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
                    <th>Subjects</th>
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
                        <th>Subjects</th>
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
                table { width:100%; border-collapse:collapse; margin-bottom: 20px; }
                .print-table th, .print-table td { border: 1px solid #000; padding: 8px; text-align: center; }
                .print-table th { background: #eee; }
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

        // Load activity table per grade
        function loadGradeTable(gradeId, gradeText) {
            let tableSelector = "#activityTable_" + gradeId;
            if (loadedTables[gradeId]) return;
            loadedTables[gradeId] = true;

            $(tableSelector).DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "<?= base_url('StudentController/fetch_activity_by_grade'); ?>",
                    type: "POST",
                    data: {
                        grade_level: gradeText
                    }
                },
                columns: [{
                        data: "grade_level"
                    },
                    {
                        data: "section"
                    },
                    {
                        data: "full_name"
                    },
                    {
                        data: null,
                        render: function(row) {
                            return `<button class="btn btn-sm btn-outline-info view-btn btn-border">
                      <i class='ri-eye-line'></i> View Student
                  </button>`;
                        }
                    }
                ]
            });
        }
        </script>

    </div>
    </div>