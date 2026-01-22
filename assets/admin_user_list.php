<!-- DataTables Bootstrap 5 CSS -->
<link href="<?= base_url('assets/new/css/dataTables.bootstrap5.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/new/css/choices.min.css') ?>" />
<script src="<?= base_url('assets/new/js/choices.min.js') ?>"></script>


<style>
.custom-dropdown {
    position: relative;
    width: 250px;
}

.dropdown-display {
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 8px 12px;
    background-color: #fff;
    cursor: pointer;
}

.dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    border: 1px solid #ced4da;
    border-top: none;
    background-color: white;
    max-height: 200px;
    overflow-y: auto;
    display: none;
    z-index: 1000;
}

.dropdown-list.show {
    display: block;
}

.dropdown-item {
    padding: 8px 12px;
    cursor: pointer;
}

.dropdown-item:hover {
    background-color: #f1f1f1;
}

.dropdown-search {
    padding: 8px 12px;
    border-bottom: 1px solid #ccc;
}


.dropdown-list {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    max-height: 250px;
    overflow-y: auto;
    z-index: 1000;
    width: 220px;
}

.dropdown-list.show {
    display: block;
}

.dropdown-item {
    padding: 8px 12px;
    cursor: pointer;
}

.dropdown-item:hover {
    background-color: #f1f1f1;
}

.dropdown-search {
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

#clearSelection {
    font-weight: bold;
    color: #fff;
}

