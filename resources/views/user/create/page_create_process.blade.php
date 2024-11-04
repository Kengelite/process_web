<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>เพิ่มข้อมูลเอกสาร</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- เพิ่ม Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="/assets/images/icon/cpkkuicon.ico" rel="icon" type="image/x-icon">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
    </script>
    <!-- Favicons -->
    <!-- <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    .form-container {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f8f9fa;
        margin: auto;
        margin-top: 20px;
    }
    </style>
</head>

<body>
    @include('.../menu/menu_nav')
    @include('.../menu/menu')

    <main id="main" class="main fs-5">
        <div class="pagetitle">
            <h1>เพิ่มข้อมูลเอกสารใหม่</h1>
        </div>

        <section class="section">
            <div class="container form-container">
                <form id="addDocumentForm" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- หมายเลขอ้างอิง -->
                        <div class="col-md-6 mb-3">
                            <label for="id_number" class="form-label">หมายเลขอ้างอิง</label>
                            <input type="text" class="form-control" id="id_number" name="id_number" required>
                        </div>

                        <!-- ชื่อเอกสาร -->
                        <div class="col-md-6 mb-3">
                            <label for="document_name" class="form-label">ชื่อเอกสาร</label>
                            <input type="text" class="form-control" id="document_name" name="document_name" required>
                        </div>

                        <!-- เวอร์ชัน -->
                        <div class="col-md-6 mb-3">
                            <label for="version" class="form-label">เวอร์ชัน</label>
                            <input type="number" class="form-control" id="version" name="version" required>
                        </div>


                        <!-- เวลาเสร็จสิ้น -->
                        <div class="col-md-6 mb-3">
                            <label for="end_time" class="form-label">สิ้นสุดวันที่</label>
                            <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
                        </div>

                        <!-- ประเภท -->
                        <div class="col-md-6 mb-3">
                            <label for="id_type" class="form-label">ประเภท</label>
                            <div class="input-group">
                                <select class="form-control" id="id_type" name="id_type" required>
                                    <option value="">กรุณาเลือกประเภท</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->type_all_id }}">{{ $type->type_all_name }}</option>
                                    @endforeach
                                </select>
                                <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#addTeacherModal">
                                    เพิ่มใหม่
                                </button> -->
                            </div>
                        </div>
                        <!-- ปี -->
                        <div class="col-md-6 mb-3">
                            <label for="id_years" class="form-label">ปีงบประมาณ</label>
                            <div class="input-group">
                                <select class="form-control" id="id_year" name="id_years" required>
                                    <option value="">กรุณาเลือกปี</option>
                                    @foreach($years as $years)
                                    <option value="{{ $years->year_id }}">{{ $years->year_name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" id="addYear"
                                    data-target="#addTeacherModal">
                                    เพิ่มใหม่
                                </button>
                            </div>
                        </div>


                        <!-- ฝ้าย -->
                        <div class="col-md-6 mb-3">
                            <label for="id_cotton" class="form-label">ฝ่ายกำกับดูแล</label>
                            <div class="input-group">
                                <select class="form-control" id="id_cotton" name="id_cotton" required>
                                    <option value="">กรุณาเลือกฝ่าย</option>
                                    @foreach($cottons as $cotton)
                                    <option value="{{ $cotton->cotton_id }}">{{ $cotton->cotton_name }}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" id="addCotton"
                                    data-target="#addTeacherModal">
                                    เพิ่มใหม่
                                </button>
                            </div>
                        </div>



                        <!-- ปุ่มเปิดโมดอลและเลือกอาจารย์ -->
                        <div class="col-md-6 mb-3">
                            <label for="start_teacher" class="form-label">อาจารย์ผู้รับผิดชอบ</label>
                            <div class="input-group">
                                <select class="form-control" id="start_teacher" name="start_teacher">
                                    <option value="">กรุณาเลือกอาจารย์</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->teacher_id }}">
                                        {{ $teacher->academic_stort_name }}{{ $teacher->teacher_name }}
                                        {{ $teacher->teacher_lname }}</option>
                                    @endforeach
                                </select>
                                <a type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    href="{{ route('teachers-add') }}" data-target="#addTeacherModal">
                                    เพิ่มใหม่
                                </a>
                            </div>
                        </div>
                        <!-- ปุ่มเปิดโมดอลและเลือกพนักงาน-->
                        <div class="col-md-6 mb-3">
                            <label for="start_employee" class="form-label">เจ้าหน้าที่ผู้รับผิดชอบ</label>
                            <div class="input-group">
                                <select class="form-control" id="start_employee" name="start_employee">
                                    <option value="">กรุณาเลือกเจ้าหน้าที่</option>
                                    @foreach($employees as $employee)
                                    <option value="{{ $employee->emp_id }}">
                                        {{ $employee->academic_stort_name }}{{ $employee->emp_name }}
                                        {{ $employee->emp_lname }}</option>
                                    @endforeach
                                </select>
                                <a type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    href="{{ route('employees-add') }}" data-target="#addemployeeModal">
                                    เพิ่มใหม่
                                </a>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label">รายละเอียด</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="กรอกรายละเอียดเอกสาร..."></textarea>
                        </div>
                        <!-- ปุ่มเพิ่มข้อมูล -->
                        <div class="col-12 text-end">
                            <button class="btn btn-success" id="submitFormBtn">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </main>

    @include('../footer')
    @include('.../modal/modal_select_data')
    <script>
    function send_new_data_ajax(type, value_type) {
        $.ajax({
            type: "POST",
            url: "{{ route('postadd.createprocess') }}", // Correctly use Blade syntax
            data: {
                type: type,
                val_add: value_type,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                if (response.success) {
                    console.log(response);
                    let message =
                        type == "end_time" ?
                        "update ข้อมูลใหม่คือ " +
                        formatDate(response.message) +
                        " น." :
                        "เพิ่มข้อมูล " + response.message;
                    // if(type=="end_time")
                    Swal.fire({
                        title: "สำเร็จ!",
                        text: message,
                        icon: "success",
                        confirmButtonText: "ตกลง",
                    }).then((success) => {
                        console.log(success);
                        if (success.value == true) {
                            // เมื่อสำเร็จ ทำการ refresh หน้า
                            location.reload(); // รีเฟรชหน้าเว็บ
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "เกิดข้อผิดพลาด",
                                html: `ไม่สามารถเพิ่มข้อมูล <br> หรือมีข้อมูลในฐานข้อมูลแล้ว <br> กรุณาลองใหม่อีกครั้ง`,
                                confirmButtonText: "ตกลง",
                                // text: "Something went wrong!",
                                // footer: '< a href="#">Why do I have this issue?</>',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        html: `ไม่สามารถเพิ่มข้อมูล <br> หรือมีข้อมูลในฐานข้อมูลแล้ว <br> กรุณาลองใหม่อีกครั้ง`,
                        confirmButtonText: "ตกลง",
                    });
                }
            },
            error: function(xhr, status, error) {
                // Show error if something goes wrong
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถเพิ่มข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    }
    $(document).ready(() => {

        $("#addCotton").on("click", (e) => {
            $("#modal_edit_cotton").modal("hide");
            $("#modal_add_cotton").modal("show");
        });
        $("#btn_submit_add_cotton").on("click", (e) => {
            // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_cotton');
            // console.log(postgetNumberUrl);
            let cottons_val = $("#input_cotton_add").val();
            if (cottons_val != "") {
                send_new_data_ajax("add_cotton", cottons_val);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "กรุณากรอกข้อมูลให้ครบถ้วน กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            }
            // $("#input_end_time_edit").val($("#end_time").val());
        });

        $("#addYear").on("click", (e) => {
            $("#modal_edit_year").modal("hide");
            $("#modal_add_year").modal("show");
        });

        $("#btn_submit_add_year").on("click", (e) => {
            // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
            // console.log(postgetNumberUrl);
            let years_val = $("#input_year_add").val();
            if (years_val >= 2015 && years_val <= 2047) {
                send_new_data_ajax("add_year", years_val);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ปีไม่อยู่ช่วงเวลาที่กำหนด ค.ศ.2015 - ค.ศ.2047",
                    confirmButtonText: "ตกลง",
                });
            }
            // $("#input_end_time_edit").val($("#end_time").val());
        });
    })
    $(document).ready(function() {
        $('#submitFormBtn').on('click', function(e) {
            e.preventDefault();

            // ตรวจสอบค่าว่าง
            let isValid = true;
            let errorMessage = "";

            // รีเซ็ตการแจ้งเตือนและคลาส is-invalid
            $('.form-control').removeClass('is-invalid');

            // ตรวจสอบ input ที่เป็น text และ select ต่าง ๆ
            if ($('#id_number').val().trim() === "") {
                isValid = false;
                errorMessage += "กรุณากรอกหมายเลขอ้างอิง\n";
                $('#id_number').addClass('is-invalid'); // เพิ่มคลาสแจ้งเตือน
            }
            if ($('#document_name').val().trim() === "") {
                isValid = false;
                errorMessage += "กรุณากรอกชื่อเอกสาร\n";
                $('#document_name').addClass('is-invalid');
            }
            if ($('#version').val().trim() === "") {
                isValid = false;
                errorMessage += "กรุณากรอกเวอร์ชัน\n";
                $('#version').addClass('is-invalid');
            }
            if ($('#end_time').val().trim() === "") {
                isValid = false;
                errorMessage += "กรุณาระบุสิ้นสุดวันที่\n";
                $('#end_time').addClass('is-invalid');
            }
            if ($('#id_year').val().trim() === "") {
                isValid = false;
                errorMessage += "กรุณาระบุสิ้นสุดวันที่\n";
                $('#id_year').addClass('is-invalid');
            }

            if ($('#id_cotton').val() === "") {
                isValid = false;
                errorMessage += "กรุณาเลือกฝ่าย\n";
                $('#id_cotton').addClass('is-invalid');
            }
            if ($('#id_type').val() === "") {
                isValid = false;
                errorMessage += "กรุณาเลือกประเภท\n";
                $('#id_type').addClass('is-invalid');
            }

            // เช็คว่าอาจารย์หรือพนักงานอย่างน้อยหนึ่งคนถูกเลือก
            if ($('#start_teacher').val() === "" && $('#start_employee').val() === "") {
                isValid = false;
                errorMessage += "กรุณาเลือกอาจารย์หรือเจ้าหน้าที่ผู้รับผิดชอบอย่างน้อยหนึ่งคน\n";
                $('#start_teacher, #start_employee').addClass('is-invalid'); // แจ้งเตือนทั้งสองฟิลด์
            }

            // ถ้าข้อมูลไม่ครบถ้วน ให้แจ้งเตือน
            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'ข้อมูลไม่ครบถ้วน',
                    text: errorMessage
                });
                return;
            }

            let formData = new FormData(document.getElementById(
                'addDocumentForm')); // แก้ไขการเรียก FormData
            formData.forEach((value, key) => {
                console.log(key + ': ' + value);
            });
            $.ajax({
                url: "{{route('documents.store')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "สำเร็จ",
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                        })
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "เกิดข้อผิดพลาด",
                            text: "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        });
                    }
                },
                error: function(ee) {
                    console.log(ee)
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้",
                    });
                }
            });
        });
    });
    </script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>