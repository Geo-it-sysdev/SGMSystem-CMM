<style>
#suggestions {
    max-height: 200px;
    overflow-y: auto;
    cursor: pointer;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1050;
}

#user_setup td:nth-child(1) {
    padding: 5px 10px;
}

#user_setup td:nth-child(9) {
    padding: 6px 14px;
}
</style>


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">User Setup</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Tables</a>
                                </li>
                                <li class="breadcrumb-item active">User Setup</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card ribbon-box border shadow-none mb-4">
                        <div class="card-body">
                            <!-- Ribbon -->
                            <span class="ribbon-three ribbon-three-success">
                                <span>User List</span>
                            </span>
                            <div class="ribbon-content"></div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center mb-3">
                                <button id="add_users" class="btn btn-outline-success btn-md me-2 rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#addUserModal">
                                    <i class="ri-user-add-line me-1"></i> Add New User
                                </button>

                                <!-- Uncomment if needed -->
                                <!-- <a class="btn btn-soft-primary btn-md me-2">
                                    <i class="ri-file-pdf-fill me-2"></i> PDF
                                </a>
                                <a class="btn btn-soft-success btn-md">
                                    <i class="ri-file-excel-2-fill me-2"></i> Excel
                                </a> -->
                            </div>
                            <table id="userTable" class="table table-bordered table-striped align-middle"
                                style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>User Type</th>
                                        <th>Grade level</th>
                                        <th>Subjects</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- end container-fluid -->
    </div> <!-- end page-content -->
</div> <!-- end main-content -->

<!-- End Page-content -->

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="userForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalTitle">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Fullname</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required
                                placeholder="Enter Firstname, Lastname M.">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Username</label>
                            <input type="text" name="username" id="username" class="form-control" required
                                placeholder="Enter Username">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>User Type</label>
                            <select name="user_type" id="user_type" class="form-select" required>
                                <option value="" disabled selected>Select Type</option>
                                <option value="Admin">Admin</option>
                                <option value="Principal">Principal</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Registrar">Registrar</option>
                                <option value="Guidance Counselor">Guidance Counselor</option>
                            </select>
                        </div>

                        <!-- Grade Levels -->
                        <div id="gradeLevelContainer" class="col-md-12 mb-3" style="display:none;">
                            <label>Grade Level</label><br>
                            <input type="checkbox" name="grade[]" value="Grade 7"> Grade 7
                            <input type="checkbox" name="grade[]" value="Grade 8"> Grade 8
                            <input type="checkbox" name="grade[]" value="Grade 9"> Grade 9
                            <input type="checkbox" name="grade[]" value="Grade 10"> Grade 10
                            <input type="checkbox" name="grade[]" value="Grade 11"> Grade 11
                            <input type="checkbox" name="grade[]" value="Grade 12"> Grade 12
                        </div>

                        <!-- SHS Strand -->
                        <div id="strandContainer" class="col-md-12 mb-3" style="display:none;">
                            <label>SHS Track / Strand</label>
                            <div id="strandCheckboxes">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="strand[]"
                                        value="INDUSTRIAL_ARTS" id="strand_IA">
                                    <label class="form-check-label" for="strand_IA">Industrial Arts (IA)</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="strand[]"
                                        value="HOME_ECONOMICS" id="strand_HE">
                                    <label class="form-check-label" for="strand_HE">Home Economics (HE)</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="strand[]" value="ICT"
                                        id="strand_ICT">
                                    <label class="form-check-label" for="strand_ICT">ICT (TVL)</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="strand[]" value="ABM"
                                        id="strand_ABM">
                                    <label class="form-check-label" for="strand_ABM">ABM</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="strand[]" value="HUMSS"
                                        id="strand_HUMSS">
                                    <label class="form-check-label" for="strand_HUMSS">HUMSS</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="strand[]" value="STEM_A"
                                        id="strand_STEM">
                                    <label class="form-check-label" for="strand_STEM">STEM</label>
                                </div>

                            </div>
                        </div>

                        <!-- Subjects -->
                        <div id="subjectContainer" class="col-md-12 mb-3" style="display:none;">
                            <label>Subjects</label>
                            <div id="subjectCheckboxes"></div>
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



