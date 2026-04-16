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
                                                            class="btn btn-outline-success btn-border add-btn rounded-pill"
                                                            data-bs-toggle="modal" data-bs-target="#studentModal">
                                                            <i class="ri-add-line align-bottom me-1"></i>Add Student
                                                        </button>
                                                        <?php endif; ?>

                                                        <?php if ($user_type === 'Teacher'): ?>
                                                        <button type="button"
                                                            class="btn btn-outline-success add-btn rounded-pill btn-border"
                                                            data-bs-toggle="modal" data-bs-target="#TagstudentModal">
                                                            <i class="ri-add-line align-bottom me-1"></i>Tag Student
                                                        </button>
                                                        <?php endif; ?>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-outline-primary dropdown-toggle rounded-pill btn-border"
                                                                type="button" id="filterDropdown_<?= $grade_id ?>"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ri-filter-line align-bottom me-1"></i> Filter
                                                                Sections
                                                            </button>
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
                                                        <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'): ?>
                                                            <th>Action</th>
                                                        <?php endif; ?> 
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

                               <!-- Grade Level Dropdown (user can select freely) -->
<div class="col-md-6 mb-2">
    <label>Grade Level</label>
    <select id="grade_level_display" class="form-select">
        <option value="">Select Grade Level</option>
        <?php if(!empty($allowed_grades)): ?>
            <?php foreach($allowed_grades as $grade): ?>
                <option value="<?= $grade ?>"><?= $grade ?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <input type="hidden" name="grade_level" id="grade_level">
</div>

<!-- Section Dropdown -->
<div class="col-md-6 mb-2">
    <label>Section</label>
    <select name="section" id="section" class="form-select" required>
        <option value="">Select Section</option>
    </select>
</div>


                               

                            </div>
                        </div>

                        <div class="modal-footer">
                          <button type="submit" class="btn btn-outline-primary btn-border" id="saveBtn">
                            <i class="ri-save-line me-1"></i> Save Student
                        </button>

                        <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">
                            <i class="ri-close-circle-line me-1"></i> Cancel
                        </button>

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
                      <button type="button" id="saveStudents" class="btn btn-outline-primary btn-border">
                            <i class="ri-user-add-line me-1"></i> Tag Students
                        </button>

                        <button type="button" class="btn btn-outline-danger btn-border" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1"></i> Close
                        </button>

                    </div>
                </div>
            </div>
        </div>





    </div>
    </div>