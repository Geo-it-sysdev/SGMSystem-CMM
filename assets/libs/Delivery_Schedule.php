<link rel="stylesheet" type="text/css" href="<?= base_url('assets/po_monitoring/CSS/delivery_schedule.css'); ?>">
<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h2>𝐃𝐞𝐥𝐢𝐯𝐞𝐫𝐲 𝐒𝐜𝐡𝐞𝐝𝐮𝐥𝐞</h2>
        </div>
        <?php
        $user_id = $this->session->userdata("po_user");
        if (isset($user_id)) {
            $user = $this->Auth_model->get_user_by_user_id($user_id);
        }
        ?>
        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">
                    <!-- Basic Table -->
                </h5>
                <h6 class="card-subtitle text-muted">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex">

                            <form id="dateRangeForm" method="post" class="d-flex gap-3 align-items-center">
                                <label style="font-size: 15px; margin-right: 20px;">𝐃𝐚𝐭𝐞 𝐑𝐚𝐧𝐠𝐞<span
                                        style="color: green;">(𝐃𝐞𝐥𝐢𝐯𝐞𝐫𝐲 𝐒𝐜𝐡𝐞𝐝𝐮𝐥𝐞)</span></label>
                                <div class="mb-4" style="max-width: 250px;">

                                    <label for="start_date" class="form-label">𝐒𝐭𝐚𝐫𝐭 𝐃𝐚𝐭𝐞:</label>
                                    <input type="text" id="start_date" name="start_date"
                                        class="form-control form-control-sm" placeholder="YYYY-MM-DD"
                                        autocomplete="off">
                                </div>
                                <label style="font-size: 14px; margin-right: 20px;"><span
                                        style="color: green;"></span></label>

                                <div class="mb-4" style="max-width: 250px;">
                                    <label for="end_date" class="form-label">𝐄𝐧𝐝 𝐃𝐚𝐭𝐞:</label>
                                    <input type="text" id="end_date" name="end_date"
                                        class="form-control form-control-sm" placeholder="YYYY-MM-DD"
                                        autocomplete="off">
                                </div>
                            </form>
                        </div>
                        <div>

                            <label for="PO no." class="form-label"
                                style="font-size: 15px; margin-left: 15%;">𝐆𝐞𝐧𝐞𝐫𝐚𝐭𝐞 𝐑𝐞𝐩𝐨𝐫𝐭</label><br>
                            <button onclick="exportToExcel()" class="fas fa-file-excel"> 𝐄𝐗𝐂𝐄𝐥</button>
                            <button onclick="printDeliveryData()" class="fas fa-print"> 𝐏𝐑𝐈𝐍𝐓</button>
                        </div>
                    </div>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="deliveryTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><select name="filter6" id="filter6" class="form-control mb-1"
                                        style="width: 150px; font-size: 16px;">
                                        <option value="" disabled selected>🧾 𝐕𝐓𝐄𝐑𝐌𝐒</option>
                                        <option value="CWO">📅 CWO</option>
                                        <option value="COD">📦 COD</option>
                                        <option value="CASH">💰 CASH</option>
                                        <option value="150DAYS">⏳ 150DAYS</option>
                                        <option value="60DAYS">⏳ 60DAYS</option>
                                        <option value="45DAYS">⏳ 45DAYS</option>
                                        <option value="30DAYS">⏳ 30DAYS</option>
                                        <option value="25DAYS">⏳ 25DAYS</option>
                                        <option value="15DAYS">⏳ 15DAYS</option>
                                        <option value="COD15DAYS">📦 COD15DAYS</option>
                                        <option value="COD7DAYS">📦 COD7DAYS</option>
                                    </select>
                                </th>
                                <th>
                                    <select id="filter1" class="form-control" style="font-size: 16px;">
                                        <option value="" disabled selected>&#128188; 𝐁𝐔</option>
                                        <option value="ASC">&#127970; ASC</option>
                                        <option value="CDC">&#128230; CDC</option>
                                        <option value="ICM">&#128717; ICM</option>
                                        <option value="PM">&#9881; PM</option>
                                        <option value="TAL">&#128722; TAL</option>
                                    </select>

                                </th>
                                <th></th>
                                <th>
                                    <select name="filter2" id="filter2" class="form-control mb-1"
                                        style="appearance: none; width: 185px; height: 35px; font-size: 16px;">
                                        <option value="" disabled selected>&#128179; 𝐏𝐎 𝐍𝐎.</option>
                                        <option value="AS">&#128722; CAS</option>
                                        <option value="SM">&#128178; NON CAS</option>
                                    </select>

                                </th>
                                <th></th>
                                <th></th>
                                <th>
                                    <select name="filter5" id="filter5" class="form-control mb-1"
                                        style="width: 150px; font-size: 16px;">
                                        <option value="" disabled selected>&#128204; 𝐒𝐓𝐀𝐓𝐔𝐒</option>
                                        <option value="Done">&#9989; Done</option>
                                        <option value="Pending">&#9200; Pending</option>
                                        <option value="On-going">&#128640; Ongoing</option>
                                        <option value="Cancelled">&#10060; Cancelled</option>
                                        <option value="Moved">&#128205; Moved</option>
                                        <option value="Emergency">&#9888; Emergency</option>
                                        <option value="Delayed">&#9201; Delayed</option>
                                        <option value="Waiting">&#128338; Waiting</option>
                                    </select>
                                </th>
                                <th></th>
                                <th></th>
                                <?php if ($user->user_type == 'Corporate Manager' || $user->user_type == 'Delivery Schedule'): ?>
                                    <th></th>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th style="font-size: 1.25rem;">VCode</th>
                                <th style="font-size: 1.25rem; min-width: 300px;">Vendor Name</th>
                                <th style="font-size: 1.25rem;">VTerms</th>
                                <th style="font-size: 1.25rem;">BU</th>
                                <th style="font-size: 1.25rem; min-width: 100px;">PO Date</th>
                                <th style="font-size: 1.25rem;">PO No.</th>
                                <th style="font-size: 1.25rem; min-width: 200px;">Shipping Details</th>
                                <th style="font-size: 1.25rem; min-width: 120px;">Delivery Schedule</th>
                                <th style="font-size: 1.25rem;">Status</th>
                                <th style="font-size: 1.25rem; min-width: 150px;">Date and Time Received</th>
                                <th style="font-size: 1.25rem; min-width: 100px;">Remarks</th>
                                <?php if ($user->user_type == 'Corporate Manager' || $user->user_type == 'Delivery Schedule'): ?>
                                    <th class="text-center" style="font-size: 1.25rem;">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content text-center">
            <div class="modal-body">
                <b style="color:#d33;">𝐋𝐨𝐚𝐝𝐢𝐧𝐠.....</b><br><br>
                <img src="<?php echo base_url('assets/image/Loading-2-unscreen.gif'); ?>" width="80"
                    height="80"><br><br>
                <b style="color:#555;">𝐏𝐥𝐞𝐚𝐬𝐞 𝐰𝐚𝐢𝐭...</b>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tag_modal" tabindex="-1" aria-labelledby="tag_modal_label" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tag_modal_label">Delivery Schedule Tracker</h5>
            </div>
            <div class="modal-body">
                <form id="delivery_schedule_form">
                    <div class="row mb-3">
                        <?php if ($user->user_type == 'Corporate Manager' || $user->user_category == 'Scheduling'): ?>
                            <div class="col-md-6">
                                <label for="delivery_schedule" class="form-label">Delivery Schedule</label>
                                <input type="date" class="form-control" id="delivery_schedule" name="delivery_schedule"
                                    required>
                            </div>
                        <?php endif; ?>

                        <?php if ($user->user_type == 'Corporate Manager' || $user->user_category == 'Status'): ?>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Done">Done</option>
                                    <option value="On-going">Ongoing</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Moved">Moved</option>
                                    <option value="Emergency">Emergency</option>
                                    <option value="Delayed">Delayed</option>
                                    <option value="Waiting">Waiting</option>
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3" id="received_datetime_container" style="display: none;">
                        <label for="received_datetime" class="form-label">Date and Time Received</label>
                        <input type="text" class="form-control" id="received_datetime" name="received_datetime"
                            readonly>
                    </div>

                    <?php if ($user->user_type == 'Corporate Manager' || $user->user_category == 'Status'): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="remarks" class="form-label">Remarks</label>
                                <input type="text" class="form-control" id="remarks" name="remarks"
                                    placeholder="Enter Remarks" required>
                            </div>
                        </div>
                    <?php endif; ?>

                    <br>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm me-2" id="save_btn">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <small class="text-muted">Please ensure all details are entered correctly before
                    saving.ツ</small>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Viewing History Logs -->
