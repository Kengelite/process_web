$(document).ready(function () {
    $("#addDocumentForm").on("submit", function (e) {
        e.preventDefault();

        // ตั้งค่าให้ค่าเริ่มต้นของฟิลด์อาจารย์และพนักงานเป็น "-"
        let startTeacher = $("#start_teacher").val() || "-";
        let startEmployee = $("#start_employee").val() || "-";

        // สร้างข้อมูลฟอร์มพร้อมข้อมูลที่ตรวจสอบแล้ว
        let formData = new FormData(this);
        formData.set("start_teacher", startTeacher);
        formData.set("start_employee", startEmployee);

        $.ajax({
            url: "/documents/store",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "สำเร็จ",
                        text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    }).then(() => {
                        window.location = "/";
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้",
                });
            },
        });
    });
});
