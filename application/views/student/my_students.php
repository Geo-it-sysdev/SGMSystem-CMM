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

<?php
$user_id = $this->session->userdata("po_user");
$user_type = null;

if (isset($user_id)) {
    $user = $this->AuthModel->get_user_by_user_id($user_id);
    $user_type = $user->user_type ?? null; 
}
?>


<body>

    <!-- Begin page -->
    <div id="layout-wrapper">





        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
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
                                <h4 class="mb-sm-0">Student Setup</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Student Setup</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="border">
                                    <!-- ================= NAV PILLS ================= -->
                                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3 flex-wrap">
                                        <?php
                            $all_grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];
                            $is_all = in_array('All', $grade_levels);
                            $active_set = false; 

                            foreach ($all_grades as $grade):
                                if ($is_all || in_array($grade, $grade_levels)):
                                    $grade_id = strtolower(str_replace(' ', '', $grade)); 
                                    $active_class = (!$active_set) ? 'active' : '';
                                    $active_set = true;
                            ?>
                                        <li class="nav-item">
                                            <a href="#<?= $grade_id ?>-student" data-bs-toggle="tab"
                                                class="nav-link <?= $active_class ?> d-flex align-items-center justify-content-start custom-no-hover"
                                                style="width: 180px;">
                                                <i class="ri-team-line me-2"></i>
                                                <span><?= $grade ?> Students</span>
                                            </a>
                                        </li>
                                        <?php endif; endforeach; ?>
                                    </ul>

                                    <!-- ================= TAB CONTENT ================= -->
                                    <div class="tab-content">
                                        <?php
                                        $tab_first = true;
                                        foreach ($all_grades as $grade):
                                            if ($is_all || in_array($grade, $grade_levels)):
                                                $grade_id = strtolower(str_replace(' ', '', $grade));
                                                $show_class = $tab_first ? 'show active' : '';
                                                $tab_first = false;
                                        ?>
                                        <div class="tab-pane fade <?= $show_class ?>" id="<?= $grade_id ?>-student">
                                            <div class="card p-3">
                                                <h5 class="mb-3"><?= $grade ?> Students</h5>



                                                <div class="d-flex align-items-center justify-content-between mb-3">

                                                    <div class="d-flex align-items-center gap-2">
                                                      <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'): ?>
                                                        <button type="button"
                                                            class="btn btn-outline-success add-btn rounded-pill"
                                                            data-bs-toggle="modal" data-bs-target="#studentModal">
                                                            <i class="ri-add-line align-bottom me-1"></i>Add Student
                                                        </button>
                                                        <?php endif; ?>

                                                        <?php if ($user_type === 'Teacher'): ?>
                                                        <button type="button"
                                                            class="btn btn-outline-success add-btn rounded-pill"
                                                            data-bs-toggle="modal" data-bs-target="#TagstudentModal">
                                                            <i class="ri-add-line align-bottom me-1"></i>Tag Student
                                                        </button>
                                                        <?php endif; ?>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-outline-primary dropdown-toggle rounded-pill"
                                                                type="button" id="filterDropdown_<?= $grade_id ?>"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-filter-line align-bottom me-1"></i> Filter
                                                                Sections
                                                            </button>

                                                            <div class="ms-4">
    <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3"
        id="sectionTabs"></ul>
