         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="main-content">
             <?php
                $user_id = $this->session->userdata("po_user");
                if (isset($user_id)) {
                    $user = $this->AuthModel->get_user_by_user_id($user_id);
                }
            ?>
             <div class="page-content">
                 <div class="container-fluid">

                     <div class="position-relative mx-n4 mt-n4">

                     </div>
                     <br><br><br><br><br>
                     <div class="row">
                         <div class="col-xxl-3">
                             <div class="card mt-n5">
                                 <div class="card-body p-4">
                                     <div class="text-center">
                                         <?php 
$user_photo = (!empty($profile->photo)) ? $profile->photo : 'assets/img/user-dummy-img.jpg';
$user_id    = $profile->id;
?>

                                         <div class="profile-user position-relative d-inline-block mx-auto mb-4">

                                             <!-- IMAGE PREVIEW -->
                                             <img id="profile-preview" src="<?= base_url($user_photo) ?>"
                                                 class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                                 alt="user-profile-image" />

                                             <!-- FILE INPUT -->
                                             <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                 <input id="profile-img-file-input" type="file" name="photo"
                                                     class="profile-img-file-input" accept="image/*"
                                                     data-user-id="<?= $user_id ?>" />

                                                 <label for="profile-img-file-input"
                                                     class="profile-photo-edit avatar-xs">
                                                     <span class="avatar-title rounded-circle bg-light text-body">
                                                         <i class="ri-camera-fill"></i>
                                                     </span>
                                                 </label>
                                             </div>
                                         </div>

                                         <script>
                                         // Auto upload on image select
                                         document.getElementById('profile-img-file-input').addEventListener('change',
                                             function() {

                                                 let user_id = this.dataset.userId;
                                                 let file = this.files[0];

                                                 if (!file) return;

                                                 // Preview
                                                 let reader = new FileReader();
                                                 reader.onload = function(e) {
                                                     document.getElementById('profile-preview').src = e.target
                                                         .result;
                                                 };
                                                 reader.readAsDataURL(file);

                                                 // Upload via AJAX (auto-save)
                                                 let formData = new FormData();
                                                 formData.append('photo', file);
                                                 formData.append('user_id', user_id);

                                                 fetch("<?= base_url('AdminController/upload_profile_photo') ?>", {
                                                         method: "POST",
                                                         body: formData
                                                     })
                                                     .then(response => response.json())
                                                     .then(data => {
                                                         console.log(data);
                                                         if (data.status === 'success') {
    // Update preview with new photo URL from server
    document.getElementById('profile-preview').src = data.new_photo;

    Swal.fire({
        icon: 'success',
        title: 'Uploaded!',
        text: 'Profile photo updated successfully.',
        timer: 2000,
        showConfirmButton: false,
        willClose: () => {
            // Reload the page after Swal closes
            window.location.reload();
        }
    });
} else {
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: data.message || 'Something went wrong.',
    });
}

                                                     })
                                                     .catch(err => {
                                                         console.error(err);
                                                         Swal.fire({
                                                             icon: 'error',
                                                             title: 'Error',
                                                             text: 'Could not upload the photo.'
                                                         });
                                                     });
                                             });
                                         </script>






                                         <h5 class="fs-16 mb-1">
                                             <?php echo $this->session->userdata('user_full_name'); ?> </h5>
                                         <p class="text-muted mb-0">
                                             <?= isset($user->user_type) ? htmlspecialchars($user->user_type, ENT_QUOTES, 'UTF-8') : 'N/A' ?>
                                         </p>
                                     </div>
                                 </div>
                             </div>
                             <!--end card-->
                         </div>
                         <!--end col-->
                         <div class="col-xxl-9">
                             <div class="card mt-xxl-n5">
                                 <div class="card-header">
                                     <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                         role="tablist">
                                         <li class="nav-item">
                                             <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                                 role="tab">
                                                 <i class="fas fa-home"></i> Personal Details
                                             </a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                                 <i class="far fa-user"></i> Change Username / Password
                                             </a>
                                         </li>
                                         <!-- <li class="nav-item">
                                             <a class="nav-link" data-bs-toggle="tab" href="#experience" role="tab">
                                                 <i class="far fa-envelope"></i> Experience
                                             </a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                                 <i class="far fa-envelope"></i> Privacy Policy
                                             </a>
                                         </li> -->
                                     </ul>
                                 </div>
                                 <div class="card-body p-4">
                                     <div class="tab-content">
                                         <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                             <form action="javascript:void(0);">
                                                 <div class="row">
                                                     <div class="col-lg-6">
                                                         <div class="mb-3">
                                                             <label for="firstnameInput" class="form-label">First Name
                                                             </label>
                                                             <input type="text" class="form-control rounded-pill"
                                                                 id="firstnameInput" placeholder="Enter your firstname"
                                                                 value="<?php
                                                                $full_name = $this->session->userdata('user_full_name');
                                                                $parts = explode(',', $full_name);
                                                                if (count($parts) > 1) {
                                                                    $name_part = trim($parts[1]);
                                                                    $words = explode(' ', $name_part);
                                                                    $suffixes = ['jr.', 'sr.', 'jr', 'sr', 'iii', 'iv', 'ii'];
                                                                    $first_name = $words[0];
                                                                    $last_word = strtolower(end($words));
                                                                    if (in_array($last_word, $suffixes)) {
                                                                        echo $first_name . ' ' . end($words); 
                                                                    } elseif (count($words) == 2) {
                                                                        echo $first_name; 
                                                                    } elseif (isset($words[1]) && !in_array(strtolower($words[1]), ['dela', 'de', 'del','De La Peña'])) {
                                                                        echo $first_name . ' ' . $words[1]; 
                                                                    } else {
                                                                        echo $first_name; 
                                                                    }
                                                                } else {
                                                                    echo '';
                                                                }
                                                                ?> " style="cursor: not-allowed;" disabled />
                                                         </div>
                                                     </div>
                                                     <!--end col-->
                                                     <div class="col-lg-6">
                                                         <div class="mb-3">
                                                             <label for="lastnameInput" class="form-label">Last Name
                                                             </label>
                                                             <input type="text" class="form-control rounded-pill"
                                                                 id="lastnameInput" placeholder="Enter your lastname"
                                                                 value="<?php
                                                                $full_name = $this->session->userdata('user_full_name');
                                                                $last_name = explode(',', $full_name)[0];
                                                                echo trim($last_name);
                                                                ?>" style="not-allowed;" disabled />
                                                         </div>
                                                     </div>
                                                     <!--end col-->
                                                     <!-- <div class="col-lg-6">
                                                         <div class="mb-3">
                                                             <label for="Department" class="form-label">Department
                                                             </label>
                                                             <input type="text" class="form-control rounded-pill" id="Department"
                                                                 value=" <?= isset($user->department) ? htmlspecialchars($user->department, ENT_QUOTES, 'UTF-8') : 'N/A' ?>"
                                                                 style="not-allowed;"
                                                                 disabled />
                                                         </div>
                                                     </div> -->
                                                     <!--end col-->
                                                     <!-- <div class="col-lg-6">
                                                         <div class="mb-3">
                                                             <label for="business_unit" class="form-label">Business Unit
                                                             </label>
                                                             <input type="text" class="form-control rounded-pill" id="business_unit"
                                                                 value="<?= isset($user->business_unit) ? htmlspecialchars($user->business_unit, ENT_QUOTES, 'UTF-8') : 'N/A' ?>"
                                                                 style="cursor: not-allowed;"
                                                                 disabled />
                                                         </div>
                                                     </div> -->

                                                     <!-- <div class="col-lg-6">
                                                         <div class="mb-3">
                                                             <label for="Position" class="form-label">Position </label>
                                                             <input type="text" class="form-control" id="Position"
                                                                 value="<?= isset($user->position) ? htmlspecialchars($user->position, ENT_QUOTES, 'UTF-8') : 'N/A' ?>"
                                                                 style="background-color: #e9ecef; cursor: not-allowed;"
                                                                 disabled />
                                                         </div>
                                                     </div> -->
                                                     <div class="col-lg-6">
                                                         <div class="mb-3">
                                                             <label for="user_type" class="form-label">User Type
                                                             </label>
                                                             <input type="text" class="form-control rounded-pill"
                                                                 id="user_type"
                                                                 value="<?= isset($user->user_type) ? htmlspecialchars($user->user_type, ENT_QUOTES, 'UTF-8') : 'N/A' ?>"
                                                                 style="cursor: not-allowed;" disabled />
                                                         </div>
                                                     </div>
                                                     <!--end col-->
                                                 </div>
                                                 <!--end row-->
                                             </form>
                                         </div>
                                         <!--end tab-pane-->
                                         <div class="tab-pane" id="changePassword" role="tabpanel">
                                             <form id="profileForm" action="javascript:void(0);">
                                                 <div class="row g-2">
                                                     <div class="col-lg-6">
                                                         <div>
                                                             <label for="user_name" class="form-label">Username </label>
                                                             <input type="text" class="form-control rounded-pill"
                                                                 id="user_name" name="user_name"
                                                                 placeholder="Enter new username"
                                                                 value="<?= htmlspecialchars($user->user_name) ?>" />
                                                         </div>
                                                     </div>
                                                     <div class="col-lg-6">
                                                         <div>
                                                             <label for="newpassword" class="form-label">New Password
                                                             </label>
                                                             <input type="password" class="form-control rounded-pill"
                                                                 id="newpassword" name="newpassword"
                                                                 placeholder="Enter new password" />
                                                         </div>
                                                     </div>
                                                     <div class="col-lg-12">
                                                         <br>
                                                         <div class="text-end">
                                                             <button type="submit"
                                                                 class="btn btn-soft-success rounded-pill">Save &
                                                                 Change</button>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <!--end row-->
                                                 <!-- <div id="message" style="margin-top:10px;"></div> -->
                                             </form>
                                             <div>
                                             </div>
                                         </div>


                                         <!--end tab-pane-->
                                         <div class="tab-pane" id="experience" role="tabpanel">
                                             <form>
                                                 <div id="newlink">
                                                     <div id="1">
                                                         <div class="row">
                                                             <div class="col-lg-12">
                                                                 <div class="mb-3">
                                                                     <label for="jobTitle" class="form-label">Job Title
                                                                     </label>
                                                                     <input type="text" class="form-control"
                                                                         id="jobTitle" placeholder="Job title"
                                                                         value="Lead Designer / Developer" />
                                                                 </div>
                                                             </div>
                                                             <!--end col-->
                                                             <div class="col-lg-6">
                                                                 <div class="mb-3">
                                                                     <label for="companyName" class="form-label">Company
                                                                         Name </label>
                                                                     <input type="text" class="form-control"
                                                                         id="companyName" placeholder="Company name"
                                                                         value="Themesbrand" />
                                                                 </div>
                                                             </div>
                                                             <!--end col-->
                                                             <div class="col-lg-6">
                                                                 <div class="mb-3">
                                                                     <label for="experienceYear"
                                                                         class="form-label">Experience Years </label>
                                                                     <div class="row">
                                                                         <div class="col-lg-5">
                                                                             <select class="form-control"
                                                                                 data-choices=""
                                                                                 data-choices-search-false=""
                                                                                 name="experienceYear"
                                                                                 id="experienceYear">
                                                                                 <option value="" />Select years
                                                                                 <option value="Choice 1" />2001
                                                                                 <option value="Choice 2" />2002
                                                                                 <option value="Choice 3" />2003
                                                                                 <option value="Choice 4" />2004
                                                                                 <option value="Choice 5" />2005
                                                                                 <option value="Choice 6" />2006
                                                                                 <option value="Choice 7" />2007
                                                                                 <option value="Choice 8" />2008
                                                                                 <option value="Choice 9" />2009
                                                                                 <option value="Choice 10" />2010
                                                                                 <option value="Choice 11" />2011
                                                                                 <option value="Choice 12" />2012
                                                                                 <option value="Choice 13" />2013
                                                                                 <option value="Choice 14" />2014
                                                                                 <option value="Choice 15" />2015
                                                                                 <option value="Choice 16" />2016
                                                                                 <option value="Choice 17"
                                                                                     selected="" />2017
                                                                                 <option value="Choice 18" />2018
                                                                                 <option value="Choice 19" />2019
                                                                                 <option value="Choice 20" />2020
                                                                                 <option value="Choice 21" />2021
                                                                                 <option value="Choice 22" />2022
                                                                             </select>
                                                                         </div>
                                                                         <!--end col-->
                                                                         <div class="col-auto align-self-center">
                                                                             to
                                                                         </div>
                                                                         <!--end col-->
                                                                         <div class="col-lg-5">
                                                                             <select class="form-control"
                                                                                 data-choices=""
                                                                                 data-choices-search-false=""
                                                                                 name="choices-single-default2">
                                                                                 <option value="" />Select years
                                                                                 <option value="Choice 1" />2001
                                                                                 <option value="Choice 2" />2002
                                                                                 <option value="Choice 3" />2003
                                                                                 <option value="Choice 4" />2004
                                                                                 <option value="Choice 5" />2005
                                                                                 <option value="Choice 6" />2006
                                                                                 <option value="Choice 7" />2007
                                                                                 <option value="Choice 8" />2008
                                                                                 <option value="Choice 9" />2009
                                                                                 <option value="Choice 10" />2010
                                                                                 <option value="Choice 11" />2011
                                                                                 <option value="Choice 12" />2012
                                                                                 <option value="Choice 13" />2013
                                                                                 <option value="Choice 14" />2014
                                                                                 <option value="Choice 15" />2015
                                                                                 <option value="Choice 16" />2016
                                                                                 <option value="Choice 17" />2017
                                                                                 <option value="Choice 18" />2018
                                                                                 <option value="Choice 19" />2019
                                                                                 <option value="Choice 20"
                                                                                     selected="" />2020
                                                                                 <option value="Choice 21" />2021
                                                                                 <option value="Choice 22" />2022
                                                                             </select>
                                                                         </div>
                                                                         <!--end col-->
                                                                     </div>
                                                                     <!--end row-->
                                                                 </div>
                                                             </div>
                                                             <!--end col-->
                                                             <div class="col-lg-12">
                                                                 <div class="mb-3">
                                                                     <label for="jobDescription" class="form-label">Job
                                                                         Description </label>
                                                                     <textarea class="form-control" id="jobDescription"
                                                                         rows="3"
                                                                         placeholder="Enter description">You always want to ____ sure that your fonts ____ well together and try __ limit the number of _____ you use to three __ less. Experiment and play ______ with the fonts that ___ already have in the ________ you're working with reputable ____ websites.  </textarea>
                                                                 </div>
                                                             </div>
                                                             <!--end col-->
                                                             <div class="hstack gap-2 justify-content-end">
                                                                 <a class="btn btn-success"
                                                                     href="javascript:deleteEl(1)">Delete </a>
                                                             </div>
                                                         </div>
                                                         <!--end row-->
                                                     </div>
                                                 </div>
                                                 <div id="newForm" style="display: none;">

                                                 </div>
                                                 <div class="col-lg-12">
                                                     <div class="hstack gap-2">
                                                         <button type="submit" class="btn btn-success">Update </button>
                                                         <a href="javascript:new_link()" class="btn btn-primary">Add New
                                                         </a>
                                                     </div>
                                                 </div>
                                                 <!--end col-->
                                             </form>
                                         </div>
                                         <!--end tab-pane-->
                                         <div class="tab-pane" id="privacy" role="tabpanel">
                                             <div class="mb-4 pb-2">
                                                 <h5 class="card-title text-decoration-underline mb-3">Security: </h5>
                                                 <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0">
                                                     <div class="flex-grow-1">
                                                         <h6 class="fs-14 mb-1">Two-factor Authentication </h6>
                                                         <p class="text-muted">Two-factor authentication is an ________
                                                             security meansur. Once enabled, ___'__ be required to give
                                                             ___ types of identification when ___ log into Google
                                                             Authentication ___ SMS are Supported. </p>
                                                     </div>
                                                     <div class="flex-shrink-0 ms-sm-3">
                                                         <a href="javascript:void(0);"
                                                             class="btn btn-sm btn-primary">Enable Two-facor
                                                             Authentication </a>
                                                     </div>
                                                 </div>
                                                 <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                                     <div class="flex-grow-1">
                                                         <h6 class="fs-14 mb-1">Secondary Verification </h6>
                                                         <p class="text-muted">The first factor is _ password and the
                                                             second ________ includes a text with _ code sent to your
                                                             __________, or biometrics using your ___________, face, or
                                                             retina. </p>
                                                     </div>
                                                     <div class="flex-shrink-0 ms-sm-3">
                                                         <a href="javascript:void(0);"
                                                             class="btn btn-sm btn-primary">Set up secondary method </a>
                                                     </div>
                                                 </div>
                                                 <div class="d-flex flex-column flex-sm-row mb-4 mb-sm-0 mt-2">
                                                     <div class="flex-grow-1">
                                                         <h6 class="fs-14 mb-1">Backup Codes </h6>
                                                         <p class="text-muted mb-sm-0">A backup code is _____________
                                                             generated for you when ___ turn on two-factor
                                                             authentication _______ your iOS or Android _______ app. You
                                                             can also ________ a backup code on _______.___. </p>
                                                     </div>
                                                     <div class="flex-shrink-0 ms-sm-3">
                                                         <a href="javascript:void(0);"
                                                             class="btn btn-sm btn-primary">Generate backup codes </a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="mb-3">
                                                 <h5 class="card-title text-decoration-underline mb-3">Application
                                                     Notifications: </h5>
                                                 <ul class="list-unstyled mb-0">
                                                     <li class="d-flex">
                                                         <div class="flex-grow-1">
                                                             <label for="directMessage"
                                                                 class="form-check-label fs-14">Direct messages </label>
                                                             <p class="text-muted">Messages from people you ______ </p>
                                                         </div>
                                                         <div class="flex-shrink-0">
                                                             <div class="form-check form-switch">
                                                                 <input class="form-check-input" type="checkbox"
                                                                     role="switch" id="directMessage" checked="" />
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="d-flex mt-2">
                                                         <div class="flex-grow-1">
                                                             <label class="form-check-label fs-14"
                                                                 for="desktopNotification">
                                                                 ____ desktop notifications
                                                             </label>
                                                             <p class="text-muted">Choose the option you ____ as your
                                                                 default setting. _____ a site: Next to "___ allowed to
                                                                 send notifications," _____ Add. </p>
                                                         </div>
                                                         <div class="flex-shrink-0">
                                                             <div class="form-check form-switch">
                                                                 <input class="form-check-input" type="checkbox"
                                                                     role="switch" id="desktopNotification"
                                                                     checked="" />
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="d-flex mt-2">
                                                         <div class="flex-grow-1">
                                                             <label class="form-check-label fs-14"
                                                                 for="emailNotification">
                                                                 ____ email notifications
                                                             </label>
                                                             <p class="text-muted"> Under Settings, choose
                                                                 _____________. Under Select an account, ______ the
                                                                 account to enable _____________ for. </p>
                                                         </div>
                                                         <div class="flex-shrink-0">
                                                             <div class="form-check form-switch">
                                                                 <input class="form-check-input" type="checkbox"
                                                                     role="switch" id="emailNotification" />
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="d-flex mt-2">
                                                         <div class="flex-grow-1">
                                                             <label class="form-check-label fs-14"
                                                                 for="chatNotification">
                                                                 ____ chat notifications
                                                             </label>
                                                             <p class="text-muted">To prevent duplicate mobile
                                                                 _____________ from the Gmail and ____ apps, in
                                                                 settings, turn ___ Chat notifications. </p>
                                                         </div>
                                                         <div class="flex-shrink-0">
                                                             <div class="form-check form-switch">
                                                                 <input class="form-check-input" type="checkbox"
                                                                     role="switch" id="chatNotification" />
                                                             </div>
                                                         </div>
                                                     </li>
                                                     <li class="d-flex mt-2">
                                                         <div class="flex-grow-1">
                                                             <label class="form-check-label fs-14"
                                                                 for="purchaesNotification">
                                                                 ____ purchase notifications
                                                             </label>
                                                             <p class="text-muted">Get real-time purchase alerts __
                                                                 protect yourself from fraudulent _______. </p>
                                                         </div>
                                                         <div class="flex-shrink-0">
                                                             <div class="form-check form-switch">
                                                                 <input class="form-check-input" type="checkbox"
                                                                     role="switch" id="purchaesNotification" />
                                                             </div>
                                                         </div>
                                                     </li>
                                                 </ul>
                                             </div>
                                             <div>
                                                 <h5 class="card-title text-decoration-underline mb-3">Delete This
                                                     Account: </h5>
                                                 <p class="text-muted">Go to the Data & Privacy section of your _______
                                                     Account. Scroll to "Your ____ & privacy options." Delete ____
                                                     Profile Account. Follow the ____________ to delete your account :
                                                 </p>
                                                 <div>
                                                     <input type="password" class="form-control" id="passwordInput"
                                                         placeholder="Enter your password" value="make@321654987"
                                                         style="max-width: 265px;" />
                                                 </div>
                                                 <div class="hstack gap-2 mt-3">
                                                     <a href="javascript:void(0);" class="btn btn-soft-danger">Close &
                                                         Delete This _______ </a>
                                                     <a href="javascript:void(0);" class="btn btn-light">Cancel </a>
                                                 </div>
                                             </div>
                                         </div>
                                         <!--end tab-pane-->
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!--end col-->
                     </div>
                     <!--end row-->

                 </div>
                 <!-- container-fluid -->
             </div><!-- End Page-content -->

             <script>
             $(document).ready(function() {
                 $('#profileForm').submit(function() {
                     $.ajax({
                         url: "<?= base_url('AdminController/update_profile') ?>",
                         type: "POST",
                         data: $(this).serialize(),
                         dataType: "json",
                         success: function(res) {
                             if (res.status === 'success') {
                                 Swal.fire({
                                     title: 'Success!',
                                     text: res.message,
                                     icon: 'success',
                                     showCancelButton: true,
                                     confirmButtonText: 'Back to Login',
                                     cancelButtonText: 'Not Now'
                                 }).then((result) => {
                                     if (result.isConfirmed) {
                                         // Redirect to login
                                         window.location.href =
                                             "<?= base_url('AuthController/logout') ?>";
                                     }
                                 });
                             } else {
                                 Swal.fire({
                                     title: 'Error',
                                     text: res.message,
                                     icon: 'error'
                                 });
                             }
                         },
                         error: function() {
                             Swal.fire({
                                 title: 'Error',
                                 text: 'An error occurred while submitting the form.',
                                 icon: 'error'
                             });
                         }
                     });
                     return false;
                 });
             });
             </script>