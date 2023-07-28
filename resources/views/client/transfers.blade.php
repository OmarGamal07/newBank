@extends('layouts.app')
@section('title')
    My Transfers
@endsection

@section('content')
    <div class="bg-info open d-flex align-items-baseline justify-content-between p-2">
        <span class="search-text fw-bold me-2">نموذج اضافة حوالة</span>
        <button class="btn border-0 search-button bg-info">
            <i class="fa-solid  arrow fs-4 border-0 fa-circle-chevron-down"></i>
        </button>
    </div>
    <div class="container mt-5">
        <form id="filterForm" method="GET" action="{{route('transfer.filter')}}">
            <div class="row gap-2 gap-md-1 mt-2">
                <div class="date col-sm-3 col-md-5 col-lg-3 col-xl-1">
                    <input type="text" name="from_date" class="form-control" onfocus="(this.type = 'date')" placeholder="من تاريخ">
                </div>
                <div class="date col-sm-3 col-md-5 col-lg-3 col-xl-1">
                    <input type="text" name="to_date" class="form-control" onfocus="(this.type = 'date')" placeholder="إلى تاريخ">
                </div>
                <div class="col-sm-4 col-md-4 col-lg-5 col-xl-2">
                    <select class="form-control" name="client_name">
                        <option value="" selected disabled>اسم المستخدم</option>
                        <option value="الجميع">الجميع</option>
                        @foreach($clients as $client)
                            <option value="{{$client->name}}" {{old('client_name') === $client->name ? 'selected' : ''}}>{{$client->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-5 col-md-3 col-xl-2">
                    <select class="form-control" name="type_name">
                        <option value="" selected disabled> نوع العملية</option>
                        <option value="الجميع"> الجميع </option>
                        @foreach($types as $type)
                            <option value="{{$type->name}}">{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-5 col-md-3 col-xl-2">
                    <select class="form-control" name="bank_name">
                        <option value="" selected disabled> البنك</option>
                        <option value="الجميع"> الجميع </option>
                        @foreach($banks as $bank)
                            <option value="{{$bank->name}}">{{$bank->name}} ({{$bank->nationalID}})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-5 col-md-4 col-xl-2 me-xl-auto">
                    <button class="btn btn-success bg-success border-success" type="submit">فلترة</button>
                    <button id="clearFilters" class="btn btn-danger bg-danger border-danger" type="reset">الغاء الفلترة</button>
                </div>
            </div>
        </form>
        <div class="container mt-4">
            <div class="row mb-3 gap-2">
                <div class="col-md-5 col-xl-5 col-xxl-4">
                    <strong class="row gap-1 justify-content-center justify-content-sm-start">
                        <span class="p-2 txt text-center col-7 col-xl-5">مجموع قيمة الحوالات</span>
                        <span class="value p-2 col-3 col-xl-3 text-center" id="totalAmount">{{$totalMount}}</span>
                    </strong>
                </div>
                <div class="col-md-5 col-xl-4 ">
                    <strong class="row gap-1 justify-content-center justify-content-sm-start">
                        <span class="p-2 txt text-center col-7 col-xl-5">مجموع عدد الحوالات</span>
                        <span class="value p-2 col-3 col-lg-1 text-center" id="transferCount">{{$countTransfer}}</span>
                    </strong>
                </div>
                <div class="d-flex justify-content-sm-start justify-content-md-end justify-content-center mt-2 mt-md-0">
                        <a type="button"  class="btn" href="{{route('client.transfers')}}">حوالاتي</a>
                        <button class="btn mx-2" id="printTable">
                            <i class="fa-solid fa-print"></i>
                        </button>
                        <!-- <a href="{{ route('transfers.export') }}"> <button class="btn border"  style="margin-right: 10px;">
                        <i class="fa-solid fa-download"></i>
                    </button></a> -->
                </div>
            </div>
        </div>
       <div class="table-responsive">
           <table class="table" id="dataTable">
               <thead>
               <tr>
                   <th>رقم العملية</th>
                   <th>نوع العملية</th>
                   <th>المبلغ</th>
                   <th>تاريخ التحويل</th>
                   <th>اسم المحول</th>
                   <th>البنك</th>
                   <th>رقم حساب العميل</th>
                   <th>مصدر الحوالة</th>
               </tr>
               </thead>
               <tbody>
               @foreach($transfers as $transfer)
                   <tr data-id="{{$transfer->id}}">
                       <td>{{ $loop->iteration }}</td>
                       <td>{{$transfer->type->name}}</td>
                       <td>{{$transfer->mount}}</td>
                       <td>{{$transfer->dateTransfer}}</td>
                       <td>{{$transfer->sender->name}}</td>
                       <td>{{$transfer->bank->name}}</td>
                       <td>{{$transfer->numberAccount}}</td>
                       <td>{{$transfer->receiver->name}}</td>
                   </tr>
               @endforeach
               </tbody>
           </table>
       </div>
    </div>


    <style>
        /* إضافة الأنماط المطلوبة بالـ CSS */
        @media (min-width: 1200px) { /* XL screen breakpoint */
            .date {
                flex: 0 0 12.5%; /* Equivalent to 1.5 columns in a 12-column grid */
                max-width: 12.5%;
            }
        }
        th{
            border-radius: 4px;
            border: 1px solid limegreen;
            text-align: center;
            vertical-align: middle;
        }
        td{
            border-radius: 4px;
            border: 1px solid #e1e1e1;
            text-align: center;
            vertical-align: middle;

        }
        table {
            border-collapse: separate;
            border-spacing: 10px 10px;
        }
        .txt, .btn{
            border: 2px solid #A45EE5;
            border-radius: 4px;
        }
        .value{
            border: 2px solid limegreen;
            border-radius: 4px;
        }
        .btn:hover{
            background: #A45EE5;
            color: white;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var hasAlertOpened = false;
            $('#filterForm').submit(function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("transfer.filter") }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        var transfers = response.transfers;
                        // Clear the existing table data
                        $('#dataTable tbody').empty();

                        // Append the filtered data to the table
                        $.each(transfers, function (index, transfer) {
                            var newRow = '<tr data-id="' + transfer.id + '">' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + transfer.type.name + '</td>' +
                                '<td>' + transfer.mount + '</td>' +
                                '<td>' + transfer.dateTransfer + '</td>' +
                                '<td>' + transfer.sender.name + '</td>' +
                                '<td>' + transfer.bank.name + '</td>' +
                                '<td>' + transfer.numberAccount + '</td>' +
                                '<td>' + transfer.receiver.name + '</td>' +
                                // Add other columns here
                                '</tr>';

                            $('#dataTable tbody').append(newRow);
                        });
                        $('#transferCount').text(response.countTransfer);
                        $('#totalAmount').text(response.totalMount);
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' - ' + error);
                    }
                });

            });
            $('#clearFilters').click(function () {
                window.location.href = "{{ route('client.transfers') }}";
            });
            // function fetchAllData() {
            //     $.ajax({
            //         url: '{{ route("client.transfers") }}', // Replace with the appropriate route for fetching all data
            //         type: 'GET',
            //         success: function (response) {
            //             // Clear the existing table data
            //             $('#dataTable tbody').empty();
            //             $.each(response.transfers, function (index, transfer) {
            //                 var newRow = '<tr data-id="' + transfer.id + '">' +
            //                     '<td>' + (index + 1) + '</td>' +
            //                     '<td>' + transfer.type.name + '</td>' +
            //                     '<td>' + transfer.mount + '</td>' +
            //                     '<td>' + transfer.dateTransfer + '</td>' +
            //                     '<td>' + transfer.sender.name + '</td>' +
            //                     '<td>' + transfer.bank.name + '</td>' +
            //                     '<td>' + transfer.numberAccount + '</td>' +
            //                     '<td>' + transfer.receiver.name + '</td>' +
            //                     '</tr>';
            //                 $('#dataTable tbody').append(newRow);
            //             });
            //             $('#transferCount').text(response.countTransfer);
            //             $('#totalAmount').text(response.totalMount);
            //         },
            //         error: function (xhr, status, error) {
            //             console.error('AJAX Error: ' + status + ' - ' + error);
            //         }
            //     });
            // }

            $('#update-btn').on("click",function (){
                $('#dataTable tbody tr').each(function (){
                    var recordId = $(this).data("id");
                    var currentStatus = $(this).find(".status-select").val();
                    $.ajax({
                        type: "POST",
                        url: "/updateStatus",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id : recordId,
                            status : currentStatus
                        },
                        success : function (response){
                            if (!hasAlertOpened && response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'تم الحفظ بنجاح',
                                });
                                hasAlertOpened = true;
                                setTimeout(function() {
                                    hasAlertOpened = false;
                                }, 3000); // Set the variable to true to prevent displaying the message again
                            }
                        },
                        error: function (error){
                            console.error("Error updating status: " + error);
                        },
                    })

                })
            })

            $("#addBankBtn").on("click", function() {
                $("#addBankModal").modal("show");
            });
            $("#saveBankBtn").on("click", function() {
                $.ajax({
                    type: "POST",
                    url: "/save-bank",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: $("#bankName").val(),
                        national_id: $("#nationalId").val()
                    },
                    success: function (response) {
                        if (response.errors) {
                            if (response.errors.name) {
                                $("#bankNameError").text('اسم البنك مطلوب');
                            }
                            else {
                                $("#bankNameError").text('');
                            }
                            if (response.errors.national_id) {
                                $("#nationalIdError").text('الرقم التعريفي مطلوب');
                            }
                            else {
                                $("#nationalIdError").text('');
                            }
                        } else {
                            console.log(response.message);
                            $(".error-message").text("");
                            $("#addBankModal").modal("hide");
                            $("#addBankForm")[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'تم الحفظ بنجاح',
                            });
                        }
                    },
                    error: function (error) {
                        console.error("Error saving bank: " + error);
                    }
                });
            });
            $("#closeSaveBank").on("click", function (){
                $("#addBankModal").modal("hide");
                $(".error-message").text("");
                $("#addBankForm")[0].reset();
            })

            $("#addTypeBtn").on("click", function() {
                $("#addTypeModal").modal("show");
            });
            $("#saveTypeBtn").on("click", function() {
                $.ajax({
                    type: "POST",
                    url: "/save-type",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: $("#typeName").val(),
                    },
                    success: function (response) {
                        if (response.errors) {
                            if (response.errors.name) {
                                $("#typeNameError").text('اسم العملية مطلوب ');
                            }
                            else {
                                $("#typeNameError").text('');
                            }
                        } else {
                            console.log(response.message);
                            $(".error-message").text("");
                            $("#addTypeModal").modal("hide");
                            $("#addTypeForm")[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'تم الحفظ بنجاح',
                            });
                        }
                    },
                    error: function (error) {
                        console.error("Error saving Type: " + error);
                    }
                });
            });
            $("#closeSaveType").on("click", function (){
                $("#addTypeModal").modal("hide");
                $(".error-message").text("");
                $("#addTypeForm")[0].reset();
            })


            $('#printTable').click(function() {
                printTable();
            });
            function printTable() {
                var printWindow = window.open('', '_blank');
                var tableContent = $('#dataTable').clone();
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print Table</title></head><body>');
                printWindow.document.write(tableContent.prop('outerHTML'));
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            }

            $(".open").on("click", function() {
                var icon = $(this).find("i");
                if (icon.hasClass("fa-circle-chevron-down")) {
                    icon.removeClass("fa-circle-chevron-down").addClass("fa-circle-chevron-up");
                } else {
                    icon.removeClass("fa-circle-chevron-up").addClass("fa-circle-chevron-down");
                }
                $("#filterForm").toggle();
            });
        });
    </script>
@endsection