#clearSelection:hover {
    color: red;
}
</style>


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
                        <h4 class="mb-sm-0"></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables </a></li>
                                <li class="breadcrumb-item active">User List </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="col-xxl-12">
                <div class="card ribbon-box border shadow-none mb-4">
                    <div class="card-body">
                        <span class="ribbon-three ribbon-three-success"><span>USER LIST</span></span>
                        <br><br>
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3 gap-2">

                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <button id="add_users" class="btn btn-soft-success btn-md me-2" data-bs-toggle="modal"
                                    data-bs-target="#addUserModal">
                                    <i class="ri-user-add-line me-1"></i> Add New User
                                </button>

                                <form method="get" action="<?= base_url('Admin_ctrl/admin_users_list'); ?>">
                                    <div class="custom-dropdown" id="customDropdown">
                                       <div class="btn btn-soft-secondary btn-md form-control d-flex justify-content-between align-items-center"
                                            id="dropdownDisplay" style="width: 235px; margin-right: 10px;">
                                            <span id="displayText">
                                                <i class="ri-filter-line me-1"></i>
                                                <?= !empty($selected_type) ? $selected_type : 'Filter User Type' ?>
                                            </span>
                                            <span id="clearSelection"
                                                style="display: <?= !empty($selected_type) ? 'inline' : 'none' ?>; cursor: pointer; margin-left: 10px;">&times;</span>
                                        </div>

                                        <div class="dropdown-list" id="dropdownList"
                                            style="display: none; position: absolute; background: white; border: 1px solid #ccc; width: 235px; z-index: 999;">
                                            <div class="dropdown-search p-1">
                                                <input type="text" class="form-control" id="dropdownSearch"
                                                    placeholder="Search user type">
                                            </div>
                                            <?php 
                                                $types = [
                                                    "Corporate Manager", "Admin", "Purchasing", "Delivery Schedule (CDC)", 
                                                    "Delivery Schedule (STORE)", "CDC MIS Data", "Pricing", "Purchasing Invoice", 
                                                    "AP Monitoring", "CEN Accounting", "Audit Monitoring", "Disbursing"
                                                ];
                                                foreach ($types as $type): ?>
                                            <div class="dropdown-item px-3 py-2" data-value="<?= $type; ?>"
                                                style="cursor:pointer;"><?= $type; ?></div>
                                            <?php endforeach; ?>
                                        </div>

                                        <input type="hidden" id="userTypeInput" name="user_type"
                                            value="<?= isset($selected_type) ? $selected_type : '' ?>">
                                    </div>
                                </form>



                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <!-- <a class="btn btn-soft-secondary btn-md"><i class="ri-file-pdf-fill me-2"></i> PDF</a>
                                <a class="btn btn-soft-primary btn-md"><i class="ri-file-excel-2-fill me-2"></i>
                                    Excel</a> -->
                            </div>

                        </div>

                        <div style="overflow-x: auto;">
                            <div class="card" style="min-width: 1200px;">
                                <div class="card-body">
                                    <table id="userTable" class="table table-striped table-bordered nowrap  "
                                        style="width:100% ">
                                        <thead>
                                            <tr>
                                                <th class="text-center bg-light">Photo</th>
                                                <th class="text-left bg-light">Full Name</th>
                                                <th class="text-left bg-light">Position</th>
                                                <th class="text-left bg-light">Department</th>
                                                <th class="text-left bg-light">Business Unit</th>
                                                <th class="text-left bg-light">Username</th>
                                                <th class="text-left bg-light">User Type</th>
                                                <th class="text-left bg-light">User Category</th>
                                                <th class="text-left bg-light">Status</th>
                                                <th class="text-left bg-light">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $user): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?php
                                                        $photo_url = !empty($user->photo)
                                                            ? 'http://172.16.161.34:8080/hrms/images/users/' . basename($user->photo)
                                                            : base_url('assets/img/user-dummy-img.jpg');
                                                    ?>
                                                    <a href="<?= $photo_url ?>" target="_blank"
                                                        rel="noopener noreferrer">
                                                        <img src="<?= $photo_url ?>" alt="User Photo"
                                                            style="width: 35px; height: 35px; border-radius: 50%; cursor:pointer;">
                                                    </a>
                                                </td>
                                                <td class="text-left"><?= $user->full_name; ?></td>
                                                <td class="text-left"><?= $user->position; ?></td>
                                                <td class="text-left"><?= $user->department; ?></td>
                                                <td class="text-left"><?= $user->business_unit; ?></td>
                                                <td class="text-left"><?= $user->user_name; ?></td>
                                                <td class="text-left"><?= $user->user_type; ?></td>
                                                <td class="text-left"><?= $user->user_category; ?></td>
                                                <td class="text-left">
                                                    <?php if ($user->status == 'Active'): ?>
                                                        <span class="text-success">
                                                            <i class="ri-checkbox-circle-line fs-17 align-middle"></i> <?= $user->status; ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-danger">
                                                            <i class="ri-close-circle-line fs-17 align-middle"></i> <?= $user->status; ?>
                                                        </span>
                                                    <?php endif; ?>
                                                </td>

                                                <td class="text-left">
                                            <div class="dropdown d-inline-block">   
                                                <button class="btn btn-soft-secondary btn-sm" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-settings-3-fill align-middle"></i> View more
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                <a href="<?= site_url('Admin_ctrl/view_users/' . $user->user_id) ?>" class="dropdown-item">
                                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> View
                                                    </a>
                                                    <li>
                                                        <a class="dropdown-item edit-item-btn edit-button"
                                                        data-id="<?= $user->user_id; ?>"
                                                        data-full_name="<?= $user->full_name; ?>"
                                                        data-position="<?= $user->position; ?>"
                                                        data-user_name="<?= $user->user_name; ?>"
                                                        data-user_type="<?= $user->user_type; ?>"
                                                        data-user_category="<?= $user->user_category; ?>">
                                                            <i class='bx bx-edit-alt me-2'></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" 
                                                        class="dropdown-item toggle-status" 
                                                        data-id="<?= $user->user_id ?>" 
                                                        data-status="<?= $user->status ?>">
                                                            <i class="bx bx-info-circle me-2"></i> <?= $user->status ?>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->



