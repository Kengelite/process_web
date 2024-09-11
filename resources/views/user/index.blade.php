<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
    <link href="/assets/img/favicon.png" rel="icon">
    <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
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
            <h1> ทรัพย์สินองค์กร ( CP Assets ) </h1>
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

                <!-- Sales Card -->
                <div class="col-xxl-3 col-md-6 col-sm-12">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">จำนวน
                                <!-- <span>| World</span> -->
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-globe2"></i>
                                    <!-- <i class="bi bi-trophy" style="color:tomato;"></i> -->
                                </div>
                                <div class="ps-3">
                                    <h6>753</h6>
                                    <span class="text-success small pt-1 fw-bold"> <i
                                            class="bi bi-arrow-up-circle-fill"></i>
                                        1</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">กระบวนการ
                                <!-- <span>| Asian</span> -->
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-globe-central-south-asia"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>304</h6>
                                    <span class="text-success small pt-1 fw-bold"> <i
                                            class="bi bi-arrow-up-circle-fill"></i>
                                        2</span> <span class="text-muted small pt-2 ps-1">increase</span>

                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-3 col-xl-12">
                    <!--  ถ้าหากอยากเพิ่มสี card = customers-card -->
                    <div class="card info-card  sales-card">


                        <div class="card-body">
                            <h5 class="card-title"> โปรเจค
                                <!-- <span>| Thailand</span> -->
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-trophy"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>4</h6>
                                    <span class="text-danger small pt-1 fw-bold"> <i
                                            class="bi bi-arrow-down-circle-fill"></i>
                                        1</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- End Customers Card -->

                <!-- Customers Card -->
                <div class="col-xxl-3 col-xl-12">
                    <!--  ถ้าหากอยากเพิ่มสี card = customers-card -->
                    <div class="card info-card  sales-card">


                        <div class="card-body">
                            <h5 class="card-title"> ผลิตภัณฑ์
                                <!-- <span>| Thailand</span> -->
                            </h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-trophy"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>4</h6>
                                    <span class="text-danger small pt-1 fw-bold"> <i
                                            class="bi bi-arrow-down-circle-fill"></i>
                                        1</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                                </div>
                            </div>
                        </div>

                    </div>

                </div><!-- End Customers Card -->

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="filter" style="margin-right: 3%;">

                                    <button class="btn btn-success ml-auto">เพิ่มข้อมูล</button>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between align-items-center">
                                        รายการทรัพย์สินทั้งหมด
                                        <!-- <button class="btn btn-success ml-auto"
                                            style="margin-right: 8%;">เพิ่มข้อมูล</button> -->
                                    </h5>

                                    <table id="example" class="display table table-borderless datatable fs-6"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">ลำดับ</th>
                                                <th scope="col">เลขอ้างอิง</th>
                                                <th scope="col">ชื่องาน</th>
                                                <th scope="col">เจ้าหน้าที่</th>
                                                <th scope="col">อาจารย์</th>
                                                <th scope="col">หน่วยงาน</th>
                                                <th scope="col"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 50; $i++) <tr>
                                                <th scope="row">

                                                    {{$i}}
                                                </th>
                                                <td>
                                                    <div> Brandon Jacob </div>
                                                </td>
                                                <td>At praesentium minu

                                                </td>
                                                <td>$64</td>
                                                <td>$64</td>
                                                <td>$64</td>
                                                <!-- <td><span class="badge bg-success">Approved</span></td> -->
                                                <td> <a class="btn btn-primary " href="{{route('pageprocess')}}"> ข้อมูล
                                                    </a></td>
                                                </tr>

                                                @endfor
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
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            "paging": true, // เปิดการแบ่งหน้า
            "searching": true, // เปิดการค้นหา
            "ordering": true, // เปิดการจัดเรียง
            "info": true // แสดงข้อมูลเพิ่มเติม เช่น จำนวนรายการ
                ,
            "language": {
                "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                "zeroRecords": "ไม่พบข้อมูล",
                "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                },
                "search": "ค้นหา : "
            }
        });
    });
    </script>
    <!-- ======= Footer ======= -->
    @include('../footer')

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