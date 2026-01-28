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

#EnterScoreTable tbody tr td {
    padding: 4px 6px !important;
}

.table-scroll {
    max-height: 300px;
    overflow-y: auto;
}
</style>


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
                                                <?= $grade ?> Activity
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
                                                <h5 class="mb-3"><?= $grade ?> Activity</h5>
                                                <?php if($is_admin || $grade_levels): ?>
                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <?php if ($this->session->userdata('user_type') === 'Teacher'): ?>
                                                    <button type="button"
                                                        class="btn btn-outline-success addActivityBtn rounded-pill btn-border"
                                                        data-bs-toggle="modal" data-bs-target="#ActivityModal"
                                                        data-grade="<?= $grade ?>">
                                                        <i class="ri-add-line align-bottom "></i> Add Activity
                                                    </button>
                                                    <?php endif; ?>

                                                </div>
                                                <?php endif; ?>
                                                <table id="activityTable_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle activityTable"
                                                    style="width:100%">

                                                    <thead>
                                                        <tr>
                                                            <th>Grade Level</th>
                                                            <th>Subject</th>
                                                            <th>Activity Type</th>
                                                            <th>Quarter</th>
                                                            <th>Score Overall</th>
                                                            <th>Date Activity</th>
                                                            <th>Description</th>
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




        <!-- Add/Edit Activity Modal -->
        <div class="modal fade" id="ActivityModal" tabindex="-1" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <form id="studentForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Activity</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <!-- IMPORTANT -->
                            <input type="hidden" name="grade_level" id="hidden_grade_level">

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label>Grade Level</label>
                                    <select id="grade_level" class="form-control" disabled>
                                        <option>Auto-selected</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Subject</label>
                                    <select name="subject" id="subject" class="form-select" required>
                                        <option disabled selected>-- Select Subject --</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Quarter</label>
                                    <select name="quarter" id="quarter" class="form-select" required>
                                        <option disabled selected>-- Select Quarter --</option>
                                        <option>1st Quarter</option>
                                        <option>2nd Quarter</option>
                                        <option>3rd Quarter</option>
                                        <option>4th Quarter</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2" id="activityTypeContainer"></div>

                                <div class="col-md-6 mb-2">
                                    <label>Description</label>
                                    <select name="descrip" id="descrip" class="form-select" required>
                                        <option disabled selected>-- Select Description --</option>
                                        <option>Written Works</option>
                                        <option>Performance Task</option>
                                        <option>Quarterly Assessment</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Score Overall</label>
                                    <input type="number" name="overall" id="overall" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="saveBtn" class="btn btn-outline-success btn-border"><i class="ri-save-line"></i>Save</button>
                            <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal"><i class="ri-close-line me-1"></i>Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <!-- Tag Modal -->
        <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <div class="modal-header">


                        <h5 class="modal-title">Tag Grades</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add Grades Button -->
                        <div class="mb-3 d-flex align-items-center">
                            <?php if ($this->session->userdata('user_type') === 'Teacher'): ?>
                            <button type="button" class="btn btn-outline-success me-2 rounded-pill btn-border"
                                id="openAddGradesBtn">
                                <i class="bi bi-journal-check me-1"></i> Add Score
                            </button>
                            <?php endif; ?>
                        </div>
                     
                        <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3" id="sectionTabs"
                            role="tablist"></ul>

                        <!-- Activity Info -->
                        <div class="row mb-3">
                            <!-- Inputs Row -->


                            <div class="row mb-3 equal-width">
                                <div class="col">
                                    <label for="subjects" class="form-label">Subjects</label>
                                    <input type="text" id="subjects" name="subjects"
                                        class="form-control underline-input" autocomplete="off" readonly
                                        style="text-align:center;">
                                </div>

                                <div class="col">
                                    <label for="activity" class="form-label">Activity Type</label>
                                    <input type="text" id="activity" name="activity"
                                        class="form-control underline-input" autocomplete="off" readonly
                                        style="text-align:center;">
                                </div>
                                <div class="col">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" id="description" name="description"
                                        class="form-control underline-input" autocomplete="off" readonly
                                        style="text-align:center;">
                                </div>

                                <div class="col">
                                    <label for="dates" class="form-label">Date Activity</label>
                                    <input type="date" id="dates" name="dates" class="form-control underline-input"
                                        autocomplete="off" readonly style="text-align:center;">
                                </div>

                                <div class="col">
                                    <label for="overalls" class="form-label">Overall</label>
                                    <input type="text" id="overalls" name="overall" class="form-control underline-input"
                                        autocomplete="off" readonly style="text-align:center;">
                                </div>

                                <div class="col">
                                    <label for="passing" class="form-label">Passing Score</label>
                                    <input type="text" id="passing" name="passing" class="form-control underline-input"
                                        autocomplete="off" readonly style="text-align:center;">
                                </div>

                            </div>

                            <!-- Grades Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap table-striped align-middle "
                                    style="width:100%" id="gradesTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Student</th>
                                            <th>Section</th>
                                            <th>Score</th>
                                            <th>Remarks</th>
                                            <?php if ($this->session->userdata('user_type') === 'Teacher'): ?>
                                            <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">  <i class="ri-close-line"></i>Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add Grades Modal -->
        <div class="modal fade" id="addGradesModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <form id="addGradesForm">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Add Score</h5>
                        </div>


                        <div class="modal-body">
                            <input type="hidden" name="activity_type_id" id="activity_type_id">

                            <div class="mb-3">
                                <label>Section</label>
                                <select id="section" name="section" class="form-select" required>
                                    <option value="" selected disabled>Select Section</option>
                                </select>
                            </div>

                            <!-- TABLE: STUDENT SCORES -->
                            <div class="mb-3">
                                <label>Students & Scores</label>

                                <div class="table-responsive table-scroll" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table table-bordered table-striped" id="EnterScoreTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Student Name</th>
                                                <th width="140px">Enter Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="text-center text-muted">Select a section</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="saveGradeBtn" class="btn btn-outline-success btn-border">
                                <i class="ri-save-line"></i> Save All
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">
                                <i class="ri-close-line"></i> Cancel
                            </button>

                        </div>

                    </div>
                </form>
            </div>
        </div>


        <!-- Edit Grade Modal -->
        <div class="modal fade" id="editGradeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <form id="editGradeForm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Grade</h5>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="grade_id" id="editGradeId">
                            <div class="mb-3">
                                <label for="editStudentName" class="form-label">Student Name</label>
                                <input type="text" id="editStudentName" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editSection" class="form-label">Section</label>
                                <input type="text" id="editSection" name="section" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editScore" class="form-label">Score</label>
                                <input type="number" id="editScore" name="score" class="form-control" required min="0">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-primary btn-border">
                                <i class="ri-save-line"></i> Update
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">
                                <i class="ri-close-line"></i> Cancel
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
        $(document).ready(function() {

            const grade_map = {
                'grade7': 'Grade 7',
                'grade8': 'Grade 8',
                'grade9': 'Grade 9',
                'grade10': 'Grade 10',
                'grade11': 'Grade 11',
                'grade12': 'Grade 12'
            };

            // ✅ Initialize DataTables for each grade-level table
            $('.activityTable').each(function() {
                let grade_id = $(this).attr('id').replace('activityTable_', '');
                let grade_level = grade_map[grade_id];

                let table = $(this).DataTable({
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    processing: true,
                    language: {
                        search: '',
                        searchPlaceholder: 'Search...',
                        processing: '<div class="table-loader"></div>'
                    },
                    ajax: {
                        url: "<?= site_url('StudentController/fetch_activitie'); ?>",
                        type: 'POST',
                        data: {
                            grade_level: grade_level
                        },
                        dataSrc: 'data'
                    },
                    columns: [{
                            data: 'grade_level'
                        },
                        {
                            data: 'subject'
                        },
                        {
                            data: 'activity_type'
                        },
                        {
                            data: 'quarter'
                        },
                        {
                            data: 'overall'
                        },
                        {
                            data: 'activity_date'
                        },
                        {
                            data: 'description',
                            render: function(data, type, row) {
                                let percentage = '';
                                let bgClass = '';

                                let gradeNum = parseInt(row.grade_level.replace(
                                    "Grade ", ""));

                                let written = '30%',
                                    performance = '50%',
                                    quarterly = '20%';
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
                        <?php if ($is_admin || $grade_levels): ?> {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                let buttonHtml = `
                                <button class="btn btn-sm btn-outline-success tagBtn position-relative me-1 btn-border"
                                    data-id = "${row.id}"
                                    data-grade_level = "${row.grade_level}"
                                    data-subject = "${row.subject}"
                                    data-activity_type = "${row.activity_type}"
                                    data-description = "${row.description}"
                                    data-activity_date = "${row.activity_date}"
                                    data-overall = "${row.overall}"
                                    data-bs-toggle = "modal"
                                    data-bs-target = "#tagModal" > 
                                    <i class="bi bi-tag-fill"></i> Add Grade
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill ${
                                        row.pending_count == 0 ? 'bg-success' : 'bg-danger'
                                    } pendingCount">
                                        ${row.pending_count}
                                    </span>
                                </button>
                                `;



                                let teacherButtons = `
                                <?php if ($this->session->userdata('user_type') === 'Teacher'): ?>
                                    <button class="btn btn-sm btn-outline-primary editBtn me-1 btn-border" data-id="${row.id}">
                                        <i class="ri-edit-line"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger deleteBtn btn-border" data-id="${row.id}">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                <?php endif; ?>
                                `;

                                return buttonHtml + teacherButtons;
                            }
                        }
                        <?php endif; ?>
                    ]
                });

                $(this).data('tableInstance', table);
            });







            <?php if ($is_admin || $grade_levels): ?>

            const gradeMap = {
                'grade7-student': 'Grade 7',
                'grade8-student': 'Grade 8',
                'grade9-student': 'Grade 9',
                'grade10-student': 'Grade 10',
                'grade11-student': 'Grade 11',
                'grade12-student': 'Grade 12'
            };

            // ADD ACTIVITY
            $('.addActivityBtn').click(function() {

                $('#studentForm')[0].reset();
                $('#id').val('');
                $('#saveBtn').html('<i class="ri-save-line"></i> Save');
                $('.modal-title').text('Add Activity');

                // Detect active tab grade
                let activeTab = $('.tab-pane.show.active').attr('id');
                let grade = gradeMap[activeTab] ?? '';

                $('#hidden_grade_level').val(grade);
                $('#grade_level').html(`<option>${grade}</option>`);

                // Activity Type (SELECT)
                $('#activityTypeContainer').html(`
                    <label>Activity Type</label>
                    <select name="activity_type" id="activity_type" class="form-select" required>
                        <option disabled selected>-- Select Activity Type --</option>
                        <option>Activity Sheets</option>
                        <option>Quiz</option>
                        <option>Assignment</option>
                        <option>Project</option>
                        <option>Performance Task</option>
                        <option>Written Task</option>
                        <option>Exam</option>
                        <option>Group Activity</option>
                    </select>
                `);

                // Subjects
                $.getJSON("<?= site_url('StudentController/get_allowed_subjects'); ?>", function(
                    subjects) {
                    let s = $('#subject');
                    s.empty().append('<option disabled selected>-- Select Subject --</option>');
                    subjects.forEach(v => s.append(`<option value="${v}">${v}</option>`));
                });

                $('#ActivityModal').modal('show');
            });

            // EDIT ACTIVITY
            $(document).on('click', '.editBtn', function() {

                let id = $(this).data('id');
                $('#studentForm')[0].reset();
                $('#saveBtn').html('<i class="ri-edit-line me-1"></i> Update');
                $('.modal-title').text('Edit Activity');

                $.getJSON("<?= site_url('StudentController/get_activity/'); ?>" + id, function(d) {

                    $('#id').val(d.id);
                    $('#hidden_grade_level').val(d.grade_level);
                    $('#grade_level').html(`<option>${d.grade_level}</option>`);

                    $('#activityTypeContainer').html(`
                        <label>Activity Type</label>
                        <input type="text" name="activity_type" class="form-control"
                            value="${d.activity_type}" required>
                    `);

                    $.getJSON("<?= site_url('StudentController/get_allowed_subjects'); ?>",
                        function(subjects) {
                            let s = $('#subject');
                            s.empty();
                            subjects.forEach(v => s.append(
                                `<option value="${v}">${v}</option>`));
                            s.val(d.subject);
                        });

                    $('#quarter').val(d.quarter);
                    $('#descrip').val(d.description);
                    $('#overall').val(d.overall);

                    $('#ActivityModal').modal('show');
                });
            });

            // SAVE
            $('#studentForm').submit(function(e) {
                e.preventDefault();

                let isValid = true;
                let missingFields = [];

                // check all required fields
                $('#studentForm').find('[required]').each(function() {
                    if (!$(this).val()) {
                        isValid = false;

                        let label = $(this).closest('.mb-3').find('label').text();
                        missingFields.push(label || 'Required field');
                    }
                });

                // if not valid → show swal
                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Required Fields',
                        html: `<p>Please complete all required fields:</p>`,
                    });
                    return;
                }

                // proceed if valid
                $.ajax({
                    url: "<?= site_url('StudentController/save_activity'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(res) {
                        Swal.fire(res.message, '', res.status ? 'success' : 'error');
                        if (res.status) {
                            $('#ActivityModal').modal('hide');
                            $('.activityTable').each(function() {
                                $(this).DataTable().ajax.reload(null, false);
                            });
                        }
                    }
                });
            });


            <?php endif; ?>


            // ✅ Delete Activity
            $(document).on('click', '.deleteBtn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This record will be permanently deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then(result => {
                    if (result.isConfirmed) {
                        $.getJSON("<?= site_url('StudentController/delete_activity/'); ?>" + id,
                            function(res) {
                                Swal.fire(res.status ? 'Deleted!' : 'Error deleting', '',
                                    'success');
                                $('.activityTable').each(function() {
                                    $(this).data('tableInstance').ajax.reload();
                                });
                            });
                    }
                });
            });



            // ✅ Tag Button Click
            $(document).on('click', '.tagBtn', function() {
                var id = $(this).data('id');
                var subject = $(this).data('subject') || '';
                var activityType = $(this).data('activity_type') || '';
                var activityDate = $(this).data('activity_date') || '';
                var description = $(this).data('description') || '';
                var overall = parseFloat($(this).data('overall')) || 0;

                // Set modal title
                $('.modal-title').text('Tag Grades');

                // Populate modal fields
                $('#activity_type_id').val(id);
                $('#subjects').val(subject);
                $('#activity').val(activityType);
                $('#description').val(description);
                $('#dates').val(activityDate);
                $('#overalls').val(overall);

                // Calculate passing score
                var passingScore = overall * 0.75;
                $('#passing').val(passingScore.toFixed(1));

                // Load grades table
                loadGradesTable(id);

                // Show modal
                tagModal.show();
            });


            var editGradeModal = new bootstrap.Modal(document.getElementById('editGradeModal'));

            function loadGradesTable(activityTypeId) {
                var overallScore = parseFloat($('#overalls').val()) || 0;

                $.ajax({
                    url: '<?= base_url("StudentController/fetch_grades") ?>/' + activityTypeId,
                    method: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        // Ensure returned data is an array
                        var list = Array.isArray(res) ? res : (res.data ? res.data : []);
                        list = list.filter(g => g && g.student_name);

                        // Extract unique sections and sort alphabetically
                        var sections = [...new Set(list.map(g => g.sections))];
                        sections.sort((a, b) => a.localeCompare(b)); // Alphabetical order

                        // Build tabs dynamically
                        var tabsHtml = '';
                        sections.forEach((section, index) => {
                            tabsHtml += `
                    <li class="nav-item">
                        <a class="nav-link ${index === 0 ? 'active' : ''}" data-section="${section}" href="#" role="tab">
                            ${section}
                        </a>
                    </li>
                `;
                        });
                        $('#sectionTabs').html(tabsHtml);

                        // Draw DataTable for the first alphabetically sorted section
                        drawGradesTable(list, sections[0], overallScore);

                        // Tab click event to filter table
                        $('#sectionTabs a').on('click', function(e) {
                            e.preventDefault();
                            $('#sectionTabs a').removeClass('active');
                            $(this).addClass('active');
                            var section = $(this).data('section');
                            drawGradesTable(list, section, overallScore);
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to load grades data.', 'error');
                    }
                });
            }

            function drawGradesTable(data, section, overallScore) {
                var passingPercentage = 75;
                var passingScore = (overallScore * passingPercentage) / 100;

                var filtered = data.filter(g => g.sections === section);

                var rows = filtered.map(g => {
                    var percentDisplay = '0% - Failed';
                    if (overallScore > 0 && g.score != null && g.score !== "") {
                        var percent = (g.score / overallScore) * 100;
                        var status = (g.score >= passingScore) ? 'Passed' : 'Failed';
                        percentDisplay = percent.toFixed(0) + '% - ' + status;
                    }

                    var actions = `
            <button class="btn btn-sm btn-outline-primary editGradeBtn"
                data-id="${g.line_id}"
                data-name="${g.student_name}"
                data-section="${g.sections}"
                data-score="${g.score}">
                <i class="bi bi-pencil-square me-1"></i>Edit
            </button>

            <button class="btn btn-sm btn-outline-danger deleteGradeBtn"
                data-id="${g.line_id}">
                <i class="bi bi-trash me-1"></i>Delete
            </button>
        `;

                    return [
                        g.student_name,
                        g.sections,
                        g.score,
                        percentDisplay,
                        actions
                    ];
                });

                if ($.fn.DataTable.isDataTable('#gradesTable')) {
                    var table = $('#gradesTable').DataTable();
                    table.clear();
                    if (rows.length > 0) table.rows.add(rows).draw();
                    else table.draw();
                } else {
                    $('#gradesTable').DataTable({
                        data: rows,
                        columns: [{
                                title: "Student"
                            },
                            {
                                title: "Section"
                            },
                            {
                                title: "Score"
                            },
                            {
                                title: "Remarks"
                            },
                            <?php if ($this->session->userdata('user_type') === 'Teacher'): ?> {
                                title: "Action",
                                orderable: false,
                                searchable: false
                            }
                            <?php endif; ?>
                        ],
                        responsive: true,
                        language: {
                            emptyTable: "No data available"
                        }
                    });
                }
            }




            // Open Edit Modal
            $(document).on('click', '.editGradeBtn', function() {
                var table = $('#gradesTable').DataTable();
                var row = table.row($(this).parents('tr')).data();

                $('#editGradeId').val($(this).data('id'));
                $('#editStudentName').val(row[0]);
                $('#editSection').val(row[1]);
                $('#editScore').val(row[2]);

                // Set the modal title dynamically
                $('#editGradeModal .modal-title').text('Edit Grade for ' + row[0]);

                // Show the modal
                var editGradeModal = new bootstrap.Modal(document.getElementById('editGradeModal'));
                editGradeModal.show();
            });



            $('#editGradeForm').submit(function(e) {
                e.preventDefault();

                var gradeId = $('#editGradeId').val();
                var section = $('#editSection').val();
                var score = parseFloat($('#editScore').val()) || 0;
                var overallScore = parseFloat($('#overalls').val()) || 0;

                // Validation: score should not exceed overall
                if (score > overallScore) {
                    Swal.fire('Invalid Score', `Score cannot be greater than overall (${overallScore})`,
                        'warning');
                    return; // Stop submission
                }

                $.ajax({
                    url: '<?= base_url("StudentController/update_grade") ?>',
                    method: 'POST',
                    data: {
                        grade_id: gradeId,
                        section: section,
                        score: score
                    },
                    success: function() {
                        var table = $('#gradesTable').DataTable();
                        var row = table.row($(`button.editGradeBtn[data-id='${gradeId}']`)
                            .parents('tr'));

                        // Recalculate remarks
                        var passingScore = overallScore * 0.75;
                        var percentDisplay = '0% - Failed';
                        if (overallScore > 0 && score != '') {
                            var percent = (score / overallScore) * 100;
                            var status = (score >= passingScore) ? 'Passed' : 'Failed';
                            percentDisplay = percent.toFixed(0) + '% - ' + status;
                        }

                        // Update table row dynamically
                        row.data([
                            row.data()[0], // Student Name
                            section,
                            score,
                            percentDisplay,
                            row.data()[4] // Action buttons
                        ]).draw(false);

                        editGradeModal.hide();
                        Swal.fire('Success', 'Grade updated successfully', 'success');
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to update grade', 'error');
                    }
                });
            });




            // Delete with Swal
            $(document).on('click', '.deleteGradeBtn', function() {
                var gradeId = $(this).data('id');
                var table = $('#gradesTable').DataTable();
                var row = table.row($(this).parents('tr'));

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url("StudentController/delete_grade") ?>/' +
                                gradeId,
                            method: 'POST',
                            success: function() {
                                row.remove().draw(false); // remove row dynamically

                                // Reload the activityTable
                                if ($.fn.DataTable.isDataTable('.activityTable')) {
                                    $('.activityTable').DataTable().ajax.reload(
                                        null, false); // false = keep paging
                                }

                                Swal.fire('Deleted!', 'Grade has been deleted.',
                                    'success');
                            },
                            error: function() {
                                Swal.fire('Error', 'Failed to delete grade',
                                    'error');
                            }
                        });
                    }
                });
            });





            const addGradesModal = new bootstrap.Modal(document.getElementById('addGradesModal'));

            // -------------------------------
            // OPEN MODAL
            // -------------------------------
            $('#openAddGradesBtn').click(function() {
                let activeTab = $('.arrow-navtabs .nav-link.active').text().trim();
                let gradeLevel = activeTab.replace(' Activity', '');

                $.ajax({
                    url: '<?= base_url("StudentController/get_sections") ?>',
                    method: 'GET',
                    data: {
                        grade_level: gradeLevel
                    },
                    dataType: 'json',
                    success: function(sections) {
                        let options =
                            '<option value="" disabled selected>Select Section</option>';
                        sections.forEach(sec => {
                            options += `<option value="${sec}">${sec}</option>`;
                        });
                        $('#section').html(options);

                        $('#EnterScoreTable tbody').html(`
                <tr><td colspan="2" class="text-center text-muted">Select a section</td></tr>
            `);
                    }
                });

                addGradesModal.show();
            });

            // -------------------------------
            // LOAD STUDENTS INTO TABLE
            // -------------------------------
            $('#section').change(function() {
                const section = $(this).val();
                const activityTypeId = $('#activity_type_id').val();

                $.ajax({
                    url: '<?= base_url("StudentController/get_students_by_section") ?>',
                    method: 'GET',
                    data: {
                        section,
                        activity_type_id: activityTypeId
                    },
                    dataType: 'json',
                    success: function(students) {

                        students.sort((a, b) => {
                            let nameA = a.fullname.split(' ')[0].toLowerCase();
                            let nameB = b.fullname.split(' ')[0].toLowerCase();
                            return nameA.localeCompare(nameB);
                        });

                        let males = students.filter(s => s.gender === "Male");
                        let females = students.filter(s => s.gender === "Female");

                        let rows = "";

                        if (males.length > 0) {
                            rows +=
                                `<tr class="table-primary"><td colspan="2"><strong>Male</strong></td></tr>`;
                            males.forEach(s => {
                                rows += `
                        <tr>
                            <td>${s.fullname}</td>
                            <td><input type="number" class="form-control score-input" data-id="${s.id}" placeholder="Enter score"></td>
                        </tr>`;
                            });
                        }

                        if (females.length > 0) {
                            rows +=
                                `<tr class="table-danger"><td colspan="2"><strong>Female</strong></td></tr>`;
                            females.forEach(s => {
                                rows += `
                        <tr>
                            <td>${s.fullname}</td>
                            <td><input type="number" class="form-control score-input" data-id="${s.id}" placeholder="Enter score"></td>
                        </tr>`;
                            });
                        }

                        if (students.length === 0) {
                            rows =
                                `<tr><td colspan="2" class="text-center text-muted">No available students</td></tr>`;
                        }

                        $('#EnterScoreTable tbody').html(rows);
                    }
                });
            });

            // -------------------------------
            // SAVE ALL SCORES
            // -------------------------------
            $('#saveGradeBtn').click(function() {
                let payload = {
                    activity_type_id: $('#activity_type_id').val(),
                    section: $('#section').val(),
                    scores: {}
                };

                $('.score-input').each(function() {
                    const sid = $(this).data('id');
                    const scr = $(this).val();
                    payload.scores[sid] = scr;
                });

                $.ajax({
                    url: '<?= base_url("StudentController/save_grade_bulk") ?>',
                    method: 'POST',
                    data: payload,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Saved!",
                                text: "All students' scores saved successfully!"
                            });

                            addGradesModal.hide();

                            // Reload your activityTable
                            if ($.fn.DataTable.isDataTable('.activityTable')) {
                                $('.activityTable').DataTable().ajax.reload(null,
                                    false); // false = don't reset pagination
                            }

                            // Optionally, reload your grades table too
                            let activityTypeId = $('#activity_type_id').val();
                            loadGradesTable(activityTypeId);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: res.message
                            });
                        }
                    }
                });

            });


        });
        </script>


    </div>
    </div>