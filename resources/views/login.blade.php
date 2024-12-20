<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CP - Assets</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link href="/assets/images/icon/cpkkuicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="/assets/images/icon/cpkkuicon.ico" alt="">
                                    <span class="d-none d-lg-block ms-3">CP - Assets</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">เข้าสู่ระบบ</h5>
                                        <!-- <p class="text-center small">Enter your username & password to login</p> -->
                                    </div>

                                    <form id="loginForm" class="row g-3 needs-validation" novalidate>
                                     
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <!-- <span class="input-group-text" id="inputGroupPrepend">@</span> -->
                                                <input type="text" name="username" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">กรุณากรอกข้อมูลให้ครบถ้วน!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">กรุณากรอกรหัสผ่านให้ครบถ้วน!</div>
                                        </div>

                                        <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">จดจำฉัน</label>
                      </div>
                    </div> -->
                                        <div class="col-12 mt-5">
                                            <button class="btn btn-primary w-100" type="submit">เข้าสู่ระบบ</button>
                                        </div>
                                        <!-- <div class="col-12">
                                            <p class="small mb-0">หากไม่มีข้อมูล ? <a
                                                    href="pages-register.html">สมัครสมาชิก</a></p>
                                        </div> -->
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                <!-- Designed by <a href="https://bootstrapmade.com/"> Keng </a> -->
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault(); // ป้องกันการ submit แบบปกติ

            $.ajax({
                url: `{{route('login-check')}}`, // URL ที่จะยิงไปหา
                type: 'POST',
                data: $(this).serialize(), // ส่งข้อมูลในฟอร์ม
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: "เข้าสู่ระบบสำเร็จ"
                        }).then(() => {
                            window.location.href = "/";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'ผิดพลาด',
                            text: "กรุณาลองใหม่อีกครั้ง"
                        });
                    }
                },
                error: function(xhr, status, error) {
                  console.log(xhr.responseText )
                   
                }
            });
        });
    });
    </script>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>