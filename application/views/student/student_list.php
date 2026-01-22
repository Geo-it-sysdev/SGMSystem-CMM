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
                                <h4 class="mb-sm-0">Student Setup </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables </a></li>
                                        <li class="breadcrumb-item active">Student Setup </li>
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
                                    <!-- ================= GRADE NAVIGATION ================= -->
                                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3 flex-wrap">
                                        <?php
        $user_id = $this->session->userdata("po_user");
        $grades = $this->session->userdata("grades"); 
        $user = isset($user_id) ? $this->AuthModel->get_user_by_user_id($user_id) : null;
        $user_grades = $grades ? array_map('trim', explode(',', $grades)) : [];
        $user_type = $user->user_type ?? '';
        $grade_order = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12'];
        $active_grade = in_array($user_type, ['Admin','Principal']) ? 'Grade 7' : ($user_grades[0] ?? 'Grade 7');
    ?>

                                        <?php foreach ($grade_order as $g): ?>
                                        <?php if (in_array($user_type, ['Admin','Principal']) || (in_array($user_type, ['Teacher','Registrar','Guidance Counselor']) && in_array($g, $user_grades))): ?>
                                        <li class="nav-item">
                                            <a href="#"
                                                class="nav-link d-flex align-items-center justify-content-start custom-no-hover <?= ($active_grade === $g) ? 'active' : '' ?>"
                                                data-grade="<?= $g ?>" style="width:180px;">
                                                <i class="ri-team-line me-2"></i>
                                                <span><?= $g ?> Students</span>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>

                                    <!-- ================= MAIN CARD ================= -->
                                    <div class="card-body">
                                        <div class="d-flex align-items-center gap-2 mb-3">
                                            <button type="button" class="btn btn-outline-success rounded-pill"
                                                id="addBtn" data-bs-toggle="modal" data-bs-target="#studentModal">
                                                <i class="ri-add-line align-bottom me-1"></i>Add Student
                                            </button>

                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle rounded-pill"
                                                    type="button" id="filterButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="ri-filter-3-line"></i> Filter Section
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="filterButton">
                                                    <?php for ($i = 1; $i <= 4; $i++): ?>
                                                    <li><a class="dropdown-item" href="#"
                                                            onclick="setFilter('Section <?= $i ?>')">Section
                                                            <?= $i ?></a></li>
                                                    <?php endfor; ?>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <div class="d-flex justify-content-center mt-2 mb-2">
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            onclick="clearFilter()">Clear Filter</button>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>

                                        <!-- Dynamic Student Table -->
                                        <table id="studentTable"
                                            class="table table-bordered nowrap table-striped align-middle"
                                            style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Student Name</th>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th>Grade</th>
                                                    <th>Section</th>
                                                    <th>Contact No.</th>
                                                    <th>Gmail</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>









                                </div> <!-- end border -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->








                    <!-- Modal Form -->
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
                                                <input type="text" name="fullname" id="fullname" class="form-control"
                                                    required placeholder="Enter Firstname, Lastname M.">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Age</label>
                                                <input type="number" name="age" id="age" class="form-control" required
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
                                                <input type="text" name="section" id="section" class="form-control"
                                                    placeholder="Enter Section">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Contact No</label>
                                                <input type="text" name="contact_no" id="contact_no"
                                                    class="form-control" placeholder="Enter Contact No.">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Gmail</label>
                                                <input type="email" name="gmail" id="gmail" class="form-control"
                                                    placeholder="Enter Gmail">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" id="saveBtn">Save</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <script>
                    $(document).ready(function() {
                        var table = $('#studentTableG8').DataTable({
                            ajax: "<?= site_url('StudentController/fetch_students'); ?>",
                            columns: [{
                                    data: 'fullname'
                                },
                                {
                                    data: 'age'
                                },
                                {
                                    data: 'gender'
                                },
                                {
                                    data: 'section'
                                },
                                {
                                    data: 'contact_no'
                                },
                                {
                                    data: 'gmail'
                                },
                                {
                                    data: null,
                                    render: function(data) {
                                        return `
                        <button class="btn btn-sm btn-outline-info editBtn me-2" data-id="${data.id}">
                            <i class="ri-edit-line"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger deleteBtn" data-id="${data.id}">
                            <i class="ri-delete-bin-line"></i> Delete
                        </button>
                    `;
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

                        // ADD STUDENT
                        $('#addBtn').click(function() {
                            $('#studentForm')[0].reset();
                            $('#id').val('');
                            $('#studentModalTitle').text('Add Student');
                            $('#saveBtn').text('Save');
                        });

                        // EDIT STUDENT
                        $('#studentTableG8').on('click', '.editBtn', function() {
                            var id = $(this).data('id');

                            $.getJSON("<?= site_url('StudentController/edit_student/'); ?>" + id,
                                function(data) {
                                    $('#id').val(data.id);
                                    $('#fullname').val(data.fullname);
                                    $('#age').val(data.age);
                                    $('#gender').val(data.gender);
                                    $('#section').val(data.section);
                                    $('#contact_no').val(data.contact_no);
                                    $('#gmail').val(data.gmail);

                                    $('#studentModalTitle').text('Edit Student');
                                    $('#saveBtn').text('Update');
                                    $('#studentModal').modal('show');
                                });
                        });

                        // SAVE (ADD/EDIT) STUDENT
                        $('#studentForm').on('submit', function(e) {
                            e.preventDefault();
                            var formData = new FormData(this);
                            var id = $('#id').val();
                            var url = id ?
                                "<?= site_url('StudentController/update_student'); ?>" :
                                "<?= site_url('StudentController/add_student'); ?>";

                            $.ajax({
                                url: url,
                                type: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                success: function(response) {
                                    if (response.status === 'duplicate') {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Duplicate Entry!',
                                            text: 'This student already exists.',
                                            confirmButtonColor: '#f39c12'
                                        });
                                    } else if (response.status === 'success' || response
                                        .status === 'updated') {
                                        $('#studentModal').modal('hide');
                                        $('#studentForm')[0].reset();
                                        table.ajax.reload();

                                        Swal.fire({
                                            icon: 'success',
                                            title: id ? 'Student Updated!' :
                                                'Student Added!',
                                            text: id ?
                                                'The student information has been updated successfully.' :
                                                'A new student has been added successfully.',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Operation Failed!',
                                            text: 'Please try again.',
                                            confirmButtonColor: '#d33'
                                        });
                                    }
                                },
                                error: function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'Something went wrong. Please check the console for details.',
                                        confirmButtonColor: '#d33'
                                    });
                                }
                            });
                        });

                        $('#studentModal').on('hidden.bs.modal', function() {
                            $('#studentForm')[0].reset();
                            table.ajax.reload(null, false);
                        });



                        // DELETE STUDENT
                        $('#studentTableG8').on('click', '.deleteBtn', function() {
                            var id = $(this).data('id');

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "This student record will be permanently deleted.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.get("<?= site_url('StudentController/delete_student/'); ?>" +
                                        id,
                                        function() {
                                            table.ajax.reload();
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Deleted!',
                                                text: 'The student has been deleted successfully.',
                                                showConfirmButton: false,
                                                timer: 1500
                                            });
                                        });
                                }
                            });
                        });
                    });










                    let selectedFilter = '';

                    function setFilter(filter) {
                        selectedFilter = filter;
                        const button = document.getElementById('filterG11Button');

                        if (!filter) {
                            button.innerHTML = `<i class="ri-filter-3-line"></i> Filter Section`;
                        } else {
                            button.innerHTML = `<i class="ri-filter-3-line"></i> ${filter}`;
                        }

                        const dropdown = bootstrap.Dropdown.getOrCreateInstance(button);
                        dropdown.hide();

                        // ✅ Reload DataTable with new filter
                        if (window.studentTableG8) {
                            window.studentTableG8.ajax.reload(null, false);
                        }
                    }

                    // ✅ Clear filter — resets button & filter
                    function clearFilter() {
                        selectedFilter = '';
                        const button = document.getElementById('filterG11Button');
                        button.innerHTML = `<i class="ri-filter-3-line"></i> Filter Section`;

                        const dropdown = bootstrap.Dropdown.getOrCreateInstance(button);
                        dropdown.hide();

                        if (window.studentTableG8) {
                            window.studentTableG8.ajax.reload(null, false);
                        }
                    }
                    </script>
                </div>
            </div>