$(document).ready(function () {
    $(".btndata").on("click", function (e) {
        e.preventDefault();
        console.log(this.id);
        $("#head").html("web ง่ายนิดเดียว");
    });
    const dataTableOptions = {
        paging: true,
        searching: true,
        ordering: true,
        info: true,
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
        initComplete: function () {
            // เพิ่มคลาส form-control ให้กับช่องค้นหา (Search Input)
            var searchInput = $(this)
                .closest(".dataTables_wrapper")
                .find('input[type="search"]');
            searchInput.addClass("search-form");

            var selectElements = $(this)
            .closest(".dataTables_wrapper")
            .find('select');
        selectElements.addClass("search-form-select");
            // ใช้ Flexbox จัดการให้แสดงผลในบรรทัดเดียว
        },
    };

    // ใช้ตัวเลือกเดียวกันกับทั้งสองตาราง
    $("#example").DataTable(dataTableOptions);
    $("#teacher").DataTable(dataTableOptions);
    $("#data_employee").DataTable(dataTableOptions);
});