</div>


                                                            <ul class="dropdown-menu p-3"
                                                                aria-labelledby="filterDropdown_<?= $grade_id ?>">
                                                                <?php
                                                                $sections = $this->StudentModel->get_all_students($grade, null, 'active');
                                                                $unique_sections = array_unique(array_column($sections, 'section'));
                                                                foreach ($unique_sections as $sec):
                                                                ?>
                                                                <li class="form-check">
                                                                    <input class="form-check-input filter-check"
                                                                        type="checkbox" value="<?= $sec ?>"
                                                                        id="<?= $grade_id ?>_chk_<?= $sec ?>" checked>
                                                                    <label class="form-check-label"
                                                                        for="<?= $grade_id ?>_chk_<?= $sec ?>">
                                                                        <?= $sec ?>
                                                                    </label>
                                                                </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <!-- Right side: Switch -->
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="form-check form-switch form-switch-right form-switch-md">
                                                            <label for="student_history" class="form-label">Show
                                                                Inactive Student</label>
                                                            <input class="form-check-input code-switcher"
                                                                type="checkbox" id="student_history" />
                                                        </div>
                                                    </div>

                                                </div>


                                                <table id="List_Student_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                    style="width:100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Section</th>
                                                            <th>Grade Level</th>
                                                            <th>School Year</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php endif; endforeach; ?>
                                    </div> <!-- end tab-content -->
                                </div> <!-- end border -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                </div> <!-- end container-fluid -->
            </div> <!-- end page-content -->
        </div> <!-- end main-content -->




        <!-- Single Modal for Add/Edit Student -->
        <div class="modal fade" id="studentModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <form id="studentForm" enctype="multipart/form-data">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="studentModalTitle">Add Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">

                            <div class="row">

                                <div class="col-md-6 mb-2">
                                    <label>Fullname</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control" required
                                        placeholder="Enter Firstname, Lastname M.">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Age</label>
                                    <input type="number" name="age" id="age" class="form-control"
                                        placeholder="Enter Age" required>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="">Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <!-- Section Dropdown -->
                                <div class="col-md-6 mb-2">
                                    <label>Section</label>
                                    <select name="section" id="section" class="form-control" required>
                                        <option value="">Select Section</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Grade Level</label>
                                    <select id="grade_level_display" class="form-control" disabled>
                                        <option value="">Select Grade Level</option>
                                        <?php if(!empty($allowed_grades)): ?>
                                        <?php foreach($allowed_grades as $grade): ?>
                                        <option value="<?= $grade ?>"><?= $grade ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <input type="hidden" name="grade_level" id="grade_level">
                                </div>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="saveBtn">Save Student</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>


        <!-- Add/View Address Modal -->
        <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addressModalLabel">Student Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addressForm">



                            <div class="row align-items-center">
                                <!-- LEFT SIDE: PROFILE IMAGE -->
                                <div class="col-md-4 text-center">
                                    <div class="profile-user position-relative d-inline-block mb-4">
                                        <!-- IMAGE PREVIEW -->
                                        <img id="profile-preview" src="<?= base_url('assets/img/user-dummy-img.jpg') ?>"
                                            class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                            alt="user-profile-image" />

                                        <!-- FILE INPUT -->
                                        <div class="avatar-xs p-0 rounded-circle profile-photo-edit mt-2">
                                            <input id="profile-img-file-input" type="file" name="photo"
                                                class="profile-img-file-input" accept="image/*" data-user-id="" />

                                            <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                <span class="avatar-title rounded-circle bg-light text-body">
                                                    <i class="ri-camera-fill"></i>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT SIDE: FORM INPUTS -->
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="studentName" class="form-label">Student Name</label>
                                            <input type="text" class="form-control" id="studentName"
                                                value="Juan Dela Cruz">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label">Gender</label>
                                            <input type="gender" class="form-control" id="gender" value="Male">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="age" class="form-control" id="age" value="24">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                value="juandelacruz@gmail.com">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="contactNo" class="form-label">Contact No</label>
                                            <input type="text" class="form-control" id="contactNo"
                                                value="+63 9123456789">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="bloodType" class="form-label">Blood Type</label>
                                            <input type="text" class="form-control" id="bloodType" value="O+">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="motherName" class="form-label">Mother's Name</label>
                                    <input type="text" class="form-control" id="motherName" value="Jane Dela Cruz">
                                </div>
                                <div class="col-md-4">
                                    <label for="fatherName" class="form-label">Father's Name</label>
                                    <input type="text" class="form-control" id="fatherName" value="John Sr. Dela Cruz">
                                </div>
                                <div class="col-md-2">
                                    <label for="siblings" class="form-label">Total Siblings</label>
                                    <input type="number" class="form-control" id="siblings" value="2">
                                </div>
                                <div class="col-md-2">
                                    <label for="citizen" class="form-label">Citizenship</label>
                                    <input type="text" class="form-control" id="citizen" value="Filipino">
                                </div>

                            </div>


                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" value="Philippines">
                                </div>
                                <div class="col-md-3">
                                    <label for="province" class="form-label">Province</label>
                                    <input type="text" class="form-control" id="province" value="Bohol">
                                </div>
                                <div class="col-md-2">
                                    <label for="municipality" class="form-label">Municipality</label>
                                    <input type="text" class="form-control" id="municipality" value="Duero">
                                </div>
                                <div class="col-md-2">
                                    <label for="barangay" class="form-label">Barangay</label>
                                    <input type="text" class="form-control" id="barangay" value="Langkis">
                                </div>
                                <div class="col-md-2">
                                    <label for="purok" class="form-label">Purok</label>
                                    <input type="text" class="form-control" id="purok" value="Purok 1">
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="saveAddressBtn">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="TagstudentModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tag Students</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="ms-4">
                        <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3" id="sectionTabs"
                            role="tablist"></ul>
                    </div>

                    <div class="modal-body">
                        <form id="tagStudentForm">
                            <table id="studentTable"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th><input type="checkbox" id="selectAll"></th>
                                        <th>Full Name</th>
                                        <th>Section</th>
                                        <th>Grade Level</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="saveStudents" class="btn btn-primary">Tag Students</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- jQuery & DataTables scripts -->
        <script>
        $(document).ready(function() {

            var currentGrade = '';
            var currentSection = '';
            var allStudents = []; // cache all students of current grade

            // Initialize DataTable once
            var table = $('#studentTable').DataTable({
                "data": [],
                "columns": [{
                        "data": "id",
                        "render": function(data, type, row) {
                            return '<input type="checkbox" class="student-checkbox" value="' +
                                data + '" ' + (row.is_tagged ? 'checked' : '') + '>';
                        },
                        "orderable": false
                    },
                    {
                        "data": "fullname"
                    },
                    {
                        "data": "section"
                    },
                    {
                        "data": "grade_level"
                    },
                    {
                        "data": "is_tagged",
                        "render": function(data, type, row) {
                            if (data) {
                                return '<span class="badge bg-success">Already Added</span>';
                            } else {
                                return '<span class="badge bg-danger">Not Added</span>';
                            }
                        }
                    }
                ],
                "responsive": true,
                "paging": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "processing": true,
                "language": {
                    "processing": '<div class="table-loader"></div>',
                    "search": "_INPUT_",
                    "searchPlaceholder": " Search..."
                }
            });

            // Load students of current grade
            function loadGradeStudents(grade) {
                $.ajax({
                    url: "<?= base_url('StudentController/fetch_active_students') ?>",
                    type: "POST",
                    data: {
                        grade_level: grade
                    },
                    dataType: "json",
                    success: function(response) {
                        allStudents = response.data || [];
                        generateSectionTabs(allStudents);
                        filterTableBySection();
                    }
                });
            }

            // Generate section tabs
            function generateSectionTabs(data) {
                var sections = [];
                data.forEach(function(student) {
                    if (student.section && !sections.includes(student.section)) sections.push(student
                        .section);
                });
                sections.sort();

                var html = '';
                sections.forEach(function(sec, index) {
                    html += `<li class="nav-item">
                        <a class="nav-link ${index === 0 ? 'active' : ''}" data-section="${sec}" href="#">${sec}</a>
                     </li>`;
                });
                $('#sectionTabs').html(html);

                currentSection = sections.length > 0 ? sections[0] : '';
            }

            // Filter table by section
            function filterTableBySection() {
                var filtered = allStudents;
                if (currentSection) {
                    filtered = allStudents.filter(s => s.section === currentSection);
                }
                table.clear().rows.add(filtered).draw();
            }

            // When modal opens
            $('#TagstudentModal').on('shown.bs.modal', function() {
                var activeGradeTab = $('.nav-pills .nav-link.active').attr('href');
                currentGrade = activeGradeTab ? activeGradeTab.replace('#', '').replace('-student',
                    '') : '';
                currentGrade = currentGrade.replace(/([a-z]+)([0-9]+)/i, function(match, p1, p2) {
                    return p1.charAt(0).toUpperCase() + p1.slice(1) + ' ' + p2;
                });
                loadGradeStudents(currentGrade);
            });

            // Close modal
            $('#TagstudentModal').on('hidden.bs.modal', function() {
                $('#sectionTabs').empty();
                currentSection = '';
                allStudents = [];
                table.clear().draw();
                location.reload();
            });

            // Grade tab change
            $('.nav-pills .nav-link').on('shown.bs.tab', function() {
                currentGrade = $(this).attr('href').replace('#', '').replace('-student', '');
                currentGrade = currentGrade.replace(/([a-z]+)([0-9]+)/i, function(match, p1, p2) {
                    return p1.charAt(0).toUpperCase() + p1.slice(1) + ' ' + p2;
                });
                loadGradeStudents(currentGrade);
            });

            // Section tab click
            $('#sectionTabs').on('click', '.nav-link', function(e) {
                e.preventDefault();
                $('#sectionTabs .nav-link').removeClass('active');
                $(this).addClass('active');

                currentSection = $(this).data('section');
                filterTableBySection();
            });

            // Select all checkboxes
            $('#selectAll').on('click', function() {
                var rows = table.rows({
                    'search': 'applied'
                }).nodes();
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });

            // Save selected/removed students
            $('#saveStudents').on('click', function() {
                var add_ids = [];
                var remove_ids = [];

                table.rows().every(function() {
                    var data = this.data();
                    var $row = $(this.node());
                    var isChecked = $row.find('.student-checkbox').is(':checked');

                    if (isChecked && !data.is_tagged) {
                        add_ids.push(data.id);
                    } else if (!isChecked && data.is_tagged) {
                        remove_ids.push(data.id);
                    }
                });

                $.ajax({
                    url: "<?= base_url('StudentController/save_tagged_students') ?>",
                    type: "POST",
                    data: {
                        add_ids: add_ids,
                        remove_ids: remove_ids
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 'success') {
                            // Show SweetAlert instead of alert
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Student tags updated successfully.',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            table.rows().every(function() {
                                var data = this.data();
                                if (add_ids.includes(data.id)) data.is_tagged =
                                    true;
                                if (remove_ids.includes(data.id)) data.is_tagged =
                                    false;
                                this.data(data);
                            });
                            table.draw(false);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: response.message
                            });
                        }
                    }

                });
            });

        });
        </script>


        <script>
        $(document).ready(function() {

             let tables = {};
    let activeSections = {};

    // INIT DATATABLE PER TAB
    $('.tab-pane').each(function () {

        let tabPane = $(this);
        let tableEl = tabPane.find('table');
        let gradeLevel = tabPane.find('h5').text().replace(' Students', '').trim();

        tables[gradeLevel] = tableEl.DataTable({
            ajax: {
                url: "<?= site_url('StudentController/fetch_students'); ?>",
                type: "GET",
                data: function (d) {
                    d.grade_level = gradeLevel;
                    d.section = activeSections[gradeLevel] ?? null;
                    d.status = tabPane.find('#student_history').is(':checked')
                        ? 'inactive'
                        : 'active';
                }
            },
            columns: [
                { data: 'fullname' },
                { data: 'age' },
                {
                    data: 'gender',
                    render: d => d === 'Male'
                        ? `<span class="badge bg-primary">${d}</span>`
                        : `<span class="badge bg-danger">${d}</span>`
                },
                { data: 'section' },
                { data: 'grade_level' },
                {
                    data: 'school_year',
                    render: d => d ? new Date(d).getFullYear() : ''
                },
                {
                    data: 'status',
                    render: d => d === 'active'
                        ? '<span class="badge bg-success">Active</span>'
                        : '<span class="badge bg-secondary">Inactive</span>'
                }
            ],
            responsive: true,
            paging: true,
            searching: true,
            processing: true,
            language: {
                search: '',
                searchPlaceholder: ' Search...',
                processing: '<div class="table-loader"></div>'
            }
        });
    });

    // SECTION TAB CLICK = AUTO FILTER
    $(document).on('click', '#sectionTabs .nav-link', function (e) {
        e.preventDefault();

        let section = $(this).data('section');

        $('#sectionTabs .nav-link').removeClass('active');
        $(this).addClass('active');

        let tabPane = $('.tab-pane.active');
        let gradeLevel = tabPane.find('h5').text().replace(' Students', '').trim();

        activeSections[gradeLevel] = section;

        if (tables[gradeLevel]) {
            tables[gradeLevel].ajax.reload();
        }
    });

    // STATUS TOGGLE
    $(document).on('change', '#student_history', function () {
        let tabPane = $(this).closest('.tab-pane');
        let gradeLevel = tabPane.find('h5').text().replace(' Students', '').trim();

        if (tables[gradeLevel]) {
            tables[gradeLevel].ajax.reload();
        }
    });

            // Toggle Status Button
            $(document).on('click', '.toggleStatusBtn', function() {
                let btn = $(this);
                let studentId = btn.data('id');
                let currentStatus = btn.data('status');
                let newStatus = currentStatus === 'active' ? 'inactive' : 'active';

                $.ajax({
                    url: "<?= site_url('StudentController/toggle_status'); ?>",
                    type: "POST",
                    data: {
                        id: studentId,
                        status: newStatus
                    },
                    success: function(response) {
                        let res = JSON.parse(response);

                        if (res.status === 'success') {
                            let alertClass = newStatus === 'inactive' ? 'alert-success' :
                                'alert-secondary';
                            let alertText = newStatus === 'inactive' ?
                                'Student set to Inactive!' : 'Student set to Active!';

                            let alertEl = $(`
                    <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                        ${alertText}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);

                            $('#alertContainer').append(alertEl);

                            setTimeout(() => {
                                alertEl.alert('close');
                            }, 3000);

                            let tabPane = btn.closest('.tab-pane');
                            let gradeLevel = tabPane.find('h5').text().replace(' Students',
                                '').trim();

                            if (tables[gradeLevel]) {
                                tables[gradeLevel].ajax.reload(null,
                                    false);
                            }

                            btn.data('status', newStatus);
                        } else {
                            alert(res.message || 'Error updating status.');
                        }
                    },
                    error: function() {
                        alert('AJAX error. Could not update status.');
                    }
                });
            });





            // <button class="btn btn-sm btn-outline-success AddAddressBtn">
            //                             <i class="bx bx-plus-circle"></i> View / Add Info
            //                         </button>

            // Open modal on AddAddressBtn click
            // $(document).on('click', '.AddAddressBtn', function() {
            //     // Reset form and fill sample data
            //     $('#addressForm')[0].reset();
            //     $('#studentName').val('Juan Dela Cruz');
            //     $('#contactNo').val('+63 9123456789');
            //     $('#email').val('juandelacruz@gmail.com');
            //     $('#bloodType').val('O+');
            //     $('#motherName').val('Jane Dela Cruz');
            //     $('#fatherName').val('John Sr. Dela Cruz');
            //     $('#siblings').val(2);
            //     $('#citizen').val('Filipino');
            //     $('#address').val('123 Sample Street, Quezon City');
            //     $('#previewImage').attr('src', 'https://via.placeholder.com/100');

            //     // Show modal
            //     $('#addressModal').modal('show');
            // });




            // ================== HELPER: SET GRADE LEVEL ===================
            function setGradeLevel(value) {
                $('#grade_level_display').val(value);
                $('#grade_level').val(value);
            }

            // ================== INITIAL TAB SETUP ===================
            let $firstActiveTab = $('.nav-pills .nav-link.active');
            if ($firstActiveTab.length) {
                let initialGrade = $firstActiveTab.find('span').text().replace(' Students', '').trim();
                setGradeLevel(initialGrade);
                loadSections(null);
            }
            // ================== RESET MODAL ===================
            function resetStudentModal(activeGrade) {
                $('#id').val('');
                $('#fullname').val('');
                $('#age').val('');
                $('#gender').val('Male');
                setGradeLevel(activeGrade);
                $('#section').empty().append('<option value="">Select Section</option>');
                loadSections(null);
                $('#studentModalTitle').text('Add Student');
                $('#saveBtn').text('Save');
            }

            // ================== LOAD SECTIONS ===================
            function loadSections(selectedSection, callback) {
                let gradeLevel = $('#grade_level').val();
                if (!gradeLevel) return;

                $.ajax({
                    url: "<?= site_url('StudentController/get_section_by_grade'); ?>",
                    type: "GET",
                    data: {
                        grade_level: gradeLevel
                    },
                    dataType: "json",
                    success: function(res) {
                        let $section = $('#section');
                        $section.empty().append('<option value="">Select Section</option>');
                        $.each(res, function(i, item) {
                            $section.append('<option value="' + item.classrooms_name +
                                '">' + item.classrooms_name + '</option>');
                        });
                        if (selectedSection) $section.val(selectedSection);
                        if (callback) callback();
                    }
                });
            }

            // ================== TAB SWITCH ===================
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let activeGrade = $(e.target).text().replace(' Students', '').trim();
                setGradeLevel(activeGrade);
                loadSections(null);

                if (tables[activeGrade]) {
                    tables[activeGrade].ajax.reload();
                }
            });

            // ================== ADD STUDENT BUTTON ===================
            $('#addBtn').on('click', function() {
                let activeGrade = $('.nav-pills .nav-link.active span').text().replace(' Students', '')
                    .trim();
                resetStudentModal(activeGrade);
                $('#studentModalTitle').text('Add Student');
                $('#saveBtn').text('Save');
            });

            // ================== SECTION CHANGE ===================
            $('#section').on('change', function() {
                let section = $(this).val();
                if (section) {
                    $.getJSON("<?= site_url('StudentController/get_grade_level_by_section'); ?>", {
                        section
                    }, function(data) {
                        setGradeLevel(data.grade_level || '');
                    });
                }
            });

            // ================== EDIT STUDENT ===================
            // Edit button click
            $('.tab-pane').on('click', '.editBtn', function() {
                let id = $(this).data('id');
                $.getJSON("<?= site_url('StudentController/edit_student/'); ?>" + id, function(data) {
                    if (data.error) {
                        Swal.fire('Error', data.error, 'error');
                        return;
                    }

                    $('#id').val(data.id);
                    $('#fullname').val(data.fullname);
                    $('#age').val(data.age);
                    $('#gender').val(data.gender);
                    setGradeLevel(data.grade_level);

                    loadSections(data.section, function() {
                        $('#section').val(data.section);
                    });

                    $('#studentModalTitle').text('Edit Student');
                    $('#saveBtn').text('Update');
                    $('#studentModal').modal('show');
                });
            });

            // Reset modal when it is closed
            $('#studentModal').on('hidden.bs.modal', function() {
                $('#id').val('');
                $('#fullname').val('');
                $('#age').val('');
                $('#gender').val('');
                $('#grade_level').val('');
                $('#section').empty();
                $('#studentModalTitle').text('Add Student');
                $('#saveBtn').text('Save');
            });


            $('#studentModal').on('hidden.bs.modal', function() {
                let activeGrade = $('.nav-pills .nav-link.active span').text().replace(' Students', '')
                    .trim();
                resetStudentModal(activeGrade);
            });

            // ================== SAVE (ADD OR UPDATE) ===================
            $('#studentForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let url = id ? "<?= site_url('StudentController/update_student'); ?>" :
                    "<?= site_url('StudentController/add_student'); ?>";

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'duplicate') {
                            Swal.fire('Warning', 'Student already exists', 'warning');
                        } else if (res.status === 'success' || res.status === 'updated') {
                            Swal.fire('Success', 'Student saved', 'success');

                            $('#studentModal').modal('hide');

                            let activeGrade = $('.nav-pills .nav-link.active span').text()
                                .replace(' Students', '').trim();
                            if (tables[activeGrade]) {
                                tables[activeGrade].ajax.reload(null,
                                    false);
                            }

                            resetStudentModal(activeGrade);
                        } else if (res.status === 'unauthorized') {
                            Swal.fire('Error', 'You cannot edit this student', 'error');
                        } else if (res.status === 'error') {
                            Swal.fire('Error', res.message || 'Something went wrong',
                                'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Something went wrong', 'error');
                    }
                });
            });

            // ================== DELETE STUDENT ===================
            $('.tab-pane').on('click', '.deleteBtn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This student record will be permanently deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.getJSON("<?= site_url('StudentController/delete_student/'); ?>" + id,
                            function(res) {
                                if (res.status === 'unauthorized') {
                                    Swal.fire('Error', 'You cannot delete this student',
                                        'error');
                                } else {
                                    Swal.fire('Deleted!', 'Student has been deleted.',
                                        'success');
                                    Object.values(tables).forEach(t => t.ajax.reload(null,
                                        false));
                                }
                            });
                    }
                });
            });

            // ================== RELOAD TABLES WHEN MODAL CLOSES ===================
            $('#studentModal').on('hidden.bs.modal', function() {
                Object.values(tables).forEach(t => t.ajax.reload(null, false));
            });


        });
        </script>

    </div>
    </div>