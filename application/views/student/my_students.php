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

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="border">
                                    <!-- ================= NAV PILLS ================= -->
                                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3 flex-wrap">
                                        <?php
                            $all_grades = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];
                            $is_all = in_array('All', $grade_levels);
                            $active_set = false; // Track first active tab

                            foreach ($all_grades as $grade):
                                if ($is_all || in_array($grade, $grade_levels)):
                                    $grade_id = strtolower(str_replace(' ', '', $grade)); // e.g., grade7
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
                                                    <!-- Left side: Add Button -->
                                                    <div>
                                                        <button type="button"
                                                            class="btn btn-outline-success add-btn rounded-pill"
                                                            id="addBtn" data-bs-toggle="modal"
                                                            data-bs-target="#studentModal">
                                                            <i class="ri-add-line align-bottom me-1"></i>Add Student
                                                        </button>
                                                    </div>

                                                    <!-- Right side: Switch -->
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="form-check form-switch form-switch-right form-switch-md">
                                                            <label for="student-inactive" class="form-label">Show
                                                                Inactive Student</label>
                                                            <input class="form-check-input code-switcher"
                                                                type="checkbox" id="student-inactive" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <table id="List_Student_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                    style="width:100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th><input type="checkbox" id="selectAll"></th>
                                                            <th>Student Name</th>
                                                            <th>Age</th>
                                                            <th>Gender</th>
                                                            <th>Section</th>
                                                            <th>Grade Level</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                                <div class="mt-2">
                                                    <button id="toggleStatusBtn" class="btn"
                                                        style="display:none;"></button>
                                                </div>

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
                                        placeholder="Enter Age">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Section</label>
                                    <select name="section" id="section" class="form-control">
                                        <option value="">Select Section</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Grade Level</label>
                                    <select name="grade_level" id="grade_level" class="form-control">
                                        <option value="" selected disabled>Select Grade Level</option>
                                        <?php if(!empty($allowed_grades)): ?>
                                        <?php foreach($allowed_grades as $grade): ?>
                                        <option value="<?= $grade ?>"><?= $grade ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>



                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="saveBtn">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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




        <script>
        $(document).ready(function() {
            let tables = {};

            // ================== INITIALIZE DATATABLES ===================
            $('.tab-pane').each(function() {
                let tabPane = $(this);
                let tableEl = tabPane.find('table');
                let gradeLevel = tabPane.find('h5').text().replace(' Students', '').trim();

                let table = tableEl.DataTable({
                    ajax: {
                        url: "<?= site_url('StudentController/fetch_students'); ?>",
                        type: "GET",
                        data: function(d) {
                            d.grade_level = gradeLevel;
                            d.show_inactive = $('#student-inactive').is(':checked') ? 1 :
                                0; // add status param
                        }
                    },
                    columns: [{
                            data: null,
                            orderable: false,
                            render: function(data) {
                                return `<input type="checkbox" class="rowCheckbox" data-id="${data.id}">`;
                            }
                        },
                        {
                            data: 'fullname'
                        },
                        {
                            data: 'age'
                        },
                        {
                            data: 'gender',
                            render: function(data) {
                                if (data === 'Male')
                                    return `<span class="badge bg-primary"><i class="bi bi-person-fill"></i> ${data}</span>`;
                                if (data === 'Female')
                                    return `<span class="badge bg-danger"><i class="bi bi-person"></i> ${data}</span>`;
                                return data;
                            }
                        },
                        {
                            data: 'section'
                        },
                        {
                            data: 'grade_level'
                        },
                        {
                            data: null,
                            render: function(data) {
                                let buttons = '';
                                let userType =
                                    "<?= $this->session->userdata('user_type'); ?>";
                                let currentUser =
                                    <?= $this->session->userdata('po_user'); ?>;
                                if (['Principal', 'Guidance Counselor', 'Registrar']
                                    .includes(userType) || data.user_id == currentUser
                                ) {
                                    buttons += `
                            <button class="btn btn-sm btn-outline-primary editBtn" data-id="${data.id}">
                                <i class="bx bx-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-outline-danger deleteBtn" data-id="${data.id}">
                                <i class="bx bx-trash"></i> Delete
                            </button>
                        `;
                                }
                                return buttons;
                            }
                        }
                    ],
                    responsive: true,
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    processing: true,
                    language: {
                        search: '',
                        searchPlaceholder: ' Search...',
                        processing: '<div class="table-loader"></div>'
                    }
                });

                // Reload table on switch toggle
                $('#student-inactive').on('change', function() {
                    table.ajax.reload();
                });

                tables[gradeLevel] = table;
            });




            // <button class="btn btn-sm btn-outline-success AddAddressBtn">
            //                             <i class="bx bx-plus-circle"></i> View / Add Info
            //                         </button>


            // Checkbox click -> show/hide toggle button
            $(document).on('change', '.rowCheckbox', updateToggleButton);

            // Select All checkbox
            $(document).on('change', '.selectAll', function() {
                let checked = $(this).is(':checked');
                $(this).closest('table').find('.rowCheckbox').prop('checked', checked).trigger(
                'change');
            });

            // Update toggle button dynamically
            function updateToggleButton() {
                let checkedRows = $('.rowCheckbox:checked');
                if (checkedRows.length === 0) {
                    $('#toggleStatusBtn').hide();
                    return;
                }

                let allActive = true;
                let allInactive = true;

                checkedRows.each(function() {
                    let status = $(this).data('status');
                    if (status === 'active') allInactive = false;
                    if (status === 'inactive') allActive = false;
                });

                if (allActive) {
                    $('#toggleStatusBtn')
                        .text('Make Inactive')
                        .removeClass('btn-success')
                        .addClass('btn-danger')
                        .data('new-status', 'inactive')
                        .show();
                } else if (allInactive) {
                    $('#toggleStatusBtn')
                        .text('Make Active')
                        .removeClass('btn-danger')
                        .addClass('btn-success')
                        .data('new-status', 'active')
                        .show();
                } else {
                    $('#toggleStatusBtn').hide(); // mixed selection
                }
            }

            // Button click -> toggle status
            $('#toggleStatusBtn').on('click', function() {
                let ids = [];
                let newStatus = $(this).data('new-status');

                $('.rowCheckbox:checked').each(function() {
                    ids.push($(this).data('id'));
                });

                if (ids.length === 0) return;

                if (confirm(`Are you sure you want to make these students ${newStatus}?`)) {
                    $.ajax({
                        url: "<?= site_url('StudentController/toggle_status'); ?>",
                        type: "POST",
                        data: {
                            ids: ids,
                            status: newStatus
                        },
                        success: function(res) {
                            res = JSON.parse(res);
                            if (res.status === 'success') {
                                alert(`Selected students are now ${newStatus}.`);
                                Object.values(tables).forEach(tbl => tbl.ajax.reload(null,
                                    false));
                                $('#toggleStatusBtn').hide();
                                $('.selectAll').prop('checked', false);
                            } else {
                                alert('Error: ' + res.message);
                            }
                        },
                        error: function() {
                            alert('AJAX request failed.');
                        }
                    });
                }
            });


            // Open modal on AddAddressBtn click
            $(document).on('click', '.AddAddressBtn', function() {
                // Reset form and fill sample data
                $('#addressForm')[0].reset();
                $('#studentName').val('Juan Dela Cruz');
                $('#contactNo').val('+63 9123456789');
                $('#email').val('juandelacruz@gmail.com');
                $('#bloodType').val('O+');
                $('#motherName').val('Jane Dela Cruz');
                $('#fatherName').val('John Sr. Dela Cruz');
                $('#siblings').val(2);
                $('#citizen').val('Filipino');
                $('#address').val('123 Sample Street, Quezon City');
                $('#previewImage').attr('src', 'https://via.placeholder.com/100');

                // Show modal
                $('#addressModal').modal('show');
            });


            // ================== RESET MODAL ===================
            function resetStudentModal(activeGrade) {
                $('#grade_level').val(activeGrade);
                $('#id').val('');
                $('#fullname').val('');
                $('#age').val('');
                $('#gender').val('');
                $('#contact_no').val('');
                $('#gmail').val('');

                // Load sections for this grade only
                $.ajax({
                    url: "<?= site_url('StudentController/get_section_by_grade'); ?>",
                    type: "GET",
                    data: {
                        grade_level: activeGrade
                    },
                    dataType: "json",
                    success: function(data) {
                        let $section = $('#section');
                        $section.empty().append('<option value="">Select Section</option>');
                        $.each(data, function(i, item) {
                            $section.append('<option value="' + item.classrooms_name +
                                '">' + item.classrooms_name + '</option>');
                        });
                    }
                });
            }

            // ================== TAB SWITCH EVENT ===================
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let activeGrade = $(e.target).text().replace(' Students', '').trim();
                if (tables[activeGrade]) {
                    tables[activeGrade].ajax.reload();
                }
                resetStudentModal(activeGrade);
            });

            // ================== ADD STUDENT BUTTON ===================
            $('#addBtn').on('click', function() {
                let activeGrade = $('.nav-pills .nav-link.active span').text().replace(' Students', '')
                    .trim();
                resetStudentModal(activeGrade);
                $('#studentModalTitle').text('Add Student');
                $('#saveBtn').text('Save');
            });

            // ================== AUTO-FILL GRADE AFTER SECTION CHANGE ===================
            $('#section').on('change', function() {
                let section = $(this).val();
                if (section) {
                    $.getJSON("<?= site_url('StudentController/get_grade_level_by_section'); ?>", {
                        section
                    }, function(data) {
                        $('#grade_level').val(data.grade_level || '');
                    });
                }
            });

            // ================== LOAD SECTIONS ===================
            function loadSections(selectedSection, callback) {
                let gradeLevel = $('#grade_level').val();
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
                        if (selectedSection) {
                            $section.val(selectedSection);
                        }
                        if (callback) callback();
                    }
                });
            }

            // ================== EDIT STUDENT ===================
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
                    $('#contact_no').val(data.contact_no);
                    $('#gmail').val(data.gmail);
                    $('#grade_level').val(data.grade_level);

                    loadSections(data.section, function() {
                        $('#section').val(data.section);
                    });

                    $('#studentModalTitle').text('Edit Student');
                    $('#saveBtn').text('Update');
                    $('#studentModal').modal('show');
                });
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
                        $('#studentModal').modal('hide');
                        $('#studentForm')[0].reset();

                        if (res.status === 'duplicate') {
                            Swal.fire('Warning', 'Student already exists', 'warning');
                        } else if (res.status === 'success' || res.status === 'updated') {
                            Swal.fire('Success', 'Student saved', 'success');
                            Object.values(tables).forEach(t => t.ajax.reload(null, false));
                        } else if (res.status === 'unauthorized') {
                            Swal.fire('Error', 'You cannot edit this student', 'error');
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