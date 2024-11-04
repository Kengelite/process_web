$(document).ready(function () {
    // ฟังก์ชันสำหรับแสดงภาพตัวอย่างเมื่อเลือกไฟล์
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

    // เช็คก่อนส่งข้อมูล
    $(".btn-senddata").on("click", function (e) {
        e.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

        // ตรวจสอบค่าว่าง
        let isValid = true;
        let errorMessage = "";

        // ตรวจสอบ input ที่เป็น text
        $('input[type="text"]').each(function () {
            if ($(this).val().trim() === "") {
                isValid = false;
                $(this).addClass("is-invalid"); // เพิ่มคลาสเพื่อแสดงความผิดพลาด
            } else {
                $(this).removeClass("is-invalid"); // ลบคลาสหากกรอกข้อมูลแล้ว
            }
        });

        // ตรวจสอบ select
        if ($("#id_position").val() === "" || $("#id_position").val() === null) {
            isValid = false;
            $("#id_position").addClass("is-invalid");
            Swal.fire({
                icon: "warning",
                title: "ข้อมูลไม่ครบถ้วน",
                text: "กรุณาเลือกตำแหน่ง",
            });
            return;
        } else {
            $("#id_position").removeClass("is-invalid");
        }

        if ($("#id_aca").val() === "" || $("#id_aca").val() === null) {
            isValid = false;
            $("#id_aca").addClass("is-invalid");
            Swal.fire({
                icon: "warning",
                title: "ข้อมูลไม่ครบถ้วน",
                text: "กรุณาเลือกคำนำหน้า",
            });
            return;
        } else {
            $("#id_aca").removeClass("is-invalid");
        }

        if ($("#id_sex").val() === "" || $("#id_sex").val() === null) {
            isValid = false;
            $("#id_sex").addClass("is-invalid");
            Swal.fire({
                icon: "warning",
                title: "ข้อมูลไม่ครบถ้วน",
                text: "กรุณาเลือกเพศ",
            });
            return;
        } else {
            $("#id_sex").removeClass("is-invalid");
        }

        // ตรวจสอบการเลือกไฟล์
        if ($("#picture")[0].files.length === 0) {
            isValid = false;
            $("#picture").addClass("is-invalid");
        } else {
            $("#picture").removeClass("is-invalid");
        }

        // ตรวจสอบอีกครั้งหาก isValid เป็น false
        if (!isValid) {
            Swal.fire({
                icon: "warning",
                title: "ข้อมูลไม่ครบถ้วน",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนในทุกช่องที่จำเป็น",
            });
            return;
        }

        // ถ้าทุกช่องมีข้อมูล ให้ส่ง AJAX
        let formData = new FormData();
        formData.append("emp_name", $("#emp_name").val());
        formData.append("emp_lname", $("#emp_lname").val());
        formData.append("id_position", $("#id_position").val());
        formData.append("id_sex", $("#id_sex").val());
        formData.append("id_aca", $("#id_aca").val());
        formData.append("picture", $("#picture")[0].files[0]);
        console.log(formData)
        $.ajax({
            url: "/pagedataforemployee/employees/store", // URL สำหรับ insert ข้อมูล
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(response)
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "สำเร็จ",
                        text: "บันทึกข้อมูลเรียบร้อยแล้ว",
                    }).then(() => {
                        window.location = "/"; // เปลี่ยนหน้าไปยัง URL ที่ต้องการ
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

    // ลบคลาส is-invalid เมื่อมีการกรอกข้อมูลใหม่
    $("input, select").on("input change", function () {
        $(this).removeClass("is-invalid");
    });
});