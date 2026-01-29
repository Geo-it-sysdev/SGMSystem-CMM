<style>
#ssg_table {
    width: 100% !important;
}

.card-body {
    display: flex;
    flex-direction: column;
    padding: 1rem;
}

.table-card {
    flex: 1;
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

                <!-- ssg member -->
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Supreme Student Government (SSG)</h4>
                                <button class="btn btn-outline-primary btn-sm btn-border" id="addSsgBtn">
                                    <i class="ri-add-line"></i> Add SSG Member
                                </button>

                            </div>
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
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end cardbody -->
                        </div><!-- end card -->
                    </div><!-- end ssg member -->

                        <!-- chats -->
                    <div class="col-xxl-6 col-lg-6">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Chat (Concerns Only)</h4>
                            </div>

                            <div class="card-body p-0">
                                <div id="users-chat">
                                    <div class="chat-conversation p-3" id="chat-conversation" data-simplebar
                                        style="height:400px;">

                                        <ul class="list-unstyled chat-conversation-list chat-sm"
                                            id="users-conversation">
                                            <!-- Messages will load here -->
                                        </ul>

                                    </div>
                                </div>

                                <div class="border-top border-top-dashed">
                                    <div class="row g-2 mx-3 mt-2 mb-3">
                                        <div class="col">
                                            <input type="text" id="chatMessage"
                                                class="form-control border-light bg-light"
                                                placeholder="Enter Message..." />
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" id="sendBtn" class="btn btn-info">
                                                <span class="d-none d-sm-inline-block me-2">Send</span>
                                                <i class="mdi mdi-send"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> <!--end chat -->
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
            </div>
            <div class="modal-body">
                <form id="ssgForm">
                    <input type="hidden" name="id" id="member_id">
                    <input type="hidden" name="student_id" id="student_id">

                    <div class="mb-3">
                        <div class="mb-3 position-relative">
                            <label for="student_name" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="student_name" name="student_name"
                                autocomplete="off" required placeholder="Search Student Name">
                            <!-- autocomplete dropdown will appear here -->
                        </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="eventForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add/Edit Event</h5>

                </div>
                <div class="modal-body">
                    <input type="hidden" id="event-date" name="event_date">
                    <div class="mb-3">
                        <label for="event-desc" class="form-label">Event Description</label>
                        <input type="text" id="event-desc" name="description" class="form-control" required
                            placeholder="Enter event description">
                    </div>
                    <div class="mb-3">
                        <label for="event-time" class="form-label">Event Time</label>
                        <input type="time" id="event-time" name="time" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteEventBtn"
                        style="display:none;">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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


<script>
//add event 
$(document).ready(function() {

    let allEvents = [];
    const currentUser = <?= json_encode($this->session->userdata('po_user')) ?>;

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

    function openEventModal(dateStr, event = null) {
        if (event) {
            if (event.user_id != currentUser) {
                Swal.fire('Notice', 'You can only edit your own events', 'info');
                return;
            }
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

    function generateEventHtml(event) {
        const dt = new Date(event.event_date);
        const hours = dt.getHours();
        const minutes = String(dt.getMinutes()).padStart(2, '0');
        const ampm = hours >= 12 ? 'pm' : 'am';
        const displayHour = hours > 12 ? hours - 12 : (hours === 0 ? 12 : hours);
        const canEdit = event.user_id == currentUser;

        return `
        <div class="mini-stats-wid d-flex align-items-center mt-3">
            <div class="flex-shrink-0 avatar-sm">
                <span class="mini-stat-icon avatar-title rounded-circle text-success bg-success-subtle fs-4 ${canEdit ? 'edit-event' : ''}" 
                      data-id="${event.id}">${dt.getDate()}</span>
            </div>
            <div class="flex-grow-1 ms-3">
                <h6 class="mb-1">${event.description}</h6>
                <p class="text-muted mb-0">${event.full_name} (${event.user_type})</p>
            </div>
            <div class="flex-shrink-0">
                <p class="text-muted mb-0">${displayHour}:${minutes} <span class="text-uppercase">${ampm}</span></p>
            </div>
        </div>`;
    }

    function filterEventsByMonth(month, year) {
        $('#event-list').empty();
        allEvents.forEach(event => {
            const dt = new Date(event.event_date);
            if (dt.getMonth() + 1 === month && dt.getFullYear() === year) {
                $('#event-list').append(generateEventHtml(event));
            }
        });
    }

    $('#event-list').on('click', '.edit-event', function() {
        const eventId = $(this).data('id');
        const event = allEvents.find(ev => ev.id == eventId);
        if (event) openEventModal(event.event_date.split(' ')[0], event);
    });

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

    $.getJSON("<?php echo site_url('EventsController/get_events'); ?>", function(events) {
        allEvents = events;
        filterEventsByMonth(fp.currentMonth + 1, fp.currentYear);
    });
});
//end add event







// add ssg member
$(document).ready(function() {

    let professionOrder = [
        'President',
        'Vice President',
        'Secretary',
        'Treasurer',
        'Auditor',
        'PIO',
        'Sgt. at Arms'
    ];

    $.fn.dataTable.ext.order['profession-custom'] = function(settings, col) {
        return this.api().column(col, {
            order: 'index'
        }).nodes().map(function(td, i) {
            let profession = $(td).text().trim();
            let index = professionOrder.indexOf(profession);
            return index === -1 ? professionOrder.length : index;
        });
    };

    // Initialize DataTable
    let ssgTable = $('#ssg_table').DataTable({
        columnDefs: [{
                targets: 1,
                orderDataType: 'profession-custom'
            },
            {
                orderable: false,
                targets: 2
            }
        ],
        scrollY: 'calc(100vh - 300px)',
        paging: false,
        info: false,
        searching: false,
        autoWidth: false,
        responsive: true,
        order: [
            [1, 'asc']
        ]
    });

    // Load SSG members
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

    $('#addSsgBtn').click(function() {
        $('#ssgForm')[0].reset();
        $('#member_id').val('');
        $('#student_id').val('');
        $('#ssgModalTitle').text('Add SSG Member');
        $('#ssgModal').modal('show');
    });

    $("#student_name").on('input', function() {
        let term = $(this).val();
        if (term.length < 3) {
            $("#autocomplete-list").remove();
            return;
        }

        $.ajax({
            url: '<?= base_url("EventsController/search_students") ?>',
            type: 'GET',
            dataType: 'json',
            data: {
                term: term,
                limit: 10
            },
            success: function(data) {
                $("#autocomplete-list").remove();

                if (!data || data.length === 0) return;

                let list = $(
                    '<div id="autocomplete-list" class="list-group position-absolute"></div>'
                );
                list.css({
                    width: $("#student_name").outerWidth(),
                    zIndex: 1000
                });

                data.forEach(function(item) {
                    let option = $(
                        '<a href="#" class="list-group-item list-group-item-action"></a>'
                    );
                    option.text(item.fullname);
                    option.data('id', item.id);
                    option.click(function(e) {
                        e.preventDefault();
                        $("#student_name").val(item.fullname);
                        $("#student_id").val(item.id);
                        $("#autocomplete-list").remove();
                    });
                    list.append(option);
                });

                $("#student_name").after(list);
            },
            error: function(xhr) {
                console.log('Live search error:', xhr.responseText);
            }
        });
    });

    $(document).click(function(e) {
        if (!$(e.target).is('#student_name')) {
            $("#autocomplete-list").remove();
        }
    });

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
                } else if (res.status === 'error') {

                    Swal.fire('Error', res.message, 'error');
                } else {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Something went wrong', 'error');
            }
        });
    });


    // Edit Member
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

    // Delete Member
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
                            Swal.fire('Deleted!', 'Member has been deleted.',
                                'success');
                        }
                    }
                });
            }
        });
    });

});

