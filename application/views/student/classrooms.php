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
                        <h4 class="mb-sm-0">My Classrooms</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript: void(0);">Tables</a>
                                </li>
                                <li class="breadcrumb-item active">My Classrooms</li>
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
                                <span>Classrooms List</span>
                            </span>
                            <div class="ribbon-content"></div>
                        </div>
                        <br>

                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center mb-3">


                                <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">

                                    <!-- Add Classroom Button -->
                                    <button id="addClassroomBtn" class="btn btn-outline-success btn-border btn-md rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#classroomModal">
                                        <i class="ri-building-2-fill"></i> Add Classroom
                                    </button>

                                </div>


                            </div>
                            <table id="classroomTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                    style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name of Classrooms</th>
                                        <th>Grade Level</th>
                                        <th>Description</th>
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


<!-- ADD/EDIT MODAL -->
<div class="modal fade" id="classroomModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Classroom</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="classroomForm">
                <div class="modal-body">
                    <input type="hidden" name="rooms_id" id="rooms_id">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Classroom Name</label>
                        <input type="text" class="form-control" name="classrooms_name" required
                            placeholder="Enter Name Classrooms">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Grade Level</label>
                        <select name="grade_level" class="form-select" required>
                            <option value="">Select Grade Level</option>
                            <option value="Grade 7">Grade 7</option>
                            <option value="Grade 8">Grade 8</option>
                            <option value="Grade 9">Grade 9</option>
                            <option value="Grade 10">Grade 10</option>
                            <option value="Grade 11">Grade 11</option>
                            <option value="Grade 12">Grade 12</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description (Optional)</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="saveBtn" class="btn btn-outline-success btn-border"><i class="ri-save-line"></i> Save</button>
                    <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">   <i class="ri-close-line"></i> Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script>
$(document).ready(function() {
    var table = $('#classroomTable').DataTable({
        ajax: "<?= site_url('StudentController/fetch_classrooms'); ?>",
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
        },
        columns: [{
                data: 'classrooms_name'
            },
            {
                data: 'grade_level'
            },
            {
                data: 'description'
            },
            {
                data: null,
                className: "text-left",
                render: function(data) {
                    return `
                        <button class="btn btn-sm btn-outline-primary editBtn " data-id="${data.rooms_id}">
                            <i class="bx bx-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-outline-danger deleteBtn" data-id="${data.rooms_id}">
                            <i class="bx bx-trash"></i> Delete
                        </button>
                    `;
                }
            }
        ]
    });

    // Add button
    $('#addClassroomBtn').on('click', function() {
        $('#modalTitle').text('Add Classroom');
        $('#classroomForm')[0].reset();
        $('#rooms_id').val('');
    });

    // Save / Update
    $('#classroomForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('StudentController/save_classroom'); ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(res) {
                if (res.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Classroom saved successfully!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#classroomModal').modal('hide');
                    table.ajax.reload();
                } else if (res.status === 'duplicate') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Duplicate!',
                        text: 'This classroom name already exists.',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Error saving data.',
                    });
                }
            }

        });
    });

    // Edit button
    $('#classroomTable').on('click', '.editBtn', function() {
        var id = $(this).data('id');
        $.get("<?= site_url('StudentController/get_classroom_by_id/'); ?>" + id, function(data) {
            $('#modalTitle').text('Edit Classroom');
            $('input[name="rooms_id"]').val(data.rooms_id);
            $('input[name="classrooms_name"]').val(data.classrooms_name);
            $('select[name="grade_level"]').val(data.grade_level);
            $('textarea[name="description"]').val(data.description);
            $('#classroomModal').modal('show');
        }, 'json');
    });

    // Delete button with Swal confirmation
    $('#classroomTable').on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This classroom will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('StudentController/delete_classroom/'); ?>" + id,
                    type: "POST",
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Classroom has been deleted.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            table.ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Delete failed.',
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>