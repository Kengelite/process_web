$(document).ready(function () {
    $(".btndata").on("click", function (e) {
        e.preventDefault();
        console.log(this.id);
        $("#head").html("web ง่ายนิดเดียว");
    });

    $("#project").DataTable({
        paging: true, // เปิดการแบ่งหน้า
        searching: true, // เปิดการค้นหา
        ordering: true, // เปิดการจัดเรียง
        info: true, // แสดงข้อมูลเพิ่มเติม เช่น จำนวนรายการ
        language: {
            lengthMenu: "แสดง _MENU_ รายการต่อหน้า",
            zeroRecords: "ไม่พบข้อมูล",
            info: "แสดงหน้า _PAGE_ จาก _PAGES_",
            infoEmpty: "ไม่มีข้อมูล",
            infoFiltered: "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
            paginate: {
                first: "หน้าแรก",
                last: "หน้าสุดท้าย",
                next: "ถัดไป",
                previous: "ก่อนหน้า",
            },
            search: "ค้นหา : ",
        },
        fnDrawCallback: function () {
            $(".paginate_button").addClass("btn btn-light"); // เพิ่มคลาส btn
            $(".paginate_button.current")
                .removeClass("btn-light")
                .addClass("btn-primary"); // ปุ่มปัจจุบันเป็น btn-primary
        },
        initComplete: function () {
            // เพิ่มคลาส form-control ให้กับ search input
            $("div.dataTables_filter input")
                .addClass("form-control")
                .css("display", "inline-block");

            // จัดให้ข้อความ "ค้นหา" และ input อยู่ในบรรทัดเดียวกัน
            $("div.dataTables_filter").css({
                display: "inline-flex",
                "align-items": "center",
                gap: "0.5rem", // เพิ่มช่องว่างระหว่าง label กับ input
            });
        },
    });
});
