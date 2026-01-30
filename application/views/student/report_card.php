<body>

    <!-- Begin page -->
    <div id="layout-wrapper">



        <?php
            $user_id = $this->session->userdata("po_user");
            if (isset($user_id)) {
                $user = $this->AuthModel->get_user_by_user_id($user_id);
            }
            ?>

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
                                <h4 class="mb-sm-0">Students Activity</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Activity Setup</li>
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
                                    <!-- NAV PILLS -->
                                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3 flex-wrap">
                                        <?php
                                    $all_grades = ['Grade 7','Grade 8','Grade 9','Grade 10','Grade 11','Grade 12'];
                                    $active_set = false;

                                    foreach ($all_grades as $grade):
                                        if (in_array('All',$grade_levels) || in_array($grade,$grade_levels)):
                                            $grade_id = strtolower(str_replace(' ','',$grade));
                                            $active_class = (!$active_set)?'active':'';
                                            $active_set = true;
                                ?>
                                        <li class="nav-item">
                                            <a href="#<?= $grade_id ?>-student" data-bs-toggle="tab"
                                                class="nav-link <?= $active_class ?>">
                                                <?= $grade ?> Report Card
                                            </a>
                                        </li>
                                        <?php endif; endforeach; ?>
                                    </ul>

                                    <!-- TAB CONTENT -->
                                    <div class="tab-content">
                                        <?php
                                    $tab_first = true;
                                    foreach ($all_grades as $grade):
                                        if (in_array('All',$grade_levels) || in_array($grade,$grade_levels)):
                                            $grade_id = strtolower(str_replace(' ','',$grade));
                                            $show_class = $tab_first?'show active':'';
                                            $tab_first = false;
                                ?>
                                        <div class="tab-pane fade <?= $show_class ?>" id="<?= $grade_id ?>-student"
                                            data-grade="<?= $grade ?>">
                                            <div class="card p-3">
                                                <h5 class="mb-3"><?= $grade ?> Activity</h5>
                                                <?php if($is_admin || $grade_levels): ?>
                                                <div class="d-flex align-items-center gap-2 mb-3">
                                                    <?php if ($this->session->userdata('user_type') === 'Teacher'): ?>
                                                    <button type="button"
                                                        class="btn btn-outline-success addActivityBtn rounded-pill btn-border"
                                                        data-bs-toggle="modal" data-bs-target="#ActivityModal"
                                                        data-grade="<?= $grade ?>">
                                                        <i class="ri-add-line align-bottom "></i> Add Activity
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                                <?php endif; ?>

                                                <ul class="nav nav-tabs nav-border-top nav-border-top-success mb-3 "
                                                    id="sectionTabs_<?= $grade_id ?>" role="tablist"></ul>


                                                <table id="activityTable_<?= $grade_id ?>"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle activityTable"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Student Name</th>
                                                            <th>Grade Level</th>
                                                            <th>Section</th>
                                                            <th>School Year</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <?php endif; endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- end container-fluid -->
            </div> <!-- end page-content -->
        </div> <!-- end main-content -->


        <script>
        $(document).ready(function() {
            let tables = {};

            function initTable(grade_id, grade_name) {
                let table = $('#activityTable_' + grade_id).DataTable({
                    "processing": true,
                    "serverSide": false,
                    "destroy": true,
                    "ajax": {
                        "url": "<?= base_url('StudentController/fetch_students_report_card') ?>",
                        "type": "GET",
                        "data": {
                            grade: grade_name
                        }
                    },
                    "columns": [{
                            "data": "student_name"
                        },
                        {
                            "data": "grade_level"
                        },
                        {
                            "data": "subject"
                        },
                        {
                            "data": "section"
                        },
                        {
                            "data": "created_at"
                        },
                        {
                            "data": "action",
                            "orderable": false,
                            "searchable": false
                        }
                    ],
                    "language": {
                        "infoFiltered": "" 
                    }
                });


                tables[grade_id] = table;

                // Generate Section filter buttons
                table.on('xhr', function() {
                    let data = table.ajax.json().data;
                    let sections = [...new Set(data.map(d => d.section))].sort();
                    let sectionTabs = $(`#sectionTabs_${grade_id}`);
                    sectionTabs.empty();

                    // Add buttons for each section only
                    sections.forEach((section, index) => {
                        let activeClass = index === 0 ? 'active' : '';
                        sectionTabs.append(`
                    <li class="nav-item">
                        <button class="nav-link ${activeClass}" data-section="${section}" type="button">${section}</button>
                    </li>
                `);
                    });

                    // Filter by Section
                    sectionTabs.find('button').click(function() {
                        let section = $(this).data('section');
                        sectionTabs.find('button').removeClass('active');
                        $(this).addClass('active');

                        table.column(2).search('^' + section + '$', true, false).draw();
                    });

                    // Automatically filter by the first section
                    let firstSectionButton = sectionTabs.find('button').eq(0);
                    if (firstSectionButton.length) {
                        firstSectionButton.click();
                    }
                });
            }

            // Initialize the first grade tab
            let firstPane = $('.tab-pane.show.active');
            let firstGradeId = firstPane.attr('id').replace('-student', '');
            let firstGradeName = firstPane.data('grade');
            initTable(firstGradeId, firstGradeName);

            // Handle grade tab switching
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                let target = $(e.target).attr("href");
                let grade_id = target.replace('#', '').replace('-student', '');
                let grade_name = $('#' + grade_id + '-student').data('grade');

                if (!tables[grade_id]) {
                    initTable(grade_id, grade_name);
                } else {
                    tables[grade_id].ajax.reload(null, false);
                }
            });
        });
        </script>


    </div>
    </div>