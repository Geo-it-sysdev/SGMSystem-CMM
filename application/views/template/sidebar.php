<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
</div>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo -->
        <br>
        <a href="<?php echo site_url('GradingSystem/dashboard'); ?>" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo base_url('assets/images/CMMGMS.png'); ?>" alt="" height="30" />
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url('assets/images/CMMGMS.png'); ?>" alt="" height="90" />
            </span>
        </a>

        <!-- Light Logo -->
        <a href="<?php echo site_url('GradingSystem/dashboard'); ?>" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo base_url('assets/images/CMMGMS.png'); ?>" alt="" height="30" />
            </span>
            <span class="logo-lg">
                <img src="<?php echo base_url('assets/images/CMMGMS.png'); ?>" alt="" height="90" />
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>


    <?php
$user_id = $this->session->userdata("po_user");
$user_type = null;

if (isset($user_id)) {
    $user = $this->AuthModel->get_user_by_user_id($user_id);
    $user_type = $user->user_type ?? null; 
}
?>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu </span></li>

                <!--============================ Dashboard ====================================-->
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/dashboard') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/dashboard'); ?>">
                        <i
                            class="bx bx-grid-alt bx-sm
                        <?php echo (uri_string() === 'GradingSystem/dashboard') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span>Dashboard</span>
                    </a>
                </li>


                 <!--============================ User List ====================================-->

                <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/user_list') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/user_list'); ?>">
                        <i
                            class="bx bx-user-pin bx-sm 
                        <?php echo (uri_string() === 'GradingSystem/user_list') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span>User Setup</span>
                    </a>
                </li>

                 <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/my_students') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/my_students'); ?>">
                        <i
                            class="bx bxs-group bx-sm 
                        <?php echo (uri_string() === 'GradingSystem/my_students') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span> Students’ Setup</span>
                    </a>
                </li>
                <?php endif; ?>

                <!--============================ User List ====================================-->
                <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'): ?>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/classrooms') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/classrooms'); ?>">
                        <i
                            class="bx bxs-chalkboard bx-sm 
                            <?php echo (uri_string() === 'GradingSystem/classrooms') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span>Classrooms</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($user_type === 'Teacher'): ?>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/my_students') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/my_students'); ?>">
                        <i
                            class="bx bxs-group bx-sm 
                        <?php echo (uri_string() === 'GradingSystem/my_students') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span> Students’ Setup</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'|| $user_type === 'Teacher'): ?>
               



                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/activity_student') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/activity_student'); ?>">
                        <i
                            class="bx bxs-book bx-sm
                        <?php echo (uri_string() === 'GradingSystem/activity_student') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span>Students’ Activity</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/final_grades_student') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/final_grades_student'); ?>">
                        <i
                            class="bx bx-list-check bx-sm
                        <?php echo (uri_string() === 'GradingSystem/final_grades_student') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span>Students’ Final Grades</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (uri_string() === 'GradingSystem/final_average_student') ? 'active' : ''; ?>"
                        href="<?php echo site_url('GradingSystem/final_average_student'); ?>">
                        <i
                            class="bx bx-bar-chart-alt-2 bx-sm
                        <?php echo (uri_string() === 'GradingSystem/final_average_student') ? 'animate__animated animate__heartBeat animate__infinite' : ''; ?>">
                        </i>
                        <span>Students’ Final Average</span>
                    </a>
                </li>
                <?php endif; ?>

               
                <!--============================ Layouts ====================================-->
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="bx bx-layout"></i> <span data-key="t-layouts">Layouts </span> <span
                            class="badge badge-pill bg-danger" data-key="t-hot">Hot </span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" target="_blank" class="nav-link" data-key="t-vertical">Vertical </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" target="_blank" class="nav-link" data-key="t-detached">Detached </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" target="_blank" class="nav-link" data-key="t-two-column">Two Column </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" target="_blank" class="nav-link" data-key="t-hovered">Hovered </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages </span></li> -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>