<!--==================================  Add User Modal ==============================-->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addUserForm" autocomplete="off">
                <div class="modal-body">

                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <!-- <label class="form-label">Photo</label><br> -->
                            <a id="photoLink" href="#" target="_blank" rel="noopener noreferrer">
                                <img id="photoPreview" src="<?= base_url('assets/img/user-dummy-img.jpg') ?>"
                                    alt="Photo" style="
                                        width: 150px;
                                        height: 150px;
                                        object-fit: cover;
                                        border: 1px solid #333;
                                        cursor: pointer;
                                        display: inline-block;
                                        border-radius: 50%;
                                        background-color: #e9ecef;
                                        cursor: not-allowed;">
                            </a>
                        </div>
                        <input type="hidden" id="photo" name="photo" />
                        <div class="col-md-8">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required
                                autocomplete="off" placeholder="Search Lastname, Firstname">
                        </div>
                    </div>
                    <div class="row g-3 position-relative">
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required readonly
                                placeholder="Enter Position" style="background-color: #e9ecef; cursor: not-allowed;">
                        </div>

                        <div class="col-md-6">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" required readonly
                                placeholder="Enter Department" style="background-color: #e9ecef; cursor: not-allowed;">
                        </div>

                        <div class="col-md-6">
                            <label for="business_unit" class="form-label">Business Unit</label>
                            <input type="text" class="form-control" id="business_unit" name="business_unit" required
                                readonly placeholder="Enter Business Unit"
                                style="background-color: #e9ecef; cursor: not-allowed;">
                        </div>

                        <div class="col-md-6">
                            <label for="user_name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required
                                placeholder="Enter Username">
                        </div>

                        <div class="col-md-6">
                            <label for="user_type" class="form-label">User Type</label>
                            <select class="form-select" id="user_type" name="user_type" required
                                onchange="updateStoreField()">
                                <option value="" disabled selected>Select User Type</option>
                                <option value="Corporate Manager">Corporate Manager</option>
                                <option value="Admin">Admin</option>
                                <option value="Purchasing">Purchasing</option>
                                <option value="Delivery Schedule (CDC)">Delivery Schedule(CDC)</option>
                                <option value="Delivery Schedule (STORE)">Delivery Schedule(STORE)</option>
                                <option value="CDC MIS Data">CDC MIS Data</option>
                                <option value="Pricing">Pricing</option>
                                <option value="Purchasing Invoice">Purchasing Invoice</option>
                                <option value="AP Monitoring">AP Monitoring</option>
                                <option value="CEN Accounting">CEN Accounting</option>
                                <option value="Audit Monitoring">Audit Monitoring</option>
                                <option value="Disbursing">Disbursing</option>
                            </select>
                        </div>

                        <div class="col-md-6" id="storeField">
                            <label class="form-label"></label>
                            <div id="storeCheckboxes" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success me-2">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>

        </div>
    </div>
</div>


