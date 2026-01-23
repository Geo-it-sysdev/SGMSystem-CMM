<style>
    
</style>
 <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->

         
         <div class="main-content">
     <?php
$user_id = $this->session->userdata("po_user");
$user_type = null;

if (isset($user_id)) {
    $user = $this->AuthModel->get_user_by_user_id($user_id);
    $user_type = $user->user_type ?? null; 
}
?>
             <div class="page-content">
                 <div class="container-fluid">

                     <div class="row">
                         <div class="col">

                             <div class="h-100">
                                 <div class="row mb-3 pb-1">
                                     <div class="col-12">
                                         <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                             <div class="flex-grow-1">
                                                <!-- <h5>Welcome, <?php echo $this->session->userdata('user_full_name'); ?>!</h5> -->
                                        <?php
                                            date_default_timezone_set('Asia/Manila');
                                            $current_time = date('H:i');
                                            if ($current_time >= '00:00' && $current_time <= '11:59') {
                                                $greeting = "Good Morning";
                                            } elseif ($current_time >= '12:00' && $current_time <= '18:00') {
                                                $greeting = "Good Afternoon";
                                            } else {
                                                $greeting = "Good Evening";
                                            }
                                            ?>

                                        <h4 class="fs-16 mb-1">
                                            <?= $greeting ?>,
                                            <?php
                                            if (isset($user->user_name)) {
                                                $parts = explode(',', $user->full_name);
                                                if (count($parts) > 1) {
                                                    $firstPart = trim($parts[1]);
                                                    $words = explode(' ', $firstPart);

                                                    $suffixes = ['Jr.', 'Sr.', 'II', 'III'];

                                                    if (count($words) == 2) {
                                                        $firstName = $words[0];
                                                    } elseif (count($words) >= 3) {
                                                        if (in_array(end($words), $suffixes)) {
                                                            $firstName = $words[0] . ' ' . end($words); 
                                                        } else {
                                                            $firstName = $words[0] . ' ' . $words[1];
                                                        }
                                                    } else {
                                                        $firstName = $words[0];
                                                    }

                                                    echo $firstName . 'ツ';
                                                } else {
                                                    echo 'N/Aツ';
                                                }
                                            } else {
                                                echo 'N/Aツ';
                                            }
                                            ?>
                                        </h4>

                                   <!-- login greetings -->
                                            <?php if ($this->session->flashdata('greeting')): ?>
                                            <script>
                                           Swal.fire({
                                                icon: 'success',
                                                html: '<?= addslashes($this->session->flashdata("greeting")) ?><br><br><em>Have a nice day ツ</em>',
                                                timer: 3000,
                                                timerProgressBar: true,
                                                showConfirmButton: true, 
                                                confirmButtonText: "Thank you",
                                                allowOutsideClick: true, 
                                                allowEscapeKey: true,   
                                                customClass: {
                                                    popup: 'swal2-popup-custom'
                                                }
                                            });

                                            </script>


                                        <style>
                                        .swal2-popup-custom {
                                            width: 500px !important;
                                            font-size: 16px;
                                            padding: 20px;
                                        }
                                        </style>
                                        <?php endif; ?>

                                        <div id="quote"></div>

                                             </div>
                                             <div class="mt-3 mt-lg-0">
                                             <form action="javascript:void(0);">
                                            <div class="row g-3 mb-0 align-items-center">
                                                <div class="col-auto">
                                                    <!-- <button type="button" class="btn btn-soft-success"><i
                                                            class="ri-add-circle-line align-middle me-1"></i>
                                                        ___ Product </button> -->
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Search...">
                                                        <button class="btn btn-primary" type="button">
                                                            <i class="ri-search-line"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                                <!-- <div class="col-auto">
                                                    <button type="button"
                                                        class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                            class="ri-pulse-line"></i></button>
                                                </div> -->
                                            </div>
                                        </form>
                                             </div>
                                         </div><!-- end card header -->
                                     </div>
                                     <!--end col-->
                                 </div>
                                 <!--end row-->

                                 <div class="row">

                                      <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'): ?>
                                     <div class="col-xl-3 col-md-6">
                                         <!-- card -->
                                         <div class="card ribbon-box border mb-4 card-animate">
                                            <div class="card-body text-muted position-relative">

                                                <!-- Ribbon -->
                                                <span class="ribbon-three ribbon-three-success">
                                                    <span>Total Classrooms</span>
                                                </span>
                                                <br>
                                                <!-- Card Content -->
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <!-- <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                                        </h5> -->
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                             <span class="counter-value" data-target="<?php echo $total_classrooms; ?>"></span>
                                                        </h4>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="bx bxs-chalkboard bx-sm  text-success"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div><!-- end card body -->
                                        </div><!-- end card -->

                                     </div><!-- end col -->  <?php endif; ?>

                                       <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'|| $user_type === 'Teacher'): ?>
                                     <div class="col-xl-3 col-md-6">
                                         <!-- card -->
                                         <div class="card ribbon-box border mb-4 card-animate">
                                            <div class="card-body text-muted position-relative">

                                                <!-- Ribbon -->
                                                <span class="ribbon-three ribbon-three-info">
                                                    <span>Total Students</span>
                                                </span>
                                                <br>
                                                <!-- Card Content -->
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 overflow-hidden">
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <!-- <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> 
                                                        </h5> -->
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                            <span class="counter-value" data-target="<?php echo $total_student; ?>"></span>
                                                        </h4>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                                            <i class="bx bxs-group bx-sm  text-info"></i>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div><!-- end card body -->
                                        </div><!-- end card -->

                                     </div><!-- end col -->  <?php endif; ?>


                                    <?php if ($user_type === 'Registrar' || $user_type === 'Principal'|| $user_type === 'Admin'): ?>
                                     <div class="col-xl-3 col-md-6">
                                         <!-- card -->
                                         <div class="card ribbon-box border mb-4 card-animate">
                                        <div class="card-body text-muted position-relative">

                                            <!-- Ribbon -->
                                            <span class="ribbon-three ribbon-three-primary">
                                                <span>Total Users</span>
                                            </span>
                                            <br>                         
                                            <!-- Card Content -->
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <!-- <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                                    </h5> -->
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                        <span class="counter-value" data-target="<?php echo $total_users; ?>"></span>
                                                    </h4>
                                                </div>
                                                <div class="avatar-sm flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                        <i class="bx bx-user-pin text-primary"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div><!-- end card body -->
                                    </div><!-- end card -->

                                     </div><!-- end col -->  <?php endif; ?>

                                 
                                 </div>  <!-- end row-->
                             </div>  <!-- end .h-100-->

                         </div>  <!-- end col -->
                     </div>

                 </div>
                 <!-- container-fluid -->
             </div>
             <!-- End Page-content -->

             <script>
    const quotes = [
        "Choose joy every day.",
        "Happiness is a choice, not a result.",
        "Spread kindness and happiness wherever you go.",
        "Do what makes your soul smile.",
        "Find happiness in the little things.",
        "Smile more, worry less.",
        "Be the reason someone feels happy today.",
        "Happiness grows when you share it.",
        "Let go of what you can’t control and embrace what you can.",
        "Gratitude turns what we have into enough.",
        "Laugh often, love much, live well.",
        "A happy heart makes a happy life.",
        "Happiness is homemade.",
        "Focus on what makes you feel alive.",
        "Don’t wait for happiness—create it.",
        "Surround yourself with positive vibes.",
        "Celebrate small victories every day.",
        "Live simply, love deeply, laugh loudly.",
        "Find beauty in every day.",
        "Happiness starts with you.",
        "Let your smile change the world, but don’t let the world change your smile.",
        "Choose happiness, no matter the circumstances.",
        "Joy is the simplest form of gratitude.",
        "Be happy with what you have while working for what you want.",
        "Life is better when you’re laughing.",
        "Happiness is not a destination, it’s a way of life.",
        "Find joy in the journey.",
        "Stay close to what makes you happy.",
        "Create a life you don’t need a vacation from.",
        "Happiness is contagious—pass it on.",
        "Wake up with a thankful heart and a happy mind.",
        "Happiness is found when you stop comparing.",
        "Fill your day with moments that matter.",
        "Choose peace, love, and happiness every day.",
        "Be happy in the moment—it’s all you really have.",
        "Cultivate happiness through kindness and compassion.",
        "Happiness comes from within, not from outside things.",
        "Let your happiness be your truth.",
        "The secret to happiness is freedom, and the secret to freedom is courage.",
        "Embrace the little joys life offers.",
        "Be mindful, be present, be happy.",
        "Happiness blooms from gratitude and love.",
        "Do more of what makes you happy.",
        "Positive thoughts lead to a happy life.",
        "Happiness is a journey, not a race.",
        "Surround yourself with those who lift you higher.",
        "Find joy in every sunrise and peace in every sunset.",
        "Be kind, be happy, be you.",
        "Happiness is a warm heart and an open mind.",
        "Choose happiness even when it’s hard.",
        "Smile at the little things and the big things will smile back."
    ];

    let index = 0;
    const quoteEl = document.getElementById('quote');

    function showQuote() {
        quoteEl.style.opacity = 0;
        setTimeout(() => {
            quoteEl.textContent = quotes[index];
            quoteEl.style.opacity = 1;
            index = (index + 1) % quotes.length;
        }, 500);
    }

    showQuote();
    setInterval(showQuote, 7000);
    </script>


