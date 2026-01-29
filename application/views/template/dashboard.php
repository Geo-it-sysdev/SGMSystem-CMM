<style>
    .table-responsive.table-card {
    overflow-x: auto;
    max-height: 400px; /* adjust as needed */
}

#ssg_table {
    width: 100% !important;
}

.card-body {
    display: flex;
    flex-direction: column;
    padding: 1rem;
}

.table-card {
    flex: 1; /* takes remaining space */
}

</style>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboards </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards </a></li>
                            <li class="breadcrumb-item active">Home </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row project-wrapper">
            <div class="col-xxl-8">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                            <!-- <i data-feather="briefcase" class="text-primary"></i> -->
                                            <i class="ri-building-4-line"></i>

                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                            Total Classrooms </p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="<?php echo $total_classrooms; ?>">0 </span></h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0"> Active Classrooms </p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                            <i class="ri-team-fill"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="text-uppercase fw-medium text-muted mb-3">Total Students </p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="<?php echo $total_student; ?>">0 </span></h4>
                                        </div>
                                        <p class="text-muted mb-0">Active Students </p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-4">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle text-info rounded-2 fs-2">
                                            <i class="ri-group-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden ms-3">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3">
                                            Total Users </p>
                                        <div class="d-flex align-items-center mb-3">
                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                    data-target="<?php echo $total_users; ?>">0 </span></h4>
                                        </div>
                                        <p class="text-muted text-truncate mb-0">Active Users </p>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->





                <div class="row">

                    <div class="col-xxl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Supreme Student Government (SSG)</h4>
                                <button class="btn btn-outline-primary btn-sm btn-border" id="addSsgBtn">
                                    <i class="ri-add-line"></i> Add SSG Member
                                </button>


                            </div><!-- end card header -->

                            <div class="card-body">

                                <div class="table-responsive table-card">

                                    <table class="table table-borderless table-nowrap align-middle mb-0" id="ssg_table">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Profession</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Rows loaded via JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->




                    <div class="col-xxl-6 col-lg-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Chat </h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted"><i
                                                    class="ri-settings-4-line align-bottom me-1"></i>Setting
                                                <i class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-user-2-fill align-bottom text-muted me-2"></i> View
                                                Profile </a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                                Archive </a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                                Muted </a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                                Delete </a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body p-0">
                                <div id="users-chat">
                                    <div class="chat-conversation p-3" id="chat-conversation" data-simplebar=""
                                        style="height: 400px;">
                                        <ul class="list-unstyled chat-conversation-list chat-sm"
                                            id="users-conversation">
                                            <li class="chat-list left">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="" />
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">Good morning 😊 </p>
                                                            </div>
                                                            <div class="dropdown align-self-start message-box-drop">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-2-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                    </a>
                                                                    <a class="dropdown-item delete-item" href="#"><i
                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name"><small
                                                                class="text-muted time">09:07 am
                                                            </small> <span class="text-success check-message-icon"><i
                                                                    class="ri-check-double-line align-bottom"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- chat-list -->

                                            <li class="chat-list right">
                                                <div class="conversation-list">
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">Good morning, How are ___?
                                                                    What about our ____ meeting? </p>
                                                            </div>
                                                            <div class="dropdown align-self-start message-box-drop">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-2-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                    </a>
                                                                    <a class="dropdown-item delete-item" href="#"><i
                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name"><small
                                                                class="text-muted time">09:08 am
                                                            </small> <span class="text-success check-message-icon"><i
                                                                    class="ri-check-double-line align-bottom"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- chat-list -->

                                            <li class="chat-list left">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="" />
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">Yeah everything is fine.
                                                                    Our next meeting tomorrow __ 10.00 AM </p>
                                                            </div>
                                                            <div class="dropdown align-self-start message-box-drop">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-2-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                    </a>
                                                                    <a class="dropdown-item delete-item" href="#"><i
                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">Hey, I'm going to ____ a
                                                                    friend of ____ at the department store. _ have to
                                                                    buy ____ presents for my parents 🎁. </p>
                                                            </div>
                                                            <div class="dropdown align-self-start message-box-drop">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-2-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                    </a>
                                                                    <a class="dropdown-item delete-item" href="#"><i
                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name"><small
                                                                class="text-muted time">09:10 am
                                                            </small> <span class="text-success check-message-icon"><i
                                                                    class="ri-check-double-line align-bottom"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- chat-list -->

                                            <li class="chat-list right">
                                                <div class="conversation-list">
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="ctext-wrap-content">
                                                                <p class="mb-0 ctext-content">Wow that's great </p>
                                                            </div>
                                                            <div class="dropdown align-self-start message-box-drop">
                                                                <a class="dropdown-toggle" href="#" role="button"
                                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                    <i class="ri-more-2-fill"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy
                                                                    </a>
                                                                    <a class="dropdown-item" href="#"><i
                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                    </a>
                                                                    <a class="dropdown-item delete-item" href="#"><i
                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="conversation-name"><small
                                                                class="text-muted time">09:12 am
                                                            </small> <span class="text-success check-message-icon"><i
                                                                    class="ri-check-double-line align-bottom"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- chat-list -->

                                            <li class="chat-list left">
                                                <div class="conversation-list">
                                                    <div class="chat-avatar">
                                                        <img src="assets/images/users/avatar-2.jpg" alt="" />
                                                    </div>
                                                    <div class="user-chat-content">
                                                        <div class="ctext-wrap">
                                                            <div class="message-img mb-0">
                                                                <div class="message-img-list">
                                                                    <div>
                                                                        <a class="popup-img d-inline-block"
                                                                            href="assets/images/small/img-1.jpg">
                                                                            <img src="assets/images/small/img-1.jpg"
                                                                                alt="" class="rounded border" />
                                                                        </a>
                                                                    </div>
                                                                    <div class="message-img-link">
                                                                        <ul class="list-inline mb-0">
                                                                            <li class="list-inline-item dropdown">
                                                                                <a class="dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="assets/images/small/img-1.jpg"
                                                                                        download=""><i
                                                                                            class="ri-download-2-line me-2 text-muted align-bottom"></i>Download
                                                                                    </a>
                                                                                    <a class="dropdown-item" href="#"><i
                                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                                    </a>
                                                                                    <a class="dropdown-item" href="#"><i
                                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                                    </a>
                                                                                    <a class="dropdown-item" href="#"><i
                                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                                    </a>
                                                                                    <a class="dropdown-item delete-item"
                                                                                        href="#"><i
                                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="message-img-list">
                                                                    <div>
                                                                        <a class="popup-img d-inline-block"
                                                                            href="assets/images/small/img-2.jpg">
                                                                            <img src="assets/images/small/img-2.jpg"
                                                                                alt="" class="rounded border" />
                                                                        </a>
                                                                    </div>
                                                                    <div class="message-img-link">
                                                                        <ul class="list-inline mb-0">
                                                                            <li class="list-inline-item dropdown">
                                                                                <a class="dropdown-toggle" href="#"
                                                                                    role="button"
                                                                                    data-bs-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false">
                                                                                    <i class="ri-more-fill"></i>
                                                                                </a>
                                                                                <div class="dropdown-menu">
                                                                                    <a class="dropdown-item"
                                                                                        href="assets/images/small/img-2.jpg"
                                                                                        download=""><i
                                                                                            class="ri-download-2-line me-2 text-muted align-bottom"></i>Download
                                                                                    </a>
                                                                                    <a class="dropdown-item" href="#"><i
                                                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply
                                                                                    </a>
                                                                                    <a class="dropdown-item" href="#"><i
                                                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward
                                                                                    </a>
                                                                                    <a class="dropdown-item" href="#"><i
                                                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark
                                                                                    </a>
                                                                                    <a class="dropdown-item delete-item"
                                                                                        href="#"><i
                                                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="conversation-name"><small
                                                                class="text-muted time">09:30 am
                                                            </small> <span class="text-success check-message-icon"><i
                                                                    class="ri-check-double-line align-bottom"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- chat-list -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="border-top border-top-dashed">
                                    <div class="row g-2 mx-3 mt-2 mb-3">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="text" class="form-control border-light bg-light"
                                                    placeholder="Enter Message..." />
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-info"><span
                                                    class="d-none d-sm-inline-block me-2">Send </span> <i
                                                    class="mdi mdi-send float-end"></i></button>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div><!-- end row -->
            </div><!-- end col -->



            <div class="col-xxl-4">
                <div class="card">
                    <div class="card-header border-0">
                        <h4 class="card-title mb-0">Upcoming Schedules</h4>
                    </div>
                    <div class="card-body pt-0">
                        <!-- Inline Flatpickr calendar -->
                        <div class="upcoming-scheduled mb-3">
                            <input type="text" id="calendar" class="form-control" placeholder="Select a date" />
                        </div>

                        <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">Upcoming Schedules:</h6>
                        <div id="event-list">
                            <!-- Events will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>










        </div><!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
