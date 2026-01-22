<style>
#activityTable8 tbody tr td {
    color: #212529 !important;
    opacity: 1 !important;
}

#activityTable8 thead th {
    color: #000 !important;
    font-weight: 600;
}

#activityTable8 .btn {
    opacity: 1 !important;
}

.underline-input {
    border: none;
    border-bottom: 1px solid #000;
    border-radius: 0;
    padding: 1px 0;
    box-shadow: none;
}

.underline-input:focus {
    outline: none;
    border-bottom-color: #0d6efd;
}

.equal-width .col {
    flex: 0 0 20%;
    max-width: 20%;
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
                                <h4 class="mb-sm-0">Students Activity </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables </a></li>
                                        <li class="breadcrumb-item active">Students Activity </li>
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
                                    <ul class="nav nav-pills arrow-navtabs nav-primary bg-light mb-3">
                                        <li class="nav-item">
                                            <a href="#gr8-student" data-bs-toggle="tab" aria-expanded="true"
                                                class="nav-link active d-flex align-items-center justify-content-start custom-no-hover"
                                                style="width: 180px;">
                                                <i class="ri-team-line me-2"></i>
                                                <span>Grade 8 Activity</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#gr11-student" data-bs-toggle="tab" aria-expanded="false"
                                                class="nav-link d-flex align-items-center justify-content-start custom-no-hover"
                                                style="width: 170px;">
                                                <i class="ri-team-line me-2"></i>
                                                <span>Grade 11 Activity</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- ================= TAB CONTENT ================= -->
                                    <div class="tab-content text-muted">

                                        <!-- ==================== GRADE 11 TAB ==================== -->
                                        <div class="tab-pane active" id="gr8-student">
                                            <div class="card-body">
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-start gap-2 mb-3">

                                                    <!-- Add G8 Activity Button -->
                                                    <button type="button" class="btn btn-outline-success rounded-pill"
                                                        data-bs-toggle="modal" id="addActiviy11"
                                                        data-bs-target="#ActivityModal">
                                                        <i class="ri-add-line align-bottom me-1"></i>Add G8 Activity
                                                    </button>

                                                    <!-- Filter Dropdown for GR8 -->
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-info dropdown-toggle rounded-pill"
                                                            type="button" id="filterG8Button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-filter-3-line me-1"></i> Filter Subjects
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="filterG8Button">
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Math')">Math</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Science')">Science</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('English')">English</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Filipino')">Filipino</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Araling Panlipunan')">Araling
                                                                    Panlipunan</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('MAPEH')">MAPEH</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('TLE')">TLE</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Values Education')">Values
                                                                    Education</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <div class="d-flex justify-content-center mt-2 mb-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    onclick="clearFilter()">Clear Filter</button>
                                                            </div>
                                                        </ul>
                                                    </div>



                                                    <!-- Filter Dropdown for GR8 -->
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-secondary dropdown-toggle rounded-pill"
                                                            type="button" id="filterG8Button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-filter-3-line me-1"></i> Filter Activity Type
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="filterG8Button">
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Activity Sheets')">Activity
                                                                    Sheets</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Quizzes')">Quiz</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Performance Task')">Performance
                                                                    Task</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Assignment')">Assignment</a>
                                                            </li>
                                                            <li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Exam')">Exam</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <div class="d-flex justify-content-center mt-2 mb-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    onclick="clearFilter()">Clear Filter</button>
                                                            </div>
                                                        </ul>
                                                    </div>






                                                    <!-- Date Filter Dropdown -->
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-primary dropdown-toggle rounded-pill"
                                                            type="button" id="dateFilterButton"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-calendar-line me-1"></i> Filter Date Activity
                                                        </button>
                                                        <div class="dropdown-menu p-3" style="min-width: 250px;">
                                                            <div class="mb-2">
                                                                <label for="start_date" class="form-label">Start
                                                                    Date</label>
                                                                <input type="date" class="form-control" id="start_date">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="end_date" class="form-label">End
                                                                    Date</label>
                                                                <input type="date" class="form-control" id="end_date">
                                                            </div>
                                                            <div class="d-flex gap-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm flex-fill"
                                                                    onclick="applyDateFilter()">Apply</button>
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm flex-fill"
                                                                    onclick="clearDateFilter()">Clear</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <!-- GRADE 11 TABLE -->
                                                <table id="activityTable8"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                    style="width:100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Subject</th>
                                                            <th>Activity Type</th>
                                                            <th>Score Overall</th>
                                                            <th>Date Activity</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Table rows will be loaded via AJAX -->
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <!-- ==================== GRADE 8 TAB ==================== -->
                                        <div class="tab-pane" id="gr11-student">
                                            <div class="card-body">
                                                <div
                                                    class="d-flex flex-wrap align-items-center justify-content-start gap-2 mb-3">

                                                    <!-- Add G11 Activity Button -->
                                                    <button type="button" class="btn btn-outline-success rounded-pill"
                                                        data-bs-toggle="modal" id="addG8Btn"
                                                        data-bs-target="#studentModal">
                                                        <i class="ri-add-line align-bottom me-1"></i>Add G11 Activity
                                                    </button>

                                                    <!-- Filter Dropdown for GR8 -->
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-info dropdown-toggle rounded-pill"
                                                            type="button" id="filterG8Button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-filter-3-line me-1"></i> Filter Subjects
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="filterG8Button">
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Math')">Math</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Science')">Science</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('English')">English</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Filipino')">Filipino</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Araling Panlipunan')">Araling
                                                                    Panlipunan</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('MAPEH')">MAPEH</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('TLE')">TLE</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Values Education')">Values
                                                                    Education</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <div class="d-flex justify-content-center mt-2 mb-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    onclick="clearFilter()">Clear Filter</button>
                                                            </div>
                                                        </ul>
                                                    </div>



                                                    <!-- Filter Dropdown for GR11 -->
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-secondary dropdown-toggle rounded-pill"
                                                            type="button" id="filterG11Button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-filter-3-line me-1"></i> Filter Activity Type
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="filterG11Button">
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Activity Sheets')">Activity
                                                                    Sheets</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Quizzes')">Quiz</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Performance Task')">Performance
                                                                    Task</a></li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Assignment')">Assignment</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#"
                                                                    onclick="setFilter('Exam')">Exam</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <div class="d-flex justify-content-center mt-2 mb-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm"
                                                                    onclick="clearFilter()">Clear Filter</button>
                                                            </div>
                                                        </ul>
                                                    </div>

                                                    <!-- Date Filter Dropdown -->
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-outline-primary dropdown-toggle rounded-pill"
                                                            type="button" id="dateFilterButton"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-calendar-line me-1"></i> Filter Date Activity
                                                        </button>
                                                        <div class="dropdown-menu p-3" style="min-width: 250px;">
                                                            <div class="mb-2">
                                                                <label for="start_date" class="form-label">Start
                                                                    Date</label>
                                                                <input type="date" class="form-control" id="start_date">
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="end_date" class="form-label">End
                                                                    Date</label>
                                                                <input type="date" class="form-control" id="end_date">
                                                            </div>
                                                            <div class="d-flex gap-2">
                                                                <button type="button"
                                                                    class="btn btn-outline-primary btn-sm flex-fill"
                                                                    onclick="applyDateFilter()">Apply</button>
                                                                <button type="button"
                                                                    class="btn btn-outline-danger btn-sm flex-fill"
                                                                    onclick="clearDateFilter()">Clear</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                                <!-- GRADE 8 TABLE -->
                                                <table id="studentTableG11"
                                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                                    style="width:100%">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th>Subject</th>
                                                            <th>Activity Type</th>
                                                            <th>Overall</th>
                                                            <th>Date Activity</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- G8 Table rows go here -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div> <!-- end tab-content -->
                                </div> <!-- end border -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->








                    <!-- Add Activity Modal -->
                    <div class="modal fade" id="ActivityModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <form id="studentForm" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="studentModalTitle">Add Activity</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="id">

                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="subject">Subjects</label>
                                                <select name="subject" id="subject" class="form-select" required>
                                                    <option value="" selected disabled>-- Select Subject --</option>
                                                    <option value="Mathematics">Mathematics</option>
                                                    <option value="Science">Science</option>
                                                    <option value="English">English</option>
                                                    <option value="Filipino">Filipino</option>
                                                    <option value="Araling Panlipunan">Araling Panlipunan</option>
                                                    <option value="MAPEH">MAPEH</option>
                                                    <option value="TLE">TLE</option>
                                                    <option value="Values Education">Values Education</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Activity Type</label>
                                                <select name="activity_type" id="activity_type" class="form-control"
                                                    required>
                                                    <option value="" selected disabled>-- Select Activity Type --
                                                    </option>
                                                    <option>Activity Sheets</option>
                                                    <option>Quiz</option>
                                                    <option>Assignment</option>
                                                    <option>Project</option>
                                                    <option>Performance Task</option>
                                                    <option>Written Task</option>
                                                    <option>Exam</option>
                                                    <option>Group Activity</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Score Overall</label>
                                                <input type="number" name="overall" id="overall" class="form-control"
                                                    required placeholder="Enter Score Overall">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Date Activity</label>
                                                <input type="date" name="activity_date" id="activity_date"
                                                    class="form-control" required>
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


                    <!-- Tag Modal -->
                    <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel"
                        aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tag Grades</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Add Grades Button -->
                                    <div class="mb-3 d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-success me-2 rounded-pill"
                                            id="openAddGradesBtn">
                                            <i class="bi bi-journal-check me-1"></i> Add Grade
                                        </button>

                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle rounded-pill"
                                                type="button" id="filterG11Button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="ri-filter-3-line me-1"></i> Filter Section
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="filterG11Button">
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="setFilter('Proverbs')">Proverbs</a></li>
                                                <li><a class="dropdown-item" href="#"
                                                        onclick="setFilter('Psalm')">Psalm</a></li>
                                                <hr class="dropdown-divider">
                                                <div class="d-flex justify-content-center mt-2 mb-2">
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        onclick="clearFilter()">Clear Filter</button>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Activity Info -->
                                    <div class="row mb-3">
                                        <!-- Inputs Row -->


                                        <div class="row mb-3 equal-width">
                                            <div class="col">
                                                <label for="subjects" class="form-label">Subjects</label>
                                                <input type="text" id="subjects" name="subjects"
                                                    class="form-control underline-input" autocomplete="off" readonly
                                                    style="text-align:center;">
                                            </div>

                                            <div class="col">
                                                <label for="activity" class="form-label">Activity Type</label>
                                                <input type="text" id="activity" name="activity"
                                                    class="form-control underline-input" autocomplete="off" readonly
                                                    style="text-align:center;">
                                            </div>

                                            <div class="col">
                                                <label for="dates" class="form-label">Date Activity</label>
                                                <input type="date" id="dates" name="dates"
                                                    class="form-control underline-input" autocomplete="off" readonly
                                                    style="text-align:center;">
                                            </div>

                                            <div class="col">
                                                <label for="overalls" class="form-label">Overall</label>
                                                <input type="text" id="overalls" name="overall"
                                                    class="form-control underline-input" autocomplete="off" readonly
                                                    style="text-align:center;">
                                            </div>

                                            <div class="col">
                                                <label for="passing" class="form-label">Passing Score</label>
                                                <input type="text" id="passing" name="passing"
                                                    class="form-control underline-input" autocomplete="off" readonly
                                                    style="text-align:center;">
                                            </div>
                                        </div>





                                        <!-- Grades Table -->
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped align-middle"
                                                id="gradesTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Student</th>
                                                        <th>Section</th>
                                                        <th>Score</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Grades Modal -->
                        <div class="modal fade" id="addGradesModal" tabindex="-1" aria-hidden="true"
                            data-bs-backdrop="static">
                            <div class="modal-dialog">
                                <form id="addGradesForm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Grade</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="activity_type_id" id="activity_type_id">

                                            <div class="mb-3">
                                                <label>Section</label>
                                                <select id="section" name="section" class="form-select" required>
                                                    <option value="" disabled selected>Select Section</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="student_id" class="form-label">Student</label>
                                                <div class="dropdown position-relative w-100"
                                                    id="studentDropdownWrapper" data-bs-auto-close="outside">
                                                    <!-- Button styled like form-control -->
                                                    <button class="form-control text-start" type="button"
                                                        id="studentDropdownBtn" data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                        style="background-color: #fff; color: #000;">
                                                        <span id="studentLabel" class="text-muted">Select Student</span>
                                                    </button>

                                                    <div class="dropdown-menu w-100 p-2 shadow-sm border-0"
                                                        style="max-height: 300px; overflow-y: auto;">
                                                        <!-- Search input -->
                                                        <input type="text" id="studentSearch" class="form-control mb-2"
                                                            placeholder="Search fullname..." autocomplete="off">

                                                        <!-- List of students -->
                                                        <div id="studentList">
                                                            <div class="text-muted px-2">No students loaded</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Hidden field for selected student -->
                                                <input type="hidden" id="student_id" name="student_id">
                                            </div>



                                            <div class="mb-3">
                                                <label>Score</label>
                                                <input type="number" name="score" class="form-control" required
                                                    placeholder="Enter Score">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="saveGradeBtn"
                                                class="btn btn-success">Save</button>
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>




                        <script>
                        $(document).ready(function() {
                            var tagModal = new bootstrap.Modal(document.getElementById('tagModal'));
                            var addGradesModal = new bootstrap.Modal(document.getElementById('addGradesModal'));

                            // Initialize main DataTable
                            var table = $('#activityTable8').DataTable({
                                ajax: "<?= site_url('StudentController/fetch_activities') ?>",
                                columns: [{
                                        data: 'subject'
                                    },
                                    {
                                        data: 'activity_type'
                                    },
                                    {
                                        data: 'overall',
                                        className: 'text-center'
                                    },

                                    {
                                        data: 'activity_date'
                                    },
                                    {
                                        data: null,
                                        className: 'text-center', // ✅ This centers the buttons horizontally
                                        render: function(data, type, row) {
                                            return `
                                                    <button class="btn btn-sm btn-outline-success tagBtn me-1" 
                                                        data-id="${row.id}" 
                                                        data-subject="${row.subject}" 
                                                        data-activity_type="${row.activity_type}" 
                                                        data-activity_date="${row.activity_date}" 
                                                        data-overall="${row.overall}" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#tagModal">
                                                        <i class="bi bi-tag-fill me-1"></i> Tag
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-primary editBtn me-1">
                                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger deleteBtn">
                                                        <i class="bi bi-trash3-fill me-1"></i> Delete
                                                    </button>
                                                `;
                                        }
                                    }


                                ]
                            });


                            // Add Activity via AJAX
                            $('#studentForm').on('submit', function(e) {
                                e.preventDefault();
                                $.ajax({
                                    url: "<?= site_url('StudentController/add_activity') ?>",
                                    type: "POST",
                                    data: $(this).serialize(),
                                    dataType: "json",
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Activity added successfully!',
                                                icon: 'success',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                $('#ActivityModal').modal('hide');
                                                $('#studentForm')[0].reset();
                                                table.ajax.reload(null, false);
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'Error adding activity.',
                                                icon: 'error',
                                                confirmButtonColor: '#d33',
                                                confirmButtonText: 'Try Again'
                                            });
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: 'Oops!',
                                            text: 'Something went wrong. Please try again later.',
                                            icon: 'error',
                                            confirmButtonColor: '#d33',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                });
                            });


                            // Initialize grades DataTable
                            var gradesTable = $('#gradesTable').DataTable({
                                columns: [{
                                        title: "Student Name",
                                        data: "student_name"
                                    },
                                    {
                                        title: "Section",
                                        data: "section"
                                    },
                                    {
                                        title: "Score",
                                        data: "score",
                                        className: 'text-center'
                                    },
                                    {
                                        title: "Remarks",
                                        data: null,
                                        className: 'text-center',
                                        render: function(data, type, row) {
                                            var overallScore = parseFloat($('#overalls')
                                                .val()) || 0;
                                            var passingScore = overallScore * 0.75;
                                            if (overallScore > 0 && row.score != null) {
                                                var percent = (row.score / overallScore) * 100;
                                                var status = (row.score >= passingScore) ?
                                                    'Passed' : 'Failed';
                                                return percent.toFixed(0) + '% - ' + status;
                                            }
                                            return '0% - Failed';
                                        }
                                    }
                                ],
                                paging: true,
                                searching: true,
                                ordering: true,
                                info: true,
                                order: [
                                    [2, 'desc']
                                ] // order by Score column, descending
                            });

                            // Load/Update Grades Table
                            function loadGradesTable(activityTypeId) {
                                var overallScore = parseFloat($('#overalls').val()) || 0;
                                var passingPercentage = 75;
                                var passingScore = (overallScore * passingPercentage) / 100;

                                $.ajax({
                                    url: '<?= base_url("StudentController/fetch_grades") ?>/' +
                                        activityTypeId,
                                    method: 'GET',
                                    dataType: 'json',
                                    success: function(res) {
                                        if (res.length) {
                                            var rows = res.map(g => {
                                                var percentDisplay = '0% - Failed';
                                                if (overallScore > 0 && g.score != null) {
                                                    var percent = (g.score / overallScore) *
                                                        100;
                                                    var status = (g.score >= passingScore) ?
                                                        'Passed' : 'Failed';
                                                    percentDisplay = percent.toFixed(0) +
                                                        '% - ' + status;
                                                }
                                                return {
                                                    student_name: g.student_name,
                                                    section: g.section,
                                                    score: g.score,
                                                    date_created: g.date_created || '',
                                                    remarks: percentDisplay
                                                };
                                            });
                                            gradesTable.clear().rows.add(rows).draw();
                                        } else {
                                            gradesTable.clear().draw();
                                            $('#gradesTable tbody').html(
                                                '<tr><td colspan="5" class="text-center">No Student grades found</td></tr>'
                                            );
                                        }
                                    },
                                    error: function() {
                                        gradesTable.clear().draw();
                                        $('#gradesTable tbody').html(
                                            '<tr><td colspan="5" class="text-center">Error loading grades</td></tr>'
                                        );
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to load grades data.',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    }
                                });
                            }

                            // Tag button click
                            $(document).on('click', '.tagBtn', function() {
                                var id = $(this).data('id');
                                var subject = $(this).data('subject') || '';
                                var activityType = $(this).data('activity_type') || '';
                                var activityDate = $(this).data('activity_date') || '';
                                var overall = parseFloat($(this).data('overall')) || 0;

                                // Set input values
                                $('#activity_type_id').val(id);
                                $('#subjects').val(subject);
                                $('#activity').val(activityType);
                                $('#dates').val(activityDate);
                                $('#overalls').val(overall);

                                // Calculate passing score (75% of overall) with 1 decimal
                                var passingScore = overall * 0.75;
                                $('#passing').val(passingScore.toFixed(1)); // 1 decimal

                                // Load grades table and show modal
                                loadGradesTable(id);
                                tagModal.show();
                            });

                            // Open Add Grades Modal
                            $('#openAddGradesBtn').click(function() {
                                $.ajax({
                                    url: '<?= base_url("StudentController/get_sections") ?>',
                                    method: 'GET',
                                    dataType: 'json',
                                    success: function(sections) {
                                        var options =
                                            '<option value="" disabled selected>Select Section</option>';
                                        sections.forEach(sec => {
                                            options +=
                                                `<option value="${sec}">${sec}</option>`;
                                        });
                                        $('#section').html(options);
                                        $('#student_id').html(
                                            '<option value="" disabled selected>Select Student</option>'
                                        );
                                    },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to load sections.',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    }
                                });
                                addGradesModal.show();
                            });

                            $('#section').change(function() {
                                var section = $(this).val();
                                $.ajax({
                                    url: '<?= base_url("StudentController/get_students_by_section") ?>',
                                    method: 'GET',
                                    data: {
                                        section: section
                                    },
                                    dataType: 'json',
                                    success: function(students) {
                                        var html = '';
                                        if (students.length > 0) {
                                            students.forEach(s => {
                                                html += `
                        <button class="dropdown-item student-option" type="button" 
                                data-id="${s.id}" data-name="${s.fullname}">
                            ${s.fullname}
                        </button>`;
                                            });
                                        } else {
                                            html =
                                                '<div class="dropdown-item text-muted">No students found</div>';
                                        }

                                        $('#studentList').html(html);
                                        $('#studentLabel')
                                            .text('Select Student')
                                            .addClass(
                                                'text-muted'
                                                ); // reset muted style when section changes
                                    },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to load students for this section.',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    }
                                });
                            });

                            // ✅ When clicking a student name
                            $(document).on('click', '.student-option', function() {
                                var id = $(this).data('id');
                                var name = $(this).data('name');

                                $('#student_id').val(id);
                                $('#studentLabel')
                                    .text(name) // show selected student name
                                    .removeClass('text-muted'); // remove muted (gray) text color
                            });

                            // ✅ Search filter inside dropdown
                            $('#studentSearch').on('keyup', function() {
                                var search = $(this).val().toLowerCase();
                                $('#studentList .student-option').each(function() {
                                    var name = $(this).data('name').toLowerCase();
                                    $(this).toggle(name.includes(search));
                                });

                                if ($('#studentList .student-option:visible').length === 0) {
                                    if ($('#studentList .no-match').length === 0) {
                                        $('#studentList').append(
                                            '<div class="dropdown-item text-muted no-match">No matches found</div>'
                                        );
                                    }
                                } else {
                                    $('#studentList .no-match').remove();
                                }
                            });


                            // Save grade
                            $('#saveGradeBtn').click(function() {
                                var overall = parseFloat($('#overalls').val());
                                var score = parseFloat($('input[name="score"]').val());

                                if (score > overall) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Invalid Score',
                                        text: 'Score cannot exceed the overall value of ' +
                                            overall,
                                        confirmButtonColor: '#3085d6'
                                    });
                                    return;
                                }

                                $.ajax({
                                    url: '<?= base_url("StudentController/save_grade") ?>',
                                    method: 'POST',
                                    data: $('#addGradesForm').serialize(),
                                    success: function(res) {
                                        var data = JSON.parse(res);
                                        if (data.status === 'duplicate') {
                                            Swal.fire({
                                                icon: 'warning',
                                                title: 'Duplicate Entry',
                                                text: data.message,
                                                confirmButtonColor: '#3085d6'
                                            });
                                            return;
                                        }

                                        var activityTypeId = $('#activity_type_id').val();
                                        loadGradesTable(activityTypeId);

                                        addGradesModal.hide();
                                        $('#addGradesForm')[0].reset();

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success',
                                            text: 'Grade saved successfully!',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to save the grade.',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    }
                                });
                            });
                        });



                        // let selectedFilter = '';

                        // function setFilter(filter) {
                        //     selectedFilter = filter;
                        //     const button = document.getElementById('filterG11Button');

                        //     if (!filter) {
                        //         button.innerHTML = `<i class="ri-filter-3-line"></i> Filter Activity Type`;
                        //     } else {
                        //         button.innerHTML = `<i class="ri-filter-3-line"></i> ${filter}`;
                        //     }

                        //     const dropdown = bootstrap.Dropdown.getOrCreateInstance(button);
                        //     dropdown.hide();

                        //     // ✅ Reload DataTable with new filter
                        //     if (window.studentTable) {
                        //         window.studentTable.ajax.reload(null, false);
                        //     }
                        // }

                        // // ✅ Clear filter — resets button & filter
                        // function clearFilter() {
                        //     selectedFilter = '';
                        //     const button = document.getElementById('filterG11Button');
                        //     button.innerHTML = `<i class="ri-filter-3-line"></i> Filter Activity Type`;

                        //     const dropdown = bootstrap.Dropdown.getOrCreateInstance(button);
                        //     dropdown.hide();

                        //     if (window.studentTable) {
                        //         window.studentTable.ajax.reload(null, false);
                        //     }
                        // }
                        </script>
                    </div>
                </div>