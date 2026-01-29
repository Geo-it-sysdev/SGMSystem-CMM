<link rel="stylesheet" type="text/css" href="<?= base_url('assets/po_monitoring/CSS/pricing.css'); ?>">
<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h2>𝐏𝐫𝐢𝐜𝐢𝐧𝐠</h2>
        </div>

        <!-- Table Element -->
        <div class="card border-0">
            <div class="card-header">
                <h5 class="card-title">
                    <!-- Basic Table -->
                </h5>
                <h6 class="card-subtitle text-muted">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Filter Forms (Side by Side) -->
                        <div class="d-flex">
                            <label style="font-size: 15px; margin-right: 5px;">𝐃𝐚𝐭𝐞 𝐑𝐚𝐧𝐠𝐞</label>
                            <span style="color: green;">(Due Date)</span>

                            <form id="dateRangeForm" method="post" class="d-flex gap-3 align-items-center">
                                <div class="mb-4" style="max-width: 250px;">
                                    <label for="start_date" class="form-label">𝐒𝐭𝐚𝐫𝐭 𝐃𝐚𝐭𝐞:</label>
                                    <input type="text" id="start_date" name="start_date"
                                        class="form-control form-control-sm" placeholder="YYYY-MM-DD"
                                        autocomplete="off">
                                </div>
                                <div class="mb-4" style="max-width: 250px;">
                                    <label for="end_date" class="form-label">𝐄𝐧𝐝 𝐃𝐚𝐭𝐞:</label>
                                    <input type="text" id="end_date" name="end_date"
                                        class="form-control form-control-sm" placeholder="YYYY-MM-DD"
                                        autocomplete="off">
                                </div>
                            </form>

                            <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 5px;">
                                <div>
                                    <label for="itemcode" style="font-size: 15px; ">𝐈𝐭𝐞𝐦 𝐂𝐨𝐝𝐞</label>
                                </div>
                                <div>
                                    <input type="text" id="itemcode" placeholder="𝐒𝐞𝐚𝐫𝐜𝐡 𝐈𝐭𝐞𝐦 𝐂𝐨𝐝𝐞..."
                                        style="width: 160px; height: 32px;  border-left: 3px solid #084e80; 
                                            border-radius: 6px; background-color: rgba(255, 255, 255, 0.5); font-size: 12px;">
                                </div>
                                <!-- Search Div -->
                                <div id="search_div" class="search_div" style="max-height: 150px; max-width: 400px; overflow-y: auto; border: 1px solid #ddd; 
                                        padding: 10px; background-color: #fff; border-radius: 6px; font-size: 12px;">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="PO no." class="form-label"
                                style="font-size: 15px; margin-left: 15%;">𝐆𝐞𝐧𝐞𝐫𝐚𝐭𝐞 𝐑𝐞𝐩𝐨𝐫𝐭</label><br>
                            <button onclick="PrintExcelPricing()" class="fas fa-file-excel"> 𝐄𝐗𝐂𝐄𝐋</button>
                            <button onclick="printPricingData()" class="fas fa-print"> 𝐏𝐑𝐈𝐍𝐓</button>
                        </div>
                    </div>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="pricingTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><select name="filter6" id="filter6" class="form-control mb-1"
                                        style="width: 140px; font-size: 16px;">
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
                                    <select name="filter1" id="filter1" class="form-control mb-1"
                                        style="font-size: 16px;">
                                        <option value="" disabled selected>&#128188; 𝐁𝐔</option>
                                        <option value="ASC">&#127970; ASC</option>
                                        <option value="CDC">&#128230; CDC</option>
                                        <option value="ICM">&#128717; ICM</option>
                                        <option value="PM">&#9881; PM</option>
                                        <option value="TAL">&#128722; TAL</option>
                                    </select>
                                </th>
                                <th>
                                    <select name="filter3" id="filter3" class="form-control mb-1"
                                        style="appearance: none; width: 185px; height: 35px; font-size: 16px;">
                                        <option value="" disabled selected>&#128179; 𝐏𝐎 𝐍𝐎.</option>
                                        <option value="AS">&#128722; CAS</option>
                                        <option value="SM">&#128178; NON CAS</option>
                                    </select>
                                </th>
                                <th></th>
                                <th>
                                    <select name="filter5" id="filter5" class="form-control mb-1"
                                        style="font-size: 16px;">
                                        <option value="" disabled selected>&#128196; 𝐕 𝐃𝐨𝐜𝐮𝐦𝐞𝐧𝐭</option>
                                        <option value="Original SI">&#128221; Original SI</option>
                                        <option value="Duplicate SI">&#128203; Duplicate SI</option>
                                        <option value="Original DR">&#128221; Original DR</option>
                                        <option value="Duplicate DR">&#128203; Duplicate DR</option>
                                        <option value="SALES ORDER">&#128179; SALES ORDER</option>
                                    </select>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <select name="filter2" id="filter2" class="form-control mb-1"
                                        style="width: 150px; font-size: 16px;">
                                        <option value="" disabled selected>&#128204; 𝐒𝐓𝐀𝐓𝐔𝐒</option>
                                        <option value="Done">&#9989; Done</option>
                                        <option value="Pending">&#9200; Pending</option>
                                    </select>
                                </th>
                            <tr>
                                <th class="text-center" style="font-size: 1.25rem;">VCode</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 200px; max-width: 300px;">
                                    Vendor Name</th>
                                <th class="text-center" style="font-size: 1.25rem;">VTerms</th>
                                <th class="text-center" style="font-size: 1.25rem;">BU</th>
                                <th class="text-center" style="font-size: 1.25rem;">PO No.</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">PR No.</th>
                                <th class="text-center" style="font-size: 1.25rem;">V Document</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">V Doc No.</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">V Doc Date</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">Received Date</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">Days Till Due</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">Date Verified</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 150px;">Due Date</th>
                                <th class="text-center" style="font-size: 1.25rem; min-width: 100px;">Days Till Due</th>
                                <th class="text-center" style="font-size: 1.25rem;">Remarks</th>
                                <th class="text-center" style="font-size: 1.25rem;">Action</th>
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
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tag_modal_label">Pricing Details</h5>
            </div>
            <div class="modal-body">
                <!-- First Form -->
                <form id="forward_form">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="received_date" class="form-label">Received Date</label>
                            <input type="text" class="form-control readonly-style" id="received_date"
                                name="received_date" readonly>
                            <i class="bi bi-lock readonly-icon"></i>
                        </div>
                        <div class="col-md-6">
                            <label for="days_till_due_a" class="form-label">Days Till Due (A)</label>
                            <input type="text" class="form-control readonly-style" id="days_till_due_a"
                                name="days_till_due_a" readonly>
                            <i class="bi bi-lock readonly-icon"></i>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="verified_date" class="form-label">Date Verified</label>
                            <input type="text" class="form-control readonly-style" id="verified_date"
                                name="verified_date" readonly>
                            <i class="bi bi-lock readonly-icon"></i>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="button" class="btn btn-primary btn-sm" id="receive_btn">Receive</button>
                    </div>
                </form>

                <!-- Second Form -->
                <form id="due_form">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" class="form-control readonly-style" id="due_date" name="due_date"
                                readonly placeholder="Select Due Date" required>
                            <i class="bi bi-lock readonly-icon"></i>
                        </div>
                        <div class="col-md-6">
                            <label for="days_till_due_b" class="form-label">Days Till Due (B)</label>
                            <input type="text" class="form-control readonly-style" id="days_till_due_b"
                                name="days_till_due_b" readonly>
                            <i class="bi bi-lock readonly-icon"></i>
                        </div>
                        <br>
                        <div class="col-md-6" id="remarks-container">
                            <label for="remarks" class="form-label">Remarks</label>
                            <select class="form-select" id="remarks" name="remarks" required
                                onchange="convertToInput(this)">
                                <option value="" disabled selected>Select Remark</option>
                                <option value="Return to CDC">Return to CDC</option>
                                <option value="Return to Purchasing">Return to Purchasing</option>
                                <option value="Others">Others</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                    </div>

                    <br><br>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-sm me-2" id="save_btn">Save</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <small class="text-muted">Please ensure all details are entered correctly before
                    saving..ツ</small>
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
                <h5 class="modal-title">Pricing Logs</h5>
            </div>
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="mb-3 table-responsive">
                    <table id="logsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Description</th>
                                <th>Timestamp</th>
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
                <small class="text-muted">For Special Viewing of Pricing Logs.ツ</small>
            </div>
        </div>
    </div>