<!-- End Page-content -->



<!-- Add/Edit SSG Member Modal -->
<div class="modal fade" id="ssgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ssgModalTitle">Add SSG Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="ssgForm">
                    <!-- Hidden ID for SSG Member -->
                    <input type="hidden" name="id" id="member_id">
                    <!-- Hidden student_id -->
                    <input type="hidden" name="student_id" id="student_id">

                    <div class="mb-3">
                        <label for="student_name" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="student_name" name="student_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="profession" class="form-label">Position</label>
                        <select class="form-select" id="profession" name="profession" required>
                            <option value="">-- Select Position --</option>
                            <option value="President">President</option>
                            <option value="Vice President">Vice President</option>
                            <option value="Secretary">Secretary</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Auditor">Auditor</option>
                            <option value="PIO">PIO</option>
                            <option value="Sgt. at Arms">Sgt. at Arms</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" id="saveMemberBtn">Save Member</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="eventForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add/Edit Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="event-date" name="event_date">
                    <div class="mb-3">
                        <label for="event-desc" class="form-label">Event Description</label>
                        <input type="text" id="event-desc" name="description" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="event-time" class="form-label">Event Time</label>
                        <input type="time" id="event-time" name="time" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteEventBtn"
                        style="display:none;">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


<script>
$(document).ready(function() {

    let allEvents = []; // store all events

    // Initialize Flatpickr
    const fp = flatpickr("#calendar", {
        inline: true,
        dateFormat: "Y-m-d",
        defaultDate: "today",
        onChange: function(selectedDates, dateStr) {
            Swal.fire({
                title: 'Add Event?',
                text: `Do you want to add an event for ${dateStr}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    openEventModal(dateStr);
                }
            });
        },
        onMonthChange: function(selectedDates, dateStr, instance) {
            filterEventsByMonth(instance.currentMonth + 1, instance.currentYear);
        },
        onYearChange: function(selectedDates, dateStr, instance) {
            filterEventsByMonth(instance.currentMonth + 1, instance.currentYear);
        }
    });

    // Open modal for new/edit
    function openEventModal(dateStr, event = null) {
        if (event) {
            $('#event-date').val(event.event_date.split(' ')[0]);
            $('#event-time').val(event.event_date.split(' ')[1]);
            $('#event-desc').val(event.description);
            $('#eventForm').data('event-id', event.id);
            $('#deleteEventBtn').show();
        } else {
            $('#event-date').val(dateStr);
            $('#event-time').val('');
            $('#event-desc').val('');
            $('#eventForm').removeData('event-id');
            $('#deleteEventBtn').hide();
        }
        var myModal = new bootstrap.Modal(document.getElementById('eventModal'));
        myModal.show();
    }

    // Handle Add/Edit form submit
    $('#eventForm').on('submit', function(e) {
        e.preventDefault();
        var eventId = $(this).data('event-id');
        var formData = $(this).serializeArray();
        var data = {};
        formData.forEach(item => {
            if (item.name === 'time') data['event_date'] = $('#event-date').val() + ' ' + item
                .value;
            else data[item.name] = item.value;
        });

        let url = eventId ? "<?php echo site_url('EventsController/update'); ?>" :
            "<?php echo site_url('EventsController/save'); ?>";
        if (eventId) data['id'] = eventId;

        $.post(url, data, function(res) {
            var response = JSON.parse(res);
            if (response.status === 'success') {
                var modalEl = document.getElementById('eventModal');
                var modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();

                if (eventId) {
                    const idx = allEvents.findIndex(ev => ev.id == eventId);
                    allEvents[idx] = response.event;
                    $('#eventForm').removeData('event-id');
                } else {
                    allEvents.push(response.event);
                }
                filterEventsByMonth(fp.currentMonth + 1, fp.currentYear);
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        });
    });

    // Delete Event
    $('#deleteEventBtn').on('click', function() {
        var eventId = $('#eventForm').data('event-id');
        if (!eventId) return;
        Swal.fire({
            title: 'Delete Event?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("<?php echo site_url('EventsController/delete'); ?>", {
                    id: eventId
                }, function(res) {
                    var response = JSON.parse(res);
                    if (response.status === 'success') {
                        const idx = allEvents.findIndex(ev => ev.id == eventId);
                        allEvents.splice(idx, 1);
                        var modalEl = document.getElementById('eventModal');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        modal.hide();
                        filterEventsByMonth(fp.currentMonth + 1, fp.currentYear);
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                });
            }
        });
    });

    // Event HTML
    function generateEventHtml(event) {
        const dt = new Date(event.event_date);
        const hours = dt.getHours();
        const minutes = String(dt.getMinutes()).padStart(2, '0');
        const ampm = hours >= 12 ? 'pm' : 'am';
        const displayHour = hours > 12 ? hours - 12 : (hours === 0 ? 12 : hours);

        return `
        <div class="mini-stats-wid d-flex align-items-center mt-3">
            <div class="flex-shrink-0 avatar-sm">
                <span class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4 edit-event" 
                      data-id="${event.id}">${dt.getDate()}</span>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">${event.description}</h6>
                <p class="text-muted mb-0">${event.full_name} (${event.user_type})</p>
            </div>
            <div class="flex-shrink-0">
                <p class="text-muted mb-0">${displayHour}:${minutes} <span class="text-uppercase">${ampm}</span></p>
            </div>
        </div>
        `;
    }

    // Filter events by month/year
    function filterEventsByMonth(month, year) {
        $('#event-list').empty();
        allEvents.forEach(event => {
            const dt = new Date(event.event_date);
            if (dt.getMonth() + 1 === month && dt.getFullYear() === year) {
                $('#event-list').append(generateEventHtml(event));
            }
        });
    }

    // Click event to edit
    $('#event-list').on('click', '.edit-event', function() {
        const eventId = $(this).data('id');
        const event = allEvents.find(ev => ev.id == eventId);
        if (event) openEventModal(event.event_date.split(' ')[0], event);
    });

    // Load events on page load
    $.getJSON("<?php echo site_url('EventsController/get_events'); ?>", function(events) {
        allEvents = events;
        filterEventsByMonth(fp.currentMonth + 1, fp.currentYear);
    });

});








$(document).ready(function() {

    // Initialize DataTable
    let ssgTable = $('#ssg_table').DataTable({
        columnDefs: [
            { orderable: false, targets: 2 } 
        ],
        scrollY: 'calc(100vh - 300px)',
        scrollCollapse: true,
        paging: false,
        info: false,
        searching: false,
        autoWidth: false,
        responsive: true
    });

    // Load all SSG members
    function loadMembers() {
        $.ajax({
            url: '<?= base_url("EventsController/all_ssg_members") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                ssgTable.clear();
                res.forEach(function(member) {
                    let rowNode = ssgTable.row.add([
                        member.student_name,
                        member.profession,
                        `<button class="btn btn-sm btn-outline-success editMember"><i class="ri-edit-line"></i></button>
                         <button class="btn btn-sm btn-outline-danger deleteMember"><i class="ri-delete-bin-line"></i></button>`
                    ]).draw().node();
                    $(rowNode).data('id', member.id);
                });
            }
        });
    }

    loadMembers();

    // Open Add modal
    $('#addSsgBtn').click(function() {
        $('#ssgForm')[0].reset();
        $('#member_id').val('');
        $('#student_id').val('');
        $('#ssgModalTitle').text('Add SSG Member');
        $('#ssgModal').modal('show');
    });

    // Autocomplete for Student Name
    $("#student_name").autocomplete({
        source: function(request, response) {
            if(request.term.length < 3) return; // require at least 3 letters

            $.ajax({
                url: '<?= base_url("EventsController/search_students") ?>',
                type: 'GET',
                dataType: 'json',
                data: { term: request.term, limit: 10 },
                success: function(data) {
                    // Check if data is received
                    if(!data || data.length === 0) {
                        response([]);
                        return;
                    }

                    // Map data to autocomplete format
                    response($.map(data, function(item) {
                        return {
                            label: item.full_name, // shown in dropdown
                            value: item.full_name, // filled in input
                            id: item.id            // store ID
                        };
                    }));
                },
                error: function(xhr) {
                    console.error('Autocomplete error:', xhr.responseText);
                    response([]);
                }
            });
        },
        minLength: 3,
        select: function(event, ui) {
            $("#student_name").val(ui.item.value);
            $("#student_id").val(ui.item.id); // store student ID
            return false;
        }
    });

    // Save/Add or Update member
    $('#ssgForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url("EventsController/save_ssg_member") ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#ssgModal').modal('hide');
                    loadMembers();
                    Swal.fire('Success', 'Member saved successfully', 'success');
                } else {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Something went wrong', 'error');
            }
        });
    });

    // Edit member
    $(document).on('click', '.editMember', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        $.ajax({
            url: '<?= base_url("EventsController/get_ssg_member") ?>/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    $('#member_id').val(res.data.id);
                    $('#student_name').val(res.data.student_name);
                    $('#student_id').val(res.data.student_id || '');
                    $('#profession').val(res.data.profession);
                    $('#ssgModalTitle').text('Edit SSG Member');
                    $('#ssgModal').modal('show');
                }
            }
        });
    });

    // Delete member
    $(document).on('click', '.deleteMember', function() {
        let row = $(this).closest('tr');
        let id = row.data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the member!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url("EventsController/delete_ssg_member") ?>/' + id,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            ssgTable.row(row).remove().draw();
                            Swal.fire('Deleted!', 'Member has been deleted.', 'success');
                        }
                    }
                });
            }
        });
    });

});

</script>