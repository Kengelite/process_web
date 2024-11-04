$(document).ready(function () {
    $("#picture").on("change", function (e) {
        var reader = new FileReader();
        var file = e.target.files[0];

        // ตรวจสอบว่าไฟล์เป็นภาพหรือไม่
        if (file && file.type.match("image.*")) {
            reader.onload = function (event) {
                var imgElement = document.getElementById("preview-image");
                imgElement.src = event.target.result;
                imgElement.style.display = "block"; // แสดงภาพตัวอย่าง
            };
            reader.readAsDataURL(file);
        } else {
            alert("กรุณาเลือกไฟล์รูปภาพที่ถูกต้อง");
        }
    });

    $("#updateTeacherBtn").on("click", function (e) {
        e.preventDefault();

        let isValid = true;

        if ($("#teacher_name").val().trim() === "") {
            isValid = false;
            $("#teacher_name").addClass("is-invalid");
            Swal.fire({
                icon: "warning",
                title: "ข้อมูลไม่ครบถ้วน",
                text: "กรุณากรอกชื่อ",
            });
            return;
        } else {
            $("#teacher_name").removeClass("is-invalid");
        }

        // ตรวจสอบฟิลด์อื่นๆ ตามตัวอย่างเดิม

        if (isValid) {
            let formData = new FormData();
            formData.append("teacher_name", $("#teacher_name").val());
            formData.append("teacher_lname", $("#teacher_lname").val());
            formData.append("id_position", $("#id_position").val());
            formData.append("id_sex", $("#id_sex").val());
            formData.append("id_aca", $("#id_aca").val());
            if ($("#picture")[0].files.length > 0) {
                formData.append("picture", $("#picture")[0].files[0]);
            }

            $.ajax({
                url: updateTeacherUrl, // ใช้ URL ที่เราตั้งค่าใน JavaScript
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "สำเร็จ",
                            text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "เกิดข้อผิดพลาด",
                            text: "ไม่สามารถบันทึกข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        });
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้",
                    });
                },
            });
        }
    });

    // ลบคลาส is-invalid เมื่อผู้ใช้เริ่มกรอกข้อมูลใหม่
    $("input, select").on("input change", function () {
        $(this).removeClass("is-invalid");
    });
});