</div>

<script>
    var pricingTable = $('#pricingTable').DataTable({
        lengthMenu: [10, 25, 50],
        processing: true,
        serverSide: true,
        autoWidth: false,
        ajax: {
            url: "<?php echo base_url('PO_ctrl/fetch_pricing_data'); ?>",
            type: "POST",
            data: function (d) {
                d.storeFilter = $('#filter1').val();
                d.filter2 = $('#filter2').val();
                d.filter5 = $('#filter5').val();
                d.filter6 = $('#filter6').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.filter3 = $('#filter3').val();
            }
        },
        columns: [
            { data: 'vendor' },
            { data: 'name_' },
            { data: 'payment_terms_code' },
            { data: 'store' },
            { data: 'document_no' },
            { data: 'pr_no' },
            { data: 'v_document' },
            { data: 'count_inv_no' },
            { data: 'count_inv_date' },
            { data: 'price_fwd_dt' },
            { data: 'price_days_due_a' },
            { data: 'price_dt_verified' },
            {
                data: 'v_due_date',
                render: function (data, type, row) {
                    const daysDueA = row.price_days_due_a;
                    const daysDueB = row.price_days_due_b;

                    const isComplete = daysDueA && daysDueA.trim() !== '' &&
                        daysDueB && daysDueB.trim() !== '';

                    if (isComplete) {
                        return `<div>${data}<br><big class="text-success">Complete</big></div>`;
                    }

                    if (!data) return ''; // no due date

                    const dueDate = new Date(data);
                    const today = new Date();
                    dueDate.setHours(0, 0, 0, 0);
                    today.setHours(0, 0, 0, 0);

                    const timeDiff = dueDate - today;
                    const dayDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));

                    let status = '';
                    if (dayDiff > 0) {
                        status = `<big class="text-primary">${dayDiff} day(s) left</big>`;
                    } else if (dayDiff < 0) {
                        status = `<big class="text-danger">Overdue by ${Math.abs(dayDiff)} day(s)</big>`;
                    } else {
                        status = `<big class="text-warning">Due today</big>`;
                    }

                    return `<div>${data}<br>${status}</div>`;
                }
            },
            { data: 'price_days_due_b' },
            { data: 'price_rmks' },
            {
                render: function (data, type, row) {
                    const hasInvoice = row.inv_id;
                    return '<div style="display: flex; justify-content: center; align-items: center; gap: 20px;">' +
                        '<button class="btn tag-btn eye-button" data-id="' + row.inv_id + '" style="margin-right: auto; background-color: lightblue;">' +
                        '<span>&#128065;</span></button>' +
                        '<button class="btn logs-btn history-btn" data-id="' + row.inv_id + '" style="margin-left: auto; background-color: #d4edda; border-radius: 50%; width: 45px; height: 45px;">' +
                        '<i class="fa fa-history"></i></button>' +
                        '</div>';
                }
            }
        ],
        createdRow: function (row, data, dataIndex) {
            $(row).find('td').css('font-size', '1.20rem');

            if (!data.price_fwd_dt || !data.price_days_due_a || !data.price_dt_verified || !data.price_days_due_b || !data.price_rmks) {
                for (let i = 0; i <= 15; i++) {
                    $('td', row).eq(i).css('background-color', '#ffcccc');
                }
            }
        },
           
        
        language: {
            processing: "<div style='display: flex; justify-content: center; align-items: center; height: 100%;'>" +
                "<img src='<?php echo base_url('assets/image/Loading-2-unscreen.gif'); ?>' alt='Loading...' class='custom-spinner' style='width: 200px; height: 200px;' />" +
                "</div>"
        }
    });

    $('#filter1, #filter2, #filter5, #filter6, #start_date, #end_date, #filter3').on('change', function () {
        pricingTable.ajax.reload();
    });


    $('#pricingTable').on('click', '.tag-btn', function () {
        const id = $(this).data('id');
        const rowData = pricingTable.row($(this).closest('tr')).data();
        console.log("Row Data:", rowData);

        $('#received_date').val(rowData.price_fwd_dt);
        $('#days_till_due_a').val(rowData.price_days_due_a);
        $('#verified_date').val(rowData.price_dt_verified);
        $('#due_date').val(rowData.v_due_date);
        $('#days_till_due_b').val(rowData.price_days_due_b);
        $('#remarks').val(rowData.price_rmks);
        $('#save_btn').data('id', id);
        $('#receive_btn').data('id', id);

        if (rowData.price_fwd_dt != null && rowData.price_dt_verified == null) {
            $('#receive_btn').html('VERIFY').show();
        } else if (rowData.price_dt_verified != null) {
            $('#receive_btn').hide();
        } else {
            $('#receive_btn').html('RECEIVE').show();
        }

        $('#tag_modal').modal('show');

        calculate_days_due_a();
        calculate_days_due_b();
    });



    $('#receive_btn').on('click', function () {
        const id = $(this).data('id');
        const action = $(this).text() === 'VERIFY' ? 'verify' : 'receive';

        Swal.fire({
            title: action === 'verify' ? 'Has this been verified?' : 'Has VDoc been received?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            customClass: {
                confirmButton: 'btn btn-primary btn-sm',
                cancelButton: 'btn btn-secondary btn-sm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let url = action === 'verify'
                    ? "<?php echo base_url('PO_ctrl/save_verified_date'); ?>"
                    : "<?php echo base_url('PO_ctrl/save_forwarded_date'); ?>";

                let data = { inv_id: id };

                if (action === 'verify') {
                    data.date_verified = new Date().toISOString().slice(0, 10);
                } else {
                    data.forwarded_date = new Date().toISOString().slice(0, 10);
                }

                const currentPage = pricingTable.page();

                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    success: function (response) {
                        let json_obj = JSON.parse(response);
                        if (json_obj.status === "error") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: json_obj.message,
                                confirmButtonText: 'Okay',
                                customClass: {
                                    confirmButton: 'btn btn-danger btn-sm'
                                }
                            });
                        } else {
                            let rowIndex = pricingTable.row($(`.tag-btn[data-id="${id}"]`).closest('tr')).index();
                            let rowData = pricingTable.row(rowIndex).data();

                            if (action === 'verify') {
                                rowData.price_dt_verified = new Date().toISOString().slice(0, 10);
                            } else {
                                rowData.price_fwd_dt = new Date().toISOString().slice(0, 10);
                            }

                            pricingTable.row(rowIndex).data(rowData).draw(false);

                            $('#tag_modal').modal('hide');

                            Swal.fire({
                                icon: 'success',
                                title: 'Saved',
                                text: 'Details saved successfully!',
                                confirmButtonText: 'Okay',
                                customClass: {
                                    confirmButton: 'btn btn-success btn-sm'
                                }
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Error saving details: ", textStatus, errorThrown);
                    }
                });
            }
        });
    });

    // Compute Days Till Due A
    function calculate_days_due_a() {
        const dueDate = new Date($("#due_date").val());
        const receivedDate = new Date($("#received_date").val());

        if (!isNaN(dueDate.getTime()) && !isNaN(receivedDate.getTime())) {
            const timeDiff = dueDate - receivedDate;
            const daysTillDue = Math.ceil(timeDiff / (1000 * 3600 * 24));

            let statusText = '';
            if (daysTillDue < 0) {
                statusText = `${Math.abs(daysTillDue)} days overdue`;
            } else if (daysTillDue > 0) {
                statusText = `${daysTillDue} days advance`;
            } else {
                statusText = 'due date today';
            }

            $("#days_till_due_a").val(statusText);

        } else {
            $("#days_till_due_a").val('');
        }
    }
    $("#due_date, #received_date").on('change', function () {
        calculate_days_due_a();
    });

    // Compute Days Till Due B
    function calculate_days_due_b() {
        var dueDate = new Date($("#due_date").val());
        var verifiedDate = new Date($("#verified_date").val());

        if (!isNaN(dueDate.getTime()) && !isNaN(verifiedDate.getTime())) {
            const timeDiff = dueDate - verifiedDate;
            const daysTillDue = Math.ceil(timeDiff / (1000 * 3600 * 24));

            let statusText = '';
            if (daysTillDue < 0) {
                statusText = `${Math.abs(daysTillDue)} days overdue`;
            } else if (daysTillDue > 0) {
                statusText = `${daysTillDue} days advance`;
            } else {
                statusText = 'due date today';
            }
            $("#days_till_due_b").val(statusText);
        } else {
            $("#days_till_due_b").val('');
        }
    }

    $("#due_date, #closed_date").on('change', function () {
        calculate_days_due_b();
    });


    // SAVE BUTTON
    $('#save_btn').on('click', function () {
        const invId = $('#save_btn').data('id');
        const daysTillDueA = $('#days_till_due_a').val();
        const dueDate = $('#due_date').val();
        const daysTillDueB = $('#days_till_due_b').val();
        const remarks = $('#remarks').val();

        if (!daysTillDueA || !dueDate) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: 'Please fill all required fields!',
                confirmButtonText: 'Okay',
                customClass: {
                    confirmButton: 'btn btn-warning btn-sm'
                }
            });
            return;
        }

        $.ajax({
            url: "<?php echo base_url('PO_ctrl/save_pricing_data'); ?>",
            type: "POST",
            data: {
                inv_id: invId,
                price_days_due_a: daysTillDueA,
                v_due_date: dueDate,
                price_days_due_b: daysTillDueB,
                price_rmks: remarks,
            },
            success: function (response) {
                let json_obj = JSON.parse(response);
                if (json_obj[0] == "error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: json_obj[1],
                        confirmButtonText: 'Okay',
                        customClass: {
                            confirmButton: 'btn btn-danger btn-sm'
                        }
                    });
                } else {
                    $('#pricingTable').DataTable().ajax.reload(null, false);
                    $('#tag_modal').modal('hide');

                    // RESET REMARKS FIELD TO ORIGINAL SELECT
                    const container = document.getElementById('remarks-container');
                    container.innerHTML = `
                        <label for="remarks" class="form-label">Remarks</label>
                        <select class="form-control" id="remarks" name="remarks" required onchange="convertToInput(this)">
                            <option value="" disabled selected>Select Remark</option>
                            <option value="Return to CDC">Return to CDC</option>
                            <option value="Return to Purchasing">Return to Purchasing</option>
                            <option value="Others">Others</option>
                            <option value="Done">Done</option>
                        </select>
                    `;

                    Swal.fire({
                        icon: 'success',
                        title: 'Saved',
                        text: 'Details saved successfully!',
                        confirmButtonText: 'Okay',
                        customClass: {
                            confirmButton: 'btn btn-success btn-sm'
                        }
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error saving details: ", textStatus, errorThrown);
            }
        });
    });


    //REMARKS OTHERS
    function convertToInput(selectElement) {
        if (selectElement.value === "Others") {
            const container = document.getElementById('remarks-container');

            const input = document.createElement("input");
            input.type = "text";
            input.name = "remarks";
            input.id = "remarks";
            input.className = "form-control";
            input.placeholder = "Enter custom remark";
            input.required = true;

            container.replaceChild(input, selectElement);

            input.focus();
        }
    }



    //History Logs
    const logsTable = $('#logsTable').DataTable({
        paging: false,
        searching: false
    });

    $('#pricingTable').on('click', '.logs-btn', function () {
        const invId = $(this).data('id');
        loadHistoryLogs(invId);
        $('#logs_modal').modal('show');
    });

    function loadHistoryLogs(invId) {
        if (!invId) {
            console.error("Invoice ID is undefined. Check the data-id attribute on the button.");
            return;
        }

        $.ajax({
            url: "<?php echo base_url('PO_ctrl/fetch_pricing_history_logs'); ?>",
            type: "POST",
            data: { inv_id: invId },
            success: function (response) {
                let logs_ = JSON.parse(response);
                console.log(logs_);
                let result = logs_.logs;
                let array_insert = [];

                for (let c = 0; c < result.length; c++) {
                    array_insert.push([
                        result[c].full_name,
                        result[c].description,
                        result[c].timestamp]);
                }
                console.log(array_insert);
                logsTable.clear().rows.add(array_insert).draw();
            }
        });
    }


    // Item code
    $('#itemcode').on('input', function () {
        let itemcode = $('#itemcode').val();
        console.log(itemcode);

        $.ajax({
            url: "<?php echo base_url('PO_ctrl/search_price'); ?>",
            type: "POST",
            data: {
                itemcode: itemcode,
            },

            success: function (response) {
                let json_obj = JSON.parse(response);
                if (json_obj.length > 0) {
                    let output = '<ul>';
                    json_obj.forEach(item => {
                        output += `<li>Description: ${item.description}</li>`;
                        output += `<li>Unit Price: ${item.unit_price}</li>`;
                        output += `<li>Unit Price Including VAT: ${item.unit_price_vat}</li>`;
                        output += `<li>Unit of Measure Code: ${item.uom}</li>`;
                    });
                    output += '</ul>';
                    $('#search_div').html(output);
                } else {
                    $('#search_div').html('<p>No data found for the given Item Code.</p>');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error fetching details: ", textStatus, errorThrown);
                $('#search_div').html('<p>Error occurred while fetching data.</p>');
            }
        });
    });
</script>

<script>
    function printPricingData() {
        const filter1 = $('#filter1').val();
        const filter5 = $('#filter5').val();
        const filter2 = $('#filter2').val();
        const filter6 = $('#filter6').val();
        const filter3 = $('#filter3').val();
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        let storeText = ($('#filter1 option:selected').text() || 'All');
        let documentText = ($('#filter5 option:selected').text() || 'All');
        let statusText = ($('#filter2 option:selected').text() || 'All');
        let vtermsText = ($('#filter6 option:selected').text() || 'All');
        let dateRangeText = (startDate && endDate) ? (startDate + ' to ' + endDate) : 'N/A';

        documentText = documentText === 'All' ? 'ALL' : documentText;
        statusText = statusText === 'All' ? 'ALL' : statusText;
        dateRangeText = (startDate && endDate) ? (startDate + ' To ' + endDate) : 'N/A';

        $.ajax({
            url: "<?php echo base_url('PO_ctrl/fetch_pricing_data'); ?>",
            type: "POST",
            data: {
                search: { value: '' },
                start: 0,
                length: -1,
                storeFilter: filter1,
                filter5: filter5,
                filter2: filter2,
                filter6: filter6,
                start_date: startDate,
                end_date: endDate,
            },
            success: function (response) {
                const parsedData = JSON.parse(response);

                if (parsedData.data.length === 0) {
                    alert("No records match the selected filters.");
                    return;
                }

                let newWindow = window.open('', '_blank');
                if (newWindow) {
                    let content = '<html><head><style>' +
                        'table { width: 100%; text-align: left; border-collapse: collapse; font-size: 12px; }' +
                        'th, td { padding: 5px; border: 1px solid black; }' +
                        '</style></head><body>' +
                        '<h1>Pricing Report</h1>' +
                        '<p><strong>BU:</strong> ' + storeText + '</p>' +
                        '<p><strong>V Document:</strong> ' + documentText + '</p>' +
                        '<p><strong>Status:</strong> ' + statusText + '</p>' +
                        '<p><strong>Date Range (Due Date):</strong> ' + dateRangeText + '</p>' +
                        '<table>' +
                        '<thead><tr>' +
                        '<th>VCode</th><th>Vendor Name</th><th>VTerms</th>' +
                        '<th>BU</th><th>PR No.</th><th>V Document</th>' +
                        '<th>V Doc No.</th><th>V Doc Date</th><th>Received Date</th>' +
                        '<th>Days Till Due</th><th>Date Verified</th><th>Due Date</th>' +
                        '<th>Days Till Due</th><th>Remarks</th>' +
                        '</tr></thead><tbody>';

                    parsedData.data.forEach(row => {
                        content += '<tr>' +
                            '<td>' + (row.vendor || 'N/A') + '</td>' +
                            '<td>' + (row.name_ || 'N/A') + '</td>' +
                            '<td>' + (row.payment_terms_code || 'N/A') + '</td>' +
                            '<td>' + (row.store || 'N/A') + '</td>' +
                            '<td>' + (row.pr_no || 'N/A') + '</td>' +
                            '<td>' + (row.v_document || 'N/A') + '</td>' +
                            '<td>' + (row.count_inv_no || 'N/A') + '</td>' +
                            '<td>' + (row.count_inv_date || 'N/A') + '</td>' +
                            '<td>' + (row.price_fwd_dt || 'N/A') + '</td>' +
                            '<td>' + (row.price_days_due_a || 'N/A') + '</td>' +
                            '<td>' + (row.price_dt_verified || 'N/A') + '</td>' +
                            '<td>' + (row.v_due_date || 'N/A') + '</td>' +
                            '<td>' + (row.price_days_due_b || 'N/A') + '</td>' +
                            '<td>' + (row.price_rmks || 'N/A') + '</td>' +
                            '</tr>';
                    });

                    content += '</tbody></table></body></html>';

                    newWindow.document.write(content);
                    newWindow.document.close();
                    newWindow.print();
                } else {
                    alert("Popup blocked! Please allow popups for this website.");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
                alert("There was an error processing the request.");
            }
        });
    }


</script>

<script>
    function PrintExcelPricing() {
        const filter1 = $('#filter1').val();
        const filter5 = $('#filter5').val();
        const filter2 = $('#filter2').val();
        const filter6 = $('#filter6').val();
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        let storeText = ($('#filter1 option:selected').text() || 'All');
        let documentText = ($('#filter5 option:selected').text() || 'All');
        let statusText = ($('#filter2 option:selected').text() || 'All');
        let vtermsText = ($('#filter6 option:selected').text() || 'All');
        let dateRangeText = (startDate && endDate) ? (startDate + ' to ' + endDate) : 'N/A';

        documentText = documentText === 'All' ? 'ALL' : documentText;
        statusText = statusText === 'All' ? 'ALL' : statusText;
        dateRangeText = (startDate && endDate) ? (startDate + ' To ' + endDate) : 'N/A';

        $.ajax({
            url: "<?php echo base_url('PO_ctrl/fetch_pricing_data'); ?>",
            type: "POST",
            data: {
                search: { value: '' },
                start: 0,
                length: -1,
                storeFilter: filter1,
                filter5: filter5,
                filter2: filter2,
                filter6: filter6,
                start_date: startDate,
                end_date: endDate,
            },
            success: function (response) {
                const parsedData = JSON.parse(response);

                if (parsedData.data.length === 0) {
                    alert("No records match the selected filters.");
                    return;
                }

                let excelData = [];
                let headers = ['VENDOR CODE', '', 'VENDOR NAME', '', 'VENDOR TERMS', '', 'BU', '', 'PR No.', '', 'V Document', '', 'V Doc No.', '', 'V Doc Date', '',
                    'Received Date', '', 'Days Till Due', '', 'Date Verified', '', 'Due Date', '', 'Days Till Due', '', 'Remarks'];
                excelData.push(headers);

                parsedData.data.forEach(row => {
                    excelData.push([
                        row.vendor || 'N/A',
                        '',
                        row.name_ || 'N/A',
                        '',
                        row.payment_terms_code || 'N/A',
                        '',
                        row.store || 'N/A',
                        '',
                        row.pr_no || 'N/A',
                        '',
                        row.v_document || 'N/A',
                        '',
                        row.count_inv_no || 'N/A',
                        '',
                        row.count_inv_date || 'N/A',
                        '',
                        row.price_fwd_dt || 'N/A',
                        '',
                        row.price_days_due_a || 'N/A',
                        '',
                        row.price_dt_verified || 'N/A',
                        '',
                        row.v_due_date || 'N/A',
                        '',
                        row.price_days_due_b || 'N/A',
                        '',
                        row.price_rmks || 'N/A'
                    ]);
                });

                const ws = XLSX.utils.aoa_to_sheet(excelData);

                ws['!cols'] = [
                    { wpx: 100 }, { wpx: 15 },
                    { wpx: 300 }, { wpx: 15 },
                    { wpx: 100 }, { wpx: 15 },
                    { wpx: 50 }, { wpx: 15 },
                    { wpx: 140 }, { wpx: 15 },
                    { wpx: 80 }, { wpx: 15 },
                    { wpx: 110 }, { wpx: 15 },
                    { wpx: 100 }, { wpx: 15 },
                    { wpx: 150 }, { wpx: 15 },
                    { wpx: 150 }, { wpx: 15 },
                    { wpx: 150 }, { wpx: 15 },
                    { wpx: 100 }, { wpx: 15 },
                    { wpx: 100 }, { wpx: 15 },
                    { wpx: 100 }
                ];

                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Pricing Report");

                XLSX.writeFile(wb, "Pricing_Report.xlsx");
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error);
                alert("There was an error processing the request.");
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
</body>

</html>