<!--================================== Edit User Modal ==================================-->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header  text-white p-3">
                <h4 class="modal-title">Update User Form</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="updateUserForm">
                    <input type="hidden" name="user_id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">
                                Full Name
                            </label>
                            <input type="text" name="full_name" class="form-control"
                                style="background-color: #e9ecef; cursor: not-allowed;" required readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="position" class="form-label">
                                Position</label>
                            <input type="text" name="position" class="form-control " required
                                style="background-color: #e9ecef; cursor: not-allowed;" readonly readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="user_name" class="form-label">
                                Username</label>
                            <input type="text" name="user_name" class="form-control " required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_type" class="form-label"> User Type</label>
                            <select name="user_type" class="form-select custom-select" required>
                                <option value="" disabled selected>Select User Type</option>
                                <option value="Corporate Manager">Corporate Manager</option>
                                <option value="Admin">Admin</option>
                                <option value="Purchasing">Purchasing</option>
                                <option value="Delivery Schedule (CDC)">Delivery Schedule (CDC)</option>
                                <option value="Delivery Schedule (STORE)">Delivery Schedule (STORE)</option>
                                <option value="CDC MIS Data">CDC MIS Data</option>
                                <option value="Pricing">Pricing</option>
                                <option value="Purchasing Invoice">Purchasing Invoice</option>
                                <option value="AP Monitoring">AP Monitoring</option>
                                <option value="CEN Accounting">CEN Accounting</option>
                                <option value="Audit Monitoring">Audit Monitoring</option>
                                <option value="Disbursing">Disbursing</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                New Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter New Password" required>
                            <input type="checkbox" id="show-password" class="mt-2"> Show Password
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_type" class="form-label"></i> User
                                Category</label>

                            <div id="userCategoryContainer"></div>
                        </div>

                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary me-2">Update</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>

                </form>
            </div>
            <div class="modal-footer ">
                <small class="text-muted">Please enter all details correctly if you update it.ツ</small>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?= base_url('assets/new/js/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('assets/new/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/new/js/dataTables.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/new/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/new/js/responsive.bootstrap5.min.js') ?>"></script>
<script src="<?= base_url('assets/new/js/sweetalert2.all.min.js') ?>"></script>




<script>
$(document).ready(function() {
    var table = $('#userTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        columnDefs: [{
            orderable: false,
            targets: -1
        }],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search user..."
        }
    });

    $(document).on('click', '.edit-button', function() {
        var user_id = $(this).data('id');
        var full_name = $(this).data('full_name');
        var position = $(this).data('position');
        var user_name = $(this).data('user_name');
        var user_type = $(this).data('user_type');
        var user_category = $(this).data('user_category').split(',');

        $('#editUserModal input[name="user_id"]').val(user_id);
        $('#editUserModal input[name="full_name"]').val(full_name);
        $('#editUserModal input[name="position"]').val(position);
        $('#editUserModal input[name="user_name"]').val(user_name);
        $('#editUserModal select[name="user_type"]').val(user_type);

        updateUserCategoryOptions(user_type, user_category);

        $('#editUserModal').modal('show');
    });

    function updateUserCategoryOptions(user_type, user_category) {
        var categoryOptions = {
            "Purchasing": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC1'> SC1</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC2'> SC2</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC3'> SC3</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC4'> SC4</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC5'> SC5</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC6'> SC6</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC7'> SC7</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC8'> SC8</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC9'> SC9</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='SC10'> SC10</div>`,

            "CDC MIS Data": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='TAL'> TAL</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ICM'> ICM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='PM'> PM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ASC'> ASC</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='CDC'> CDC</div>`,

            "Delivery Schedule (CDC)": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='Scheduling'> Scheduling</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='Status'> Status</div>`,

            "Delivery Schedule (STORE)": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='TAL'> TAL</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ICM'> ICM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='PM'> PM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ASC'> ASC</div>`,

            "Pricing": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='TAL'> TAL</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ICM'> ICM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='PM'> PM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ASC'> ASC</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='CDC'> CDC</div>`,

            "Purchasing Invoice": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='TAL'> TAL</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ICM'> ICM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='PM'> PM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ASC'> ASC</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='CDC'> CDC</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='Cancel & Approve PO'> Cancel & Approve PO</div>`,

            "AP Monitoring": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='TAL'> TAL</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ICM'> ICM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='PM'> PM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ASC'> ASC</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='CDC'> CDC</div>`,

            "CEN Accounting": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='CAS'> CAS</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='NON CAS'> NON CAS</div>`,

            "Audit Monitoring": `
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='TAL'> TAL</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ICM'> ICM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='PM'> PM</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='ASC'> ASC</div>
                            <div style='display: inline-block; margin-right: 10px;'><input type='checkbox' name='user_category[]' value='CDC'> CDC</div>`
        };

        var categoryContainer = $('#userCategoryContainer');
        categoryContainer.empty();

        if (categoryOptions[user_type]) {
            categoryContainer.html(categoryOptions[user_type]);
        }

        user_category.forEach(function(category) {
            $('#editUserModal input[name="user_category[]"][value="' + category + '"]').prop(
                'checked', true);
        });
    }


    $(document).on('change', 'select[name="user_type"]', function() {
        var selectedType = $(this).val();
        updateUserCategoryOptions(selectedType, []);
    });

    $("#updateUserForm").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "<?= base_url('Admin_ctrl/update'); ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: "User updated successfully!",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Update Failed",
                        text: "Please try again.",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred.",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            }
        });

    });

    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.getElementById("togglePasswordIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }

    $('.dataTables_filter input').css({
        'width': '200px',
        'height': '38px',
        'font-size': '14px'
    });
});


// add users
$(document).ready(function() {
    let typingTimer;
    const typingInterval = 300;

    $("#full_name").on("input", function() {
        clearTimeout(typingTimer);
        const name = $(this).val().trim();
        $("#suggestions").remove();

        if (name.length >= 3) {
            typingTimer = setTimeout(() => {
                $.ajax({
                    url: "<?= base_url('Admin_ctrl/search_employee') ?>",
                    method: "GET",
                    data: {
                        name: name
                    },
                    success: function(data) {
                        const results = JSON.parse(data);
                        if (results.length > 0) {
                            let list = '<ul class="list-group" id="suggestions">';
                            results.forEach(emp => {
                                list += `<li class="list-group-item suggestion-item" 
                                    data-name="${emp.name}" 
                                    data-position="${emp.position}" 
                                    data-department="${emp.department}" 
                                    data-bunit="${emp.business_unit}" 
                                    data-photo="${emp.photo}">
                                    ${emp.name}
                                </li>`;
                            });
                            list += '</ul>';
                            $("#full_name").after(list);
                        }
                    },
                    error: function() {
                        console.error('Error fetching employees');
                    }
                });
            }, typingInterval);
        }
    });

    // On selecting suggestion
    $(document).on('click', '.suggestion-item', function() {
        $("#full_name").val($(this).data('name'));
        $("#position").val($(this).data('position'));
        $("#department").val($(this).data('department'));
        $("#business_unit").val($(this).data('bunit'));
        $("#photo").val($(this).data('photo'));

        const photoFilename = $(this).data('photo');
        let photoUrl = '';

        if (photoFilename) {
            const filename = photoFilename.split('/').pop();
            photoUrl = 'http://172.16.161.34:8080/hrms/images/users/' + filename;
        } else {
            photoUrl = '<?= base_url("assets/img/user-dummy-img.jpg") ?>';
        }

        $("#photo").val(photoFilename || '');
        $("#photoPreview").attr('src', photoUrl);
        $("#photoLink").attr('href', photoUrl);

        $("#suggestions").remove();
    });

    // Close suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#full_name, .suggestion-item').length) {
            $("#suggestions").remove();
        }
    });

    // Submit Add User form
    $("#addUserForm").submit(function(e) {
        e.preventDefault();
        console.log("Submitting form..."); // Debug

        let isValid = true;
        const userType = $("#user_type").val();
        const exemptUserTypes = ['Corporate Manager', 'Admin', 'Disbursing'];

        $('#addUserForm').find('input[required], select[required]').each(function() {
            const name = $(this).attr('name');

            // Skip user_category[] if userType is exempt
            if (exemptUserTypes.includes(userType) && name === 'user_category[]') {
                $(this).removeClass('is-invalid');
                return true;
            }

            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // If not valid, show warning and stop
        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete form',
                text: 'Please fill all required fields before submitting.'
            });
            return;
        }

        // Submit via AJAX
        $.ajax({
            url: "<?= base_url('Admin_ctrl/add') ?>",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                console.log("Response from server:", response);
                try {
                    const res = JSON.parse(response);

                    if (res.status === 'success') {
                        Swal.fire({
                            title: "Success!",
                            text: "User saved successfully!",
                            icon: "success"
                        }).then(() => {
                            $('#addUserModal').modal('hide');
                            $('#addUserForm')[0].reset();
                            location.reload();
                        });

                    } else if (res.status === 'duplicate') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Username already exists',
                            text: 'Please choose a different one.'
                        });

                    } else if (res.status === 'missing_category') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing User Category',
                            text: 'Please select at least one category.'
                        });

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to save user',
                            text: 'Something went wrong.'
                        });
                    }
                } catch (err) {
                    console.error("Failed to parse response:", err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unexpected server response.'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error submitting form.'
                });
            }
        });
    });
});



// From Add Function User Category Select
function updateStoreField() {
    const userType = document.getElementById("user_type").value;
    const storeField = document.getElementById("storeCheckboxes");
    const label = document.querySelector("#storeField label");

    storeField.innerHTML = "";
    label.textContent = "";

    let options = [];
    let titleText = "";


    const userCategories = {
        // "Admin": ["Super-Admin"],
        "Purchasing": ["SC1", "SC2", "SC3", "SC4", "SC5", "SC6", "SC7", "SC8", "SC9", "SC10"],
        "Delivery Schedule (CDC)": ["Scheduling", "Status"],
        "Delivery Schedule (STORE)": ["ICM", "TAL", "PM", "ASC"],
        "CDC MIS Data": ["ICM", "TAL", "PM", "ASC", "CDC"],
        "Pricing": ["ICM", "TAL", "PM", "ASC", "CDC"],
        "Purchasing Invoice": ["ICM", "TAL", "PM", "ASC", "CDC", "Cancel & Approve PO"],
        "AP Monitoring": ["ICM", "TAL", "PM", "ASC", "CDC"],
        "CEN Accounting": ["CAS", "NON CAS"],
        "Audit Monitoring": ["ICM", "TAL", "PM", "ASC", "CDC"]
        // "Disbursing": ["Disbursing"]
    };

    if (userCategories[userType]) {
        options = userCategories[userType];
        titleText = "User Category";
    }

    if (options.length > 0) {
        label.textContent = titleText;

        options.forEach(opt => {
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "user_category[]";
            checkbox.value = opt;
            checkbox.classList.add("form-check-input");

            const span = document.createElement("span");
            span.textContent = opt;
            span.style.marginLeft = "5px";

            const wrapper = document.createElement("label");
            wrapper.className = "form-check-label d-flex align-items-center me-3";
            wrapper.style.marginBottom = "5px";
            wrapper.appendChild(checkbox);
            wrapper.appendChild(span);

            storeField.appendChild(wrapper);
        });
    }
}


// togglePasswordVisibility
document.getElementById('show_password').addEventListener('change', function() {
    var passwordField = document.getElementById('update_password');
    if (this.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});

const passwordField = document.getElementById('password');
const showPasswordCheckbox = document.getElementById('show-password');

showPasswordCheckbox.addEventListener('change', function() {
    if (this.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});

</script>

<script>
    
// filter user type
const dropdown = document.getElementById('customDropdown');
const display = document.getElementById('dropdownDisplay');
const displayText = document.getElementById('displayText');
const clearSelection = document.getElementById('clearSelection');
const list = document.getElementById('dropdownList');
const search = document.getElementById('dropdownSearch');
const items = list.querySelectorAll('.dropdown-item');
const hiddenInput = document.getElementById('userTypeInput');
const form = dropdown.closest('form');

let selectedValue = hiddenInput.value;


display.addEventListener('click', (e) => {
    if (e.target.id !== 'clearSelection') {
        list.style.display = list.style.display === 'block' ? 'none' : 'block';
        search.focus();
    }
});


items.forEach(item => {
    item.addEventListener('click', () => {
        selectedValue = item.getAttribute('data-value');
        displayText.textContent = selectedValue;
        clearSelection.style.display = 'inline';
        list.style.display = 'none';
        search.value = '';
        items.forEach(i => i.style.display = '');

        hiddenInput.value = selectedValue;
        form.submit();
    });
});


search.addEventListener('input', () => {
    const value = search.value.toLowerCase();
    items.forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(value) ? '' : 'none';
    });
});


clearSelection.addEventListener('click', (e) => {
    e.stopPropagation();
    selectedValue = '';
    displayText.textContent = 'Filter User Type';
    clearSelection.style.display = 'none';
    hiddenInput.value = '';
    form.submit();
});


document.addEventListener('click', (e) => {
    if (!dropdown.contains(e.target)) {
        list.style.display = 'none';
    }
});



$(document).on('click', '.toggle-status', function () {
    var $this = $(this);
    var userId = $this.data('id');
    var currentStatus = $this.data('status');
    var newStatus = (currentStatus === 'Active') ? 'Inactive' : 'Active';

    var swalText = (newStatus === 'Inactive') ? 
        'Are you sure you want to set this user as Inactive?' : 
        'Are you sure you want to set this user as Active?';

    Swal.fire({
        title: 'Confirm Action',
        text: swalText,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.ajax({
                url: '<?= base_url("Admin_ctrl/toggle_status") ?>',
                type: 'POST',
                data: {
                    user_id: userId,
                    status: newStatus
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Status updated to ' + newStatus + '.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); 
                    });
                },
                error: function () {
                    Swal.fire('Error', 'Failed to update status.', 'error');
                }
            });
        }
    });
});
</script>