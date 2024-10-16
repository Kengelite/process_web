<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CP - Assets</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
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

    <!-- <link href="/assets/css/style.css" rel="stylesheet"> -->

    <style>
    .center-search {
        display: flex;
        justify-content: center;
        /* จัดให้อยู่ตรงกลาง */
        margin-bottom: 20px;
        /* เพิ่มระยะห่างด้านล่าง */
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
            <h1> ข้อมูล ( CP Assets ) </h1>
            <nav>
                <!-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol> -->
                <!-- <span> เลขอ้างอิง : 1121211 </span> -->
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-12 ">
                            <div class="card recent-sales overflow-auto pt-2 ps-2">

                                <!-- <div class="filter" style="margin-right: 3%;">

                                    <button class="btn btn-success ml-auto">เพิ่มข้อมูล</button>
                                </div> -->

                                <div class="card-body ">
                                    <h5 id="head" class="card-title d-flex justify-content-between align-items-center">
                                        <div class="row">
                                            <!-- หมายเลขอ้างอิง -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="id_number_page" class="form-label">หมายเลขอ้างอิง</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="id_number_page"
                                                        value="{{ $documents->id_number }}"
                                                        aria-describedby="basic-addon1">
                                                    <button class="input-group-text color-success"
                                                        id="btn_edit_id_number"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- ชื่อเอกสาร -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="document_name" class="form-label">ชื่อเอกสาร</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="document_name"
                                                        value="{{ $documents->document_name }}">
                                                    <button class="input-group-text color-success" id="btn_edit_name"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- เวอร์ชัน -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="version" class="form-label">เวอร์ชัน</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="version"
                                                        value="{{ $documents->version }}">
                                                    <button class="input-group-text color-success" id="btn_edit_version"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- เวลาเสร็จสิ้น -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="end_time" class="form-label">สิ้นสุดวันที่</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="datetime-local"
                                                        id="end_time"
                                                        value="{{ \Carbon\Carbon::parse($documents->end_time)->format('Y-m-d\TH:i') }}">
                                                    <button class="input-group-text color-success" id="btn_edit_end_time"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- ปี -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="year_name" class="form-label">ปี (ค.ศ.)</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="year_name"
                                                        value="{{ $documents->year_name }}">
                                                    <button class="input-group-text color-success" id="btn_edit_year"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- ฝ้าย -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="cotton_name" class="form-label">ฝ่ายกำกับดูแล</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="cotton_name"
                                                        value="{{ $documents->cotton_name }}">
                                                    <button class="input-group-text color-success" id="btn_edit_cotton"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- ประเภท -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="type_all_name" class="form-label">ประเภท</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="type_all_name"
                                                        value="{{ $documents->type_all_name }}">
                                                    <button class="input-group-text color-success" id="btn_edit_type"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- ชื่อครู -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="teacher_name"
                                                    class="form-label">อาจารย์ที่รับผิดชอบ</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="teacher_name"
                                                        value="{{ $documents->teacher_name != '' ? $documents->academic_stort_name . $documents->teacher_name. ' ' . $documents->teacher_lname : '-' }}">
                                                    <button class="input-group-text color-success" id="btn_edit_teachers"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                </div>
                                            </div>

                                            <!-- ชื่อพนักงาน -->
                                            <div class="mb-3 col-xl-6 mt-3">
                                                <label for="emp_name"
                                                    class="form-label">เจ้าหน้าที่ผู้รับผิดชอบ</label>
                                                <div class="input-group">
                                                    <input class="form-control" readonly type="text" id="emp_name"
                                                        value="{{ $documents->emp_name != '' ?  $documents->emp_name . ' '. $documents->emp_lname : '-' }}">
                                                    <button class="input-group-text" id="btn_edit_employee"
                                                        style="background-color: #b3e5fc; color: black;">
                                                        <i class='bx bxs-edit'></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>


                                    </h5>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->
                    </div>
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter" style="margin-right: 3%;">

                                    <button class="btn btn-success ml-auto">เพิ่มข้อมูล</button>
                                </div>

                                <div class="card-body">
                                    <h5 id="head" class="card-title d-flex justify-content-between align-items-center">
                                        ไฟล์เอกสารทั้งหมด
                                        <!-- <button class="btn btn-success ml-auto"
                                            style="margin-right: 8%;">เพิ่มข้อมูล</button> -->
                                    </h5>

                                    <table id="example" class="display pt-2 table table-borderless  datatable fs-6"
                                        style="width:100%">
                                        <thead class="pt-3">
                                            <tr class="table-secondary">
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">รูป</th>
                                                <th scope="col">ชื่อไฟล์</th>
                                                <th scope="col">วันที่อัพโหลด</th>
                                                <th scope="col">วันที่แก้ไขล่าสุด</th>
                                                <!-- <th scope="col">สถานะ</th>
                                                <th scope="col">อาจารย์</th>
                                                <th scope="col">หน่วยงาน</th>
                                                <th scope="col">ระยะเวลา</th> -->
                                                <!-- <th scope="col">ปี</th> -->
                                                <th scope="col"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- เพิ่มข้อมูลในตารางตามที่ต้องการ -->
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->
                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
    <!-- <script>
    var editIdUrl = "{{ route('postedit_id_number', ['id' => ':id']) }}";
    </script> -->
    <!-- ======= Footer ======= -->
    @include('../footer')
  
    <script>
    let encodedId = localStorage.getItem('encodedId');
    let postEditIdNumberUrl ;
    // ตรวจสอบว่า encodedId มีค่าอยู่หรือไม่
    if (!encodedId) {
        console.error("encodedId is undefined or null. Please check if it has been set in localStorage.");
    } else {
         postEditIdNumberUrl = "{{ route('postedit_id_number', ['id' => ':id']) }}";
        postEditIdNumberUrl = postEditIdNumberUrl.replace(':id', encodedId);
        console.log(postEditIdNumberUrl); // ตรวจสอบ URL ที่ได้
    }
    </script>
      @include('../modal/modal_select_data')
    <script type="text/javascript" src="{{ asset('assets/js/editmodal.js') }}"></script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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