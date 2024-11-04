<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CP - Assets</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
    </script>
    <!-- Favicons -->
    <link rel="icon" href="/assets/images/icon/cpkkuicon.ico" rel="icon" type="image/x-icon">
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

    <!-- <link href="/assets/css/style.css" rel="stylesheet"> -->

    <style>
    .center-search {
        display: flex;
        justify-content: center;
        /* จัดให้อยู่ตรงกลาง */
        margin-bottom: 20px;
        /* เพิ่มระยะห่างด้านล่าง */
    }

    .image-preview {
        width: 200px;
        height: 200px;
        border: 2px dashed #ccc;
        /* เส้นกรอบสีเทา */
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin: 20px auto;
        /* จัดให้อยู่ตรงกลาง */
        background-color: #f8f8f8;
        border-radius: 10px;
        /* มุมโค้งเล็กน้อย */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        /* เพิ่มเงาเล็กน้อย */
    }
    </style>
    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


    @include('../menu/menu_nav')
    @include('../menu/menu')


    <main id="main" class="main fs-5">

        <div class="pagetitle">
            <h1> พนักงาน ( Employee ) </h1>
            <nav>
                <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol> -->
                <!-- <span> ทรัพย์สินองค์กร ( CP Assets ) </span> -->
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <form method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <div class="image-preview" id="image-preview">
                            <!-- ตั้งค่า src เริ่มต้นเพื่อแสดงรูปปัจจุบัน -->
                            <img id="preview-image" src="{{ asset($employee->picture_url) }}" alt="ตัวอย่างรูปภาพ"
                                style="max-width: 100%; max-height: 100%;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="picture" class="form-label">รูปภาพ</label>
                                <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_position" class="form-label">ตำแหน่ง</label>
                                <select class="form-control" id="id_position" name="id_position" required>
                                    <option value="">กรุณาเลือกตำแหน่ง</option>
                                    @foreach($positions as $position)
                                    <option value="{{ $position->position_id }}"
                                        {{ $employee->id_position == $position->position_id ? 'selected' : '' }}>
                                        {{ $position->positon_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- คำนำหน้า (Academic Title) -->
                       <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_aca" class="form-label">คำนำหน้า</label>
                                <select class="form-control" id="id_aca" name="id_aca" required>
                                    <option value="">กรุณาเลือกคำนำหน้า</option>
                                    @foreach($academics as $academic)
                                    <option value="{{ $academic->academic_id }}"
                                        {{ $employee->id_aca == $academic->academic_id ? 'selected' : '' }}>
                                        {{ $academic->academic_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 

                        <!-- ชื่อ -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="emp_name" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control" id="emp_name" name="emp_name" required
                                    value="{{ $employee->emp_name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- นามสกุล -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="emp_lname" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" id="emp_lname" name="emp_lname" required
                                    value="{{ $employee->emp_lname }}">
                            </div>
                        </div>

                        <!-- เพศ -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_sex" class="form-label">เพศ</label>
                                <select class="form-control" id="id_sex" name="id_sex" required>
                                    <option value="">กรุณาเลือกเพศ</option>
                                    @foreach($sexes as $sex)
                                    <option value="{{ $sex->sex_id }}"
                                        {{ $employee->id_sex == $sex->sex_id ? 'selected' : '' }}>
                                        {{ $sex->sex_name }}
                                    </option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-end">
                        <button id="updateEmployeeBtn" type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                    </div>
                </form>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('../footer')

    <script>
    $(document).ready(function() {
        $('.btn_id_show').click(function(event) {
            var encodedId = $(this).data('id');
            localStorage.setItem('encodedId', encodedId);
        });
        // $('.btn_id_show').click(function(event) {
        //     // event.preventDefault(); 

        //     var documentId = $(this).data('id'); // ดึง id จาก data-id
        //     console.log(documentId)

        //     $.ajax({
        //         type: 'post',
        //         url: "{{route('pageselectdata')}}", // URL ที่ต้องการส่งข้อมูลไป
        //         data: {
        //             id: documentId
        //         },
        //         // dataType: "json",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response) {
        //             // Redirect handled by the server
        //             window.location.href = response.redirect_url;
        //         },
        //         error: function(xhr, status, error) {
        //             console.log(error);
        //             alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง");
        //         },
        //     });
        // });

    });
    </script>
     <script>
    const updateEmployeeUrl = "{{ route('employee-update', $employee->emp_id) }}";
    </script>
    <script type="text/javascript" src="{{ asset('assets/js/employee/edit-employee.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datatable.js') }}"></script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor JS Files -->
    <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/assets/vendor/quill/quill.js"></script>
    <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <!-- <script src="assets/js/main.js"></script> -->

</body>

</html>