//end add ssg member



// chat functionality
let my_id = <?= $this->session->userdata('po_user'); ?>;

function loadMessages() {
    $.get("<?= base_url('EventsController/fetch'); ?>", function(res) {
        let data = JSON.parse(res);
        let html = '';

        data.forEach(msg => {
            let isMe = msg.sender_id == my_id;
            let side = isMe ? 'right' : 'left';

            let avatar = msg.photo ?
                "<?= base_url(); ?>" + msg.photo :
                "<?= base_url('assets/img/user-dummy-img.jpg'); ?>";

            html += `
            <li class="chat-list ${side}">
                <div class="conversation-list">

                    ${!isMe ? `
                    <div class="chat-avatar">
                        <img src="${avatar}" alt="">
                    </div>` : ``}

                    <div class="user-chat-content">
                        <div class="ctext-wrap">
                            <div class="ctext-wrap-content">
                                <p class="mb-0 ctext-content">${msg.message}</p>
                            </div>
                        </div>

                        <div class="conversation-name">
                            <small class="text-muted time">
                                ${new Date(msg.created_at).toLocaleTimeString([], { hour:'2-digit', minute:'2-digit' })}
                            </small>
                        </div>
                    </div>
                </div>
            </li>`;
        });

        $('#users-conversation').html(html);
        $('#chat-conversation').scrollTop($('#chat-conversation')[0].scrollHeight);
    });
}

$('#sendBtn').on('click', function() {
    let message = $('#chatMessage').val().trim();
    if (!message) return;

    $.post("<?= base_url('EventsController/send'); ?>", {
        message
    }, function() {
        $('#chatMessage').val('');
        loadMessages();
    });
});

setInterval(loadMessages, 2000);
loadMessages();

window.addEventListener('load', () => {
    if (!sessionStorage.getItem('reloaded')) {
        sessionStorage.setItem('reloaded', 'true');
        location.reload();
    }
});
//end chat functionality
</script>