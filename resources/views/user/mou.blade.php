<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MOU Management</title>

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    <!-- Favicons -->
    <link rel="icon" href="/assets/images/icon/cpkkuicon.ico" rel="icon" type="image/x-icon">
    
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    @include('../menu/menu_nav')
    @include('../menu/menu')

    <main id="main" class="main fs-5">

        <div class="pagetitle">
            <h1> จัดการไฟล์เอกสาร MOU </h1>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">


                    <!-- Upload Form Card -->
                    <div class="card">
                        <div class="card-body mt-3">
                            <h5 class="card-title">อัปโหลดไฟล์ MOU ใหม่</h5>
                            <form id="uploadForm" action="{{ route('mou.upload') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-3">
                                @csrf
                                <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx" required>
                                <button type="submit" class="btn btn-primary">อัปโหลด</button>
                            </form>
                            <small class="text-muted mt-2 d-block">รองรับไฟล์: .pdf, .doc, .docx (สูงสุด 40MB)</small>
                        </div>
                    </div>

                    <!-- Files Table -->
                    <div class="card recent-sales overflow-auto">
                        <div class="card-body">
                            <h5 class="card-title">รายการไฟล์ MOU ของคุณ</h5>
                            <table id="mouTable" class="display pt-2 table table-borderless datatable fs-6" style="width:100%">
                                <thead class="pt-3">
                                    <tr class="table-secondary">
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">ชื่อไฟล์</th>
                                        <th scope="col">ประเภท</th>
                                        <th scope="col">ขนาด</th>
                                        <th scope="col">อัปโหลดเมื่อ</th>
                                        @if(isset($currentUser) && $currentUser->role === 'super_admin')
                                            <th scope="col">ผู้อัปโหลด</th>
                                        @endif
                                        <th scope="col">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ basename($file->file_path) }}</td>
                                        <td>
                                            @if($file->file_type === 'pdf')
                                                <span class="badge bg-danger">PDF</span>
                                            @else
                                                <span class="badge bg-primary">DOC/DOCX</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($file->file_size / 1024, 2) }} KB</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($file->created_at)) }}</td>
                                        
                                        @if(isset($currentUser) && $currentUser->role === 'super_admin')
                                            <td>
                                                {{ $file->uploader_name }} 
                                                <span class="badge bg-secondary ms-1">{{ strtoupper($file->uploader_role) }}</span>
                                                <br><small class="text-muted">{{ $file->uploader_email }}</small>
                                            </td>
                                        @endif

                                        <td>
                                            @if($file->file_type === 'pdf')
                                                <button class="btn btn-sm btn-info text-white" onclick="previewPDF('{{ route('mou.preview', $file->file_id) }}')">
                                                    <i class="bi bi-eye"></i> ดู
                                                </button>
                                            @endif
                                            
                                            <a href="{{ route('mou.download', $file->file_id) }}" class="btn btn-sm btn-success">
                                                <i class="bi bi-download"></i> โหลด
                                            </a>

                                            <form action="{{ route('mou.delete', $file->file_id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(this);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i> ลบ
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <!-- PDF Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="previewModalLabel">ดูตัวอย่างไฟล์ PDF</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <iframe id="pdfIframe" src="" style="width: 100%; height: 75vh; border: none;"></iframe>
          </div>
        </div>
      </div>
    </div>

    @include('../footer')

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#mouTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Thai.json"
                }
            });

            // Handle Standard Validation Errors with SweetAlert
            @if($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'ข้อมูลไม่ถูกต้อง',
                    html: '<ul class="text-start">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    confirmButtonText: 'ตกลog'
                });
            @endif

            // Handle SweetAlert Errors from Backend (including PostTooLargeException)
            @if(session('swal_error'))
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: '{{ session('swal_error') }}',
                    confirmButtonText: 'ตกลง'
                });
            @endif

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Client-side Validation for File Size (Targeting only upload form)
            $('#uploadForm').on('submit', function(e) {
                const fileInput = $(this).find('input[type="file"]')[0];
                if (fileInput && fileInput.files.length > 0) {
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
                    if (fileSize > 40) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไฟล์ใหญ่เกินไป',
                            text: 'ขนาดไฟล์สูงสุดที่อนุญาตคือ 40MB (ไฟล์ปัจจุบัน: ' + fileSize.toFixed(2) + 'MB)',
                            confirmButtonText: 'รับทราบ'
                        });
                    } else {
                        // Show Loading
                        Swal.fire({
                            title: 'กำลังอัปโหลดและบีบอัดไฟล์...',
                            text: 'กรุณารอสักครู่ ระบบกำลังประมวลผล',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    }
                }
            });
        });

        function previewPDF(url) {
            document.getElementById('pdfIframe').src = url;
            var myModal = new bootstrap.Modal(document.getElementById('previewModal'));
            myModal.show();
        }

        function confirmDelete(form) {
            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: "ข้อมูลไฟล์นี้จะถูกลบออกจากระบบ!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ใช่, ลบทันที!',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false;
        }
    </script>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/tinymce/tinymce.min.js"></script>

</body>
</html>