<script>
$(document).ready(function() {
    var table = $('#userTable').DataTable({
        ajax: {
            url: '<?= base_url("AdminController/fetch_users") ?>',
            dataSrc: ''
        },
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        processing: true,
        columns: [{
                data: 'full_name'
            },
            {
                data: 'user_name'
            },
            {
                data: 'user_type'
            },
            {
                data: 'grades'
            },
            {
                data: 'subjects'
            },
            {
                data: 'status',
                render: function(data, type, row) {
                    if (data === 'Active') {
                        return '<span class="badge bg-success">' + data + '</span>';
                    } else {
                        return '<span class="badge bg-danger">' + data + '</span>';
                    }
                }
            },
            {
                data: null,
                className: 'text-left',
                render: function(data, type, row) {
                    return `
                    <button class="btn btn-outline-primary btn-sm editBtn me-1" data-id="${row.id}">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </button>
                    <button class="btn btn-outline-danger btn-sm deleteBtn" data-id="${row.id}">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>

                    `;
                }
            }
        ],
        language: {
            search: '',
            searchPlaceholder: ' Search...',
            processing: '<div class="table-loader"></div>'
        }
    });


    // =============================
    // SUBJECT DATA
    // =============================
    var gradeSubjects = {
        "Grade 7": ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP",
            "TLE"
        ],
        "Grade 8": ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP",
            "TLE"
        ],
        "Grade 9": ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP",
            "TLE"
        ],
        "Grade 10": ["Filipino", "English", "Mathematics", "Science", "Araling Panlipunan", "MAPEH", "ESP",
            "TLE"
        ],

        // Senior High Core
        "SHS Core": [
            "Oral Communication", "Reading and Writing", "Komunikasyon at Pananaliksik",
            "Pagbasa at Pagsusuri", "21st Century Literature", "Contemporary Philippine Arts",
            "Media and Information Literacy", "General Mathematics", "Statistics and Probability",
            "Earth and Life Science", "Physical Science", "Personal Development",
            "Understanding Culture Society and Politics", "Physical Education & Health (PEH)",
            "Empowerment Technologies (E-Tech)", "Filipino sa Piling Larangan",
            "Practical Research 1", "Practical Research 2", "Inquiries Investigations & Immersion",
            "Entrepreneurship"
        ]
    };

    var strandSubjects = {
        INDUSTRIAL_ARTS: ["Welding", "Automotive Servicing", "Electrical Installation", "Carpentry"],
        HOME_ECONOMICS: ["Cookery", "Bread & Pastry", "Housekeeping", "Food & Beverage Services"],
        ICT: ["Computer Systems Servicing (CSS)", "Programming", "Data Communication",
            "Computer Networking"],
        ABM: ["Business Math", "Business Finance", "Organization & Management", "Principles of Marketing",
            "Applied Economics", "Business Ethics & Social Responsibility"
        ],
        HUMSS: ["Creative Writing", "Creative Nonfiction", "Introduction to World Religions",
            "Philippine Politics and Governance", "Social Science 1", "Social Science 2"
        ],
        STEM_A: ["Pre-Calculus", "Basic Calculus", "General Biology 1", "General Biology 2",
            "General Physics 1", "General Physics 2", "General Chemistry 1", "General Chemistry 2"
        ]
    };

    // =============================
    // UPDATE SUBJECT CHECKBOX LIST
    // =============================
    function updateSubjects() {

        // Get checked grade levels
        var selectedGrades = $('input[name="grade[]"]:checked').map(function() {
            return $(this).val().trim();
        }).get();

        // Get checked strands
        var selectedStrands = $('input[name="strand[]"]:checked').map(function() {
            return $(this).val().trim();
        }).get();

        var allSubjects = [];

        // Add Junior High subjects
        selectedGrades.forEach(function(grade) {
            if (gradeSubjects[grade]) {
                allSubjects = allSubjects.concat(gradeSubjects[grade]);
            }

            // SHS core subjects only for G11 & G12
            if (grade === "Grade 11" || grade === "Grade 12") {
                allSubjects = allSubjects.concat(gradeSubjects["SHS Core"]);
            }
        });

        // Add strand subjects
        selectedStrands.forEach(function(strand) {
            if (strandSubjects[strand]) {
                allSubjects = allSubjects.concat(strandSubjects[strand]);
            }
        });

        // Remove duplicates
        allSubjects = [...new Set(allSubjects)];

        // Preserve previously checked subjects
        var previouslyChecked = $('input[name="subjects[]"]:checked').map(function() {
            return $(this).val().trim().toLowerCase();
        }).get();

        var container = $('#subjectCheckboxes');
        container.empty();

        if (allSubjects.length > 0) {
            $('#subjectContainer').slideDown();

            var row = $('<div class="row"></div>');

            allSubjects.forEach(function(sub) {
                var id = sub.replace(/\s+/g, '');
                var isChecked = previouslyChecked.includes(sub.toLowerCase()) ? "checked" : "";

                row.append(`
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="subjects[]" value="${sub}" id="subject_${id}" ${isChecked}>
                        <label class="form-check-label" for="subject_${id}">${sub}</label>
                    </div>
                </div>
            `);
            });

            container.append(row);
        } else {
            $('#subjectContainer').slideUp();
        }
    }

    // =============================
    // EVENT HANDLERS
    // =============================

    // User Type selection
    $('#user_type').on('change', function() {
        var allowed = ["Teacher", "Registrar", "Guidance Counselor"];
        var type = $(this).val();

        if (allowed.includes(type)) {
            $('#gradeLevelContainer').slideDown();
        } else {
            $('#gradeLevelContainer, #strandContainer, #subjectContainer').slideUp();
            $('input[name="grade[]"], input[name="strand[]"]').prop('checked', false);
            $('#subjectCheckboxes').empty();
        }
    });

    // Grade selection
    $(document).on('change', 'input[name="grade[]"]', function() {

        var isSHS = $('input[name="grade[]"][value="Grade 11"]').is(":checked") ||
            $('input[name="grade[]"][value="Grade 12"]').is(":checked");

        if (isSHS) {
            $('#strandContainer').slideDown();
        } else {
            $('#strandContainer').slideUp();
            $('input[name="strand[]"]').prop('checked', false);
        }

        updateSubjects();
    });

    // Strand selection
    $(document).on('change', 'input[name="strand[]"]', function() {
        updateSubjects();
    });

    // Add User Modal
    $('#add_users').on('click', function() {
        $('#userForm')[0].reset();
        $('#id').val('');
        $('#addUserModalTitle').text('Add User');
        $('#saveBtn').text('Save');
        $('#gradeLevelContainer, #strandContainer, #subjectContainer').hide();
        $('input[name="grade[]"], input[name="strand[]"]').prop('checked', false);
        $('#subjectCheckboxes').empty();
    });

    // =============================
    // EDIT USER BUTTON
    // =============================
    $('#userTable').on('click', '.editBtn', function() {
        var id = $(this).data("id");

        $.ajax({
            url: "<?= base_url('AdminController/get_user_by_id/') ?>" + id,
            type: "GET",
            dataType: "json",
            success: function(user) {

                $('#id').val(user.id);
                $('#full_name').val(user.full_name);
                $('#username').val(user.user_name);
                $('#user_type').val(user.user_type);

                $('input[name="grade[]"], input[name="strand[]"]').prop('checked', false);
                $('#strandContainer, #subjectContainer').hide();
                $('#subjectCheckboxes').empty();

                $('#gradeLevelContainer').show();

                // Load Grades
                var grades = user.grades ? user.grades.split(",") : [];
                grades.forEach(g => {
                    $('input[name="grade[]"][value="' + g.trim() + '"]').prop(
                        "checked", true);
                });

                // Load Strands only if G11 or G12
                if ((grades.includes("Grade 11") || grades.includes("Grade 12")) && user
                    .strand) {
                    $('#strandContainer').show();
                    user.strand.split(",").forEach(s => {
                        $('input[name="strand[]"][value="' + s.trim() + '"]').prop(
                            "checked", true);
                    });
                }

                // Update subjects after rendering
                $('input[name="grade[]"], input[name="strand[]"]').trigger('change');

                // Load subjects after subjects have been generated
                if (user.subjects) {
                    setTimeout(() => {
                        user.subjects.split(",").forEach(sub => {
                            $('input[name="subjects[]"]').each(function() {
                                if ($(this).val().trim()
                                    .toLowerCase() === sub.trim()
                                    .toLowerCase()) {
                                    $(this).prop("checked", true);
                                }
                            });
                        });
                    }, 80);
                }

                $('#addUserModalTitle').text("Edit User");
                $('#saveBtn').text("Update");
                $('#addUserModal').modal("show");
            }
        });
    });



    // ======== SAVE USER ========
    $('#userForm').on('submit', function(e) {
        e.preventDefault();

        var id = $('#id').val();
        var url = id ? "<?= base_url('AdminController/update_user') ?>" :
            "<?= base_url('AdminController/add_user') ?>";

        var grades = [];
        $('input[name="grade[]"]:checked').each(function() {
            grades.push($(this).val());
        });

        var subjects = [];
        $('input[name="subjects[]"]:checked').each(function() {
            subjects.push($(this).val());
        });

        $.ajax({
            url: url,
            type: "POST",
            data: {
                id: id,
                full_name: $('#full_name').val(),
                username: $('#username').val(),
                user_type: $('#user_type').val(),
                strand: $('#strand').val(),
                grade: grades,
                subjects: subjects
            },
            dataType: "json",
            success: function(res) {
                if (res.status === "success") {
                    $('#addUserModal').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire("Success", res.message, "success");
                } else {
                    Swal.fire("Error", res.message, "error");
                }
            }
        });
    });





    // Delete User
    $('#userTable').on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("AdminController/delete_user/") ?>' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            table.ajax.reload(null, false);
                            Swal.fire(
                                'Deleted!',
                                'User has been deleted.',
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'Error!',
                                'Error deleting user.',
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Failed!',
                            'Failed to delete user.',
                            'error'
                        );
                    }
                });
            }
        });
    });

});
</script>