<div class="modal fade" id="logs_modal" tabindex="-1" aria-labelledby="logs_modal_label" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delivery Logs</h5>
                </button>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="mb-3 table-responsive">
                    <table id="logsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Status</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <small class="text-muted">For Exclusive Viewing of Delivery Schedule Logs.ツ</small>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var deliveryTable = $('#deliveryTable').DataTable({
                lengthMenu: [10, 25, 50],
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                order: [[4, 'desc']],
                ajax: {
                    url: "<?php echo base_url('PO_ctrl/fetch_delivery_logs'); ?>",
                    type: "POST",
                    data: function (d) {
                        d.filter1 = $('#filter1').val(); // Store filter
                        d.filter5 = $('#filter5').val();
                        d.filter6 = $('#filter6').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.po_prefix = $('#filter2').val();
                    }

                },
                columns: [
                    { data: 'vendor', className: 'text-center' },
                    { data: 'name_', className: 'text-center' },
                    { data: 'payment_terms_code', className: 'text-center' },
                    { data: 'store', className: 'text-center' },
                    { data: 'date_', width: '150px', className: 'text-center' },
                    { data: 'document_no', className: 'text-center' },
                    { data: 'ship_details', className: 'text-center' },
                    { data: 'del_schedule', className: 'text-center' },
                    { data: 'del_status', className: 'text-center' },
                    { data: 'del_date_received', className: 'text-center' },
                    { data: 'del_remarks', className: 'text-center' },
                    <?php if ($user->user_type == 'Corporate Manager' || $user->user_type == 'Delivery Schedule'): ?>
                                            {
                            render: function (data, type, row) {
                                return '<div style="display: flex; justify-content: center; align-items: center; gap: 20px;">' +
                                    '<button class="btn tag-btn eye-button" data-id="' + row.hd_id + '" style="margin-right: auto; background-color: lightblue;"><span>&#128065;</span></button>' +
                                    '<button class="btn logs-btn history-btn" data-id="' + row.hd_id + '" style="margin-left: auto; background-color: #d4edda; border-radius: 50%; width: 45px; height: 45px;"><i class="fa fa-history"></i></button>' +
                                    '</div>';
                            }
                        }
                    <?php endif; ?>
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).find('td').css('font-size', '1.20rem');

                    if (!data.del_schedule || !data.del_status || !data.del_date_received || !data.del_remarks) {
                        $('td', row).css('background-color', '#ffcccc');
                    }
                },
                // initComplete: function () {
                //     $('#pendingPOTable').css('width', '100%');
                // },
                language: {
                    processing: "<div style='display: flex; justify-content: center; align-items: center; height: 100%;'>" +
                        "<img src='<?php echo base_url('assets/image/Loading-2-unscreen.gif'); ?>' alt='Loading...' class='custom-spinner' style='width: 200px; height: 200px;' />" +
                        "</div>"
                }
            });


            $('#filter1, #filter5, #filter2, #filter6, #start_date, #end_date').change(function () {
                deliveryTable.ajax.reload();
            });


            const logsTable = $('#logsTable').DataTable({
                paging: false,
                searching: false
            });

            $('#deliveryTable').on('click', '.tag-btn', function () {
                const id = $(this).data('id');
                const rowData = deliveryTable.row($(this).closest('tr')).data();
                console.log(rowData);

                $('#loadingModal').modal('show');

                setTimeout(function () {
                    $('#delivery_schedule').val(rowData.del_schedule || '');
                    $('#status').val(rowData.del_status || '');
                    $('#received_datetime').val(rowData.del_date_received || '');
                    $('#remarks').val(rowData.del_remarks || '');
                    $('#save_btn').data('id', id);

                    $('#loadingModal').modal('hide');
                    $('#tag_modal').modal('show');
                }, 500);
            });



            function toggleFieldStates() {
                const deliverySchedule = $('#delivery_schedule');
                const status = $('#status');

                if (deliverySchedule.val()) {
                    deliverySchedule.prop('disabled', true);
                }

                if (status.val() === 'Done') {
                    status.prop('disabled', true);
                } else {
                    status.prop('disabled', false);
                }
                handleStatus();
            }

            function handleStatus() {
                const status = $('#status');
                const remarks = $('#remarks');
                const saveButton = $('#save_btn');
                const deliverySchedule = $('#delivery_schedule');

                if (status.val() === 'Done') {
                    deliverySchedule.prop('disabled', true);
                    status.prop('disabled', true);
                    remarks.prop('disabled', false);
                    saveButton.prop('disabled', remarks.val().trim() === '');
                } else {
                    remarks.prop('disabled', false);
                    saveButton.prop('disabled', false);
                }
            }

            $('#status').change(function () {
                const selectedStatus = $(this).val();
                if (selectedStatus === 'Done') {
                    const currentDateTime = new Date().toLocaleString();
                    $('#received_datetime').val(currentDateTime);
                } else {
                    $('#received_datetime').val('');
                }
            });


            $('#save_btn').on('click', function () {
                const logId = $(this).data('id');
                const deliverySchedule = $('#delivery_schedule').val();
                const status = $('#status').val();
                const receivedDatetime = $('#received_datetime').val();
                const remarks = $('#remarks').val();


                $.ajax({
                    url: "<?php echo base_url('PO_ctrl/save_delivery_details'); ?>",
                    type: "POST",
                    data: {
                        log_id: logId,
                        del_schedule: deliverySchedule,
                        del_status: status,
                        del_date_received: receivedDatetime,
                        del_remarks: remarks,
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Details saved successfully!',
                            confirmButtonText: 'Okay',
                            customClass: {
                                confirmButton: 'btn btn-success btn-sm'
                            }
                        }).then(function () {

                            if (status === 'Done') {
                                $('#status').prop('disabled', true);
                                $('#delivery_schedule').prop('disabled', true);
                                $('#remarks').prop('disabled', false);
                            }
                            $('#tag_modal').modal('hide');
                            if (deliveryTable) {
                                deliveryTable.ajax.reload(null, false);
                            }
                        });
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while saving data.'
                        });
                    }
                });
            });


            $('#remarks').on('input', function () {
                handleStatus();
            });


            $('#tag_modal').on('hidden.bs.modal', function () {
                $('#delivery_schedule').prop('disabled', false);
                $('#status').prop('disabled', false);
                $('#remarks').prop('disabled', false);
                $('#save_btn').prop('disabled', false);
            });


            $('#deliveryTable').on('click', '.logs-btn', function () {
                const id = $(this).data('id');
                loadHistoryLogs(id);
                $('#logs_modal').modal('show');
            });


            function loadHistoryLogs(id) {
                $.ajax({
                    url: "<?php echo base_url('PO_ctrl/fetch_history_logs'); ?>",
                    type: "POST",
                    data: { log_id: id },
                    success: function (response) {
                        let logs_ = JSON.parse(response);
                        console.log(logs_);
                        let result = logs_.logs;
                        let array_insert = [];

                        for (let c = 0; c < result.length; c++) {
                            array_insert.push([
                                result[c].del_status,
                                result[c].full_name,
                                result[c].description,
                                result[c].timestamp]);
                        }
                        console.log(array_insert);
                        logsTable.clear().rows.add(array_insert).draw();
                    }
                });
            }
        });



    </script>

    <!-- Print =========================================================================--->
    <script>
function printDeliveryData() {
    const filter = $('#filter5').val();
    const storeFilter = $('#filter1').val();
    const startDate = $('#start_date').val();
    const endDate = $('#end_date').val();
    const poPrefix = $('#filter2').val();
    const filter6 = $('#filter6').val();

    $.ajax({
        url: "<?php echo base_url('PO_ctrl/fetch_delivery_logs'); ?>",
        type: "POST",
        data: {
            search: { value: '' },
            start: 0,
            length: -1,
            filter5: filter,
            filter1: storeFilter,
            po_prefix: poPrefix,
            start_date: startDate,
            end_date: endDate,
            filter6: filter6,
        },
        success: function (response) {
            const parsedData = JSON.parse(response);
            if (parsedData.data.length === 0) {
                alert("No records match the selected filters.");
                return;
            }

            let newWindow = window.open('', '_blank');
            if (newWindow) {
                const runDateTime = new Date().toLocaleString();

                // Correct plain-text filter display with no icons, show 'N/A' if empty
                const BUText = storeFilter ? $('#filter1 option:selected').text().trim() : 'N/A';
                const StatusText = filter ? $('#filter5 option:selected').text().trim() : 'N/A';
                const dateRangeText = (startDate && endDate) ? `${startDate} to ${endDate}` : 'N/A';

                let style = `
                    <style>
                        @page {
                            size: 8.5in 13in; /* Long Bond Paper */
                            margin: 15mm 15mm 20mm 15mm;
                        }
                        body {
                            font-family: Arial, sans-serif;
                            font-size: 10px;
                            margin: 0;
                            text-align: center;
                        }
                        h1, h2 {
                            margin: 2px 0;
                            padding: 0;
                        }
                        .header-row {
                            display: flex;
                            justify-content: space-between;
                            margin-bottom: 5px;
                            font-weight: bold;
                            padding: 0 10px;
                        }
                        .header-row div {
                            flex: 1;
                        }
                        .info-section {
                            margin-bottom: 15px;
                            text-align: left;
                            padding-left: 10px;
                            font-weight: bold;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            table-layout: fixed;
                            word-wrap: break-word;
                        }
                        th, td {
                            border: 1px solid black;
                            padding: 4px 6px;
                            overflow-wrap: break-word;
                            text-align: center;
                        }
                        thead th {
                            background-color: #f0f0f0;
                            font-size: 11px;
                        }
                        tbody td {
                            font-size: 10px;
                        }
                    </style>
                `;

                let header = `
                    <div>
                        <h1>Alturas Group Of Companies</h1>
                        <h2>Delivery Schedule Report</h2>
                        <div class="header-row">
                            <div></div>
                            <div style="text-align: right;">
                                Run Date/Time: ${runDateTime}
                            </div>
                        </div>
                        <div class="info-section">
                            <p>BU : ${BUText}</p>
                            <p>Status : ${StatusText}</p>
                            <p>Date Range (Delivery Schedule) : ${dateRangeText}</p>
                        </div>
                    </div>
                `;

                let content = `
                    ${header}
                    <table>
                        <thead>
                            <tr>
                                <th>Vendor Code</th>
                                <th>Vendor Name</th>
                                <th>VTerms</th>
                                <th>BU</th>
                                <th>PO Date</th>
                                <th>PO No.</th>
                                <th>Shipping Details</th>
                                <th>Delivery Schedule</th>
                                <th>Status</th>
                                <th>Date and Time Received</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                parsedData.data.forEach(row => {
                    content += `<tr>
                        <td>${row.vendor}</td>
                        <td>${row.name_}</td>
                        <td>${row.payment_terms_code || 'N/A'}</td>
                        <td>${row.store}</td>
                        <td>${row.date_}</td>
                        <td>${row.document_no}</td>
                        <td>${row.ship_details || 'N/A'}</td>
                        <td>${row.del_schedule || 'N/A'}</td>
                        <td>${row.del_status || 'N/A'}</td>
                        <td>${row.del_date_received || 'N/A'}</td>
                        <td>${row.del_remarks || 'N/A'}</td>
                    </tr>`;
                });

                content += `
                        </tbody>
                    </table>
                `;

                newWindow.document.write('<html><head><title></title>' + style + '</head><body>' + content + '</body></html>');
                newWindow.document.close();

                newWindow.focus();
                newWindow.print();
            } else {
                alert("Popup blocked! Please allow popups for this website.");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX error:", status, error);
        }
    });
}


    </script>

    <!-- Excel ========================================================================== -->
    <script>
        function exportToExcel() {
            const filter = $('#filter5').val();
            const storeFilter = $('#filter1').val();
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();
            const poPrefix = $('#filter2').val();

            $.ajax({
                url: "<?php echo base_url('PO_ctrl/fetch_delivery_logs'); ?>",
                type: "POST",
                data: {
                    search: { value: '' },
                    start: 0,
                    length: -1,
                    filter5: filter,
                    filter1: storeFilter,
                    po_prefix: poPrefix,
                    start_date: startDate,
                    end_date: endDate,
                },
                success: function (response) {
                    const parsedData = JSON.parse(response);
                    if (parsedData.data.length === 0) {
                        alert("No records match the selected filters.");
                        return;
                    }


                    const worksheetData = [
                        [
                            "Vendor Code", "", "Vendor Name", "", "VTerms",
                            "", "BU", "", "PO Date", "", "PO No.",
                            "", "Shipping Details", "", "Delivery Schedule",
                            "", "Status", "", "Date and Time Received", "", "Remarks"
                        ]
                    ];

                    parsedData.data.forEach(row => {
                        worksheetData.push([
                            row.vendor, "",
                            row.name_, "",
                            row.payment_terms_code || 'N/A', "",
                            row.store, "",
                            row.date_, "",
                            row.document_no, "",
                            row.ship_details || 'N/A', "",
                            row.del_schedule || 'N/A', "",
                            row.del_status || 'N/A', "",
                            row.del_date_received || 'N/A', "",
                            row.del_remarks || 'N/A'
                        ]);
                    });


                    const workbook = XLSX.utils.book_new();
                    const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);


                    worksheet['!cols'] = [
                        { wpx: 80 }, { wpx: 15 },
                        { wpx: 300 }, { wpx: 15 },
                        { wpx: 70 }, { wpx: 15 },
                        { wpx: 50 }, { wpx: 15 },
                        { wpx: 80 }, { wpx: 15 },
                        { wpx: 140 }, { wpx: 15 },
                        { wpx: 130 }, { wpx: 15 },
                        { wpx: 110 }, { wpx: 15 },
                        { wpx: 60 }, { wpx: 15 },
                        { wpx: 130 }, { wpx: 15 },
                        { wpx: 150 }
                    ];


                    XLSX.utils.book_append_sheet(workbook, worksheet, "Delivery Logs");


                    const filename = `Delivery_Schedule_reports_${new Date().toISOString().slice(0, 10)}.xlsx`;
                    XLSX.writeFile(workbook, filename);
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", status, error);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            $("#start_date, #end_date").datepicker({
                dateFormat: "yy-mm-dd",
                showAnim: "fadeIn",
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                yearRange: "c-10:c+10",
                buttonImageOnly: true,
                buttonText: "Select Date",
            });
        });
    </script>
</div>

</body>

</html>