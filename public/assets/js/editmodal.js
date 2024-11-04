const formatDate = (datetime) => {
    const [date, time] = datetime.split("T");
    const [year, month, day] = date.split("-");
    return `${day}/${month}/${year} เวลา ${time}`;
};

function send_data_ajax(type, value_type) {
    $.ajax({
        type: "POST",
        url: postEditIdNumberUrl, // Correctly use Blade syntax
        data: {
            edit_col: type,
            data_value: value_type,
        },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                console.log(response);
                let message =
                    type == "end_time"
                        ? "update ข้อมูลใหม่คือ " +
                          formatDate(response.message) +
                          " น."
                        : "update ข้อมูลใหม่คือ " + response.message;
                // if(type=="end_time")
                Swal.fire({
                    title: "สำเร็จ!",
                    text: message,
                    icon: "success",
                    confirmButtonText: "ตกลง",
                }).then((success) => {
                    console.log(success);
                    if (success.value == true) {
                        // เมื่อสำเร็จ ทำการ refresh หน้า
                        location.reload(); // รีเฟรชหน้าเว็บ
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "เกิดข้อผิดพลาด",
                            text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                            confirmButtonText: "ตกลง",
                            // text: "Something went wrong!",
                            // footer: '< a href="#">Why do I have this issue?</>',
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            }
        },
        error: function (xhr, status, error) {
            // Show error if something goes wrong
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                confirmButtonText: "ตกลง",
            });
        },
    });
}

function send_new_data_ajax(type, value_type) {
    $.ajax({
        type: "POST",
        url: postEditIdNumberUrl + "/addnew_data", // Correctly use Blade syntax
        data: {
            type: type,
            val_add: value_type,
        },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                console.log(response);
                let message =
                    type == "end_time"
                        ? "update ข้อมูลใหม่คือ " +
                          formatDate(response.message) +
                          " น."
                        : "เพิ่มข้อมูล " + response.message;
                // if(type=="end_time")
                Swal.fire({
                    title: "สำเร็จ!",
                    text: message,
                    icon: "success",
                    confirmButtonText: "ตกลง",
                }).then((success) => {
                    console.log(success);
                    if (success.value == true) {
                        // เมื่อสำเร็จ ทำการ refresh หน้า
                        location.reload(); // รีเฟรชหน้าเว็บ
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "เกิดข้อผิดพลาด",
                            html: `ไม่สามารถเพิ่มข้อมูล <br> หรือมีข้อมูลในฐานข้อมูลแล้ว <br> กรุณาลองใหม่อีกครั้ง`,
                            confirmButtonText: "ตกลง",
                            // text: "Something went wrong!",
                            // footer: '< a href="#">Why do I have this issue?</>',
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    html: `ไม่สามารถเพิ่มข้อมูล <br> หรือมีข้อมูลในฐานข้อมูลแล้ว <br> กรุณาลองใหม่อีกครั้ง`,
                    confirmButtonText: "ตกลง",
                });
            }
        },
        error: function (xhr, status, error) {
            // Show error if something goes wrong
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ไม่สามารถเพิ่มข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                confirmButtonText: "ตกลง",
            });
        },
    });
}

$(document).ready(function () {
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
                .find("select");
            selectElements.addClass("search-form-select");
            // ใช้ Flexbox จัดการให้แสดงผลในบรรทัดเดียว
        },
    };

    // ใช้ตัวเลือกเดียวกันกับทั้งสองตาราง
    $("#example").DataTable(dataTableOptions);
    let edit_col;
    $("#btn_edit_id_number").on("click", (e) => {
        $("#modal_edit_id_number").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#id_number_edit").val($("#id_number_page").val());
    });
    $("#btn_id_number_edit").on("click", (e) => {
        e.preventDefault();
        console.log(postEditIdNumberUrl);
        let id_val_old = $("#id_number_page").val();
        let id_val_new = $("#id_number_edit").val();
        if (id_val_new == id_val_old || id_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้หมายเลขอ้างอิง`,
                text: `เดิม ${id_val_old} เป็น ${id_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("id_number", id_val_new);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });
    $("#btn_edit_name").on("click", (e) => {
        $("#modal_edit_name").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#input_name_edit").val($("#document_name").val());
    });
    $("#btn_submit_edit_name").on("click", (e) => {
        e.preventDefault();
        let name_val_new = $("#input_name_edit").val();
        let name_val_old = $("#document_name").val();

        if (name_val_new == name_val_old || name_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลชื่อ`,
                text: `เดิม ${name_val_old} เป็น ${name_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("name", name_val_new);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });
    $("#btn_edit_version").on("click", (e) => {
        $("#modal_edit_version").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#input_version_edit").val($("#version").val());
    });
    $("#btn_submit_edit_version").on("click", (e) => {
        e.preventDefault();
        let version_val_new = $("#input_version_edit").val();
        let version_val_old = $("#version").val();

        if (version_val_new == version_val_old || version_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลเวอร์ชั่น`,
                text: `เดิม ${version_val_old} เป็น ${version_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("version", version_val_new);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    $("#btn_edit_end_time").on("click", (e) => {
        $("#modal_edit_end_time").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#input_end_time_edit").val($("#end_time").val());
    });
    $("#btn_submit_edit_end_time").on("click", (e) => {
        e.preventDefault();
        let end_time_val_new = $("#input_end_time_edit").val();
        let end_time_val_old = $("#end_time").val();
        // สมมติว่า end_time_val_old และ end_time_val_new มีรูปแบบ "YYYY-MM-DDTHH:mm"

        if (end_time_val_new == end_time_val_old || end_time_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้เวลาสิ้นสุดการทำงาน`,
                html: `เดิม ${formatDate(
                    end_time_val_old
                )} น. <br> เป็น ${formatDate(end_time_val_new)} น.`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("end_time", end_time_val_new);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    $("#btn_edit_year").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
        // console.log(postgetNumberUrl);

        $.ajax({
            type: "POST",
            url: postEditIdNumberUrl + "/getdata_year", // Correctly use Blade syntax
            data: {},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(year_name);
                if (response.success) {
                    const years = response.data; // ข้อมูลปีจาก server
                    const yearSelect = $("#yearSelect"); // เลือก select element
                    yearSelect.empty(); // เคลียร์ค่าเดิม

                    // เพิ่ม option ลงใน select element
                    years.forEach(function (year) {
                        // สร้าง option ใหม่และตรวจสอบว่า year_id ตรงกับ 2 หรือไม่
                        var option = new Option(year.year_name, year.year_id);
                        if (year.year_name === $("#year_name").val()) {
                            option.selected = true; // กำหนด selected ให้กับ option
                        }
                        $("#yearSelect").append(option); // เพิ่ม option ลงใน select
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        confirmButtonText: "ตกลง",
                    });
                }
                $("#modal_edit_year").modal("show");
            },
            error: function (xhr, status, error) {
                // Show error if something goes wrong
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            },
        });
        // $("#input_end_time_edit").val($("#end_time").val());
    });
    $("#btn_submit_edit_years").on("click", (e) => {
        e.preventDefault();
        let years_val_new = $("#yearSelect option:selected").text();
        let years_val = $("#yearSelect").val();
        console.log(years_val);
        let years_val_old = $("#year_name").val();
        // สมมติว่า end_time_val_old และ end_time_val_new มีรูปแบบ "YYYY-MM-DDTHH:mm"
        if (years_val_new == years_val_old || years_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลปี`,
                text: `เดิม ค.ศ.${years_val_old} เป็น ค.ศ.${years_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("year", years_val);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    $("#addYear").on("click", (e) => {
        $("#modal_edit_year").modal("hide");
        $("#modal_add_year").modal("show");
    });

    $("#btn_submit_add_year").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
        // console.log(postgetNumberUrl);
        let years_val = $("#input_year_add").val();
        if (years_val >= 2015 && years_val <= 2047) {
            send_new_data_ajax("add_year", years_val);
        } else {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ปีไม่อยู่ช่วงเวลาที่กำหนด ค.ศ.2015 - ค.ศ.2047",
                confirmButtonText: "ตกลง",
            });
        }
        // $("#input_end_time_edit").val($("#end_time").val());
    });

    $("#btn_edit_cotton").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
        // console.log(postgetNumberUrl);

        $.ajax({
            type: "POST",
            url: postEditIdNumberUrl + "/getdata_cotton", // Correctly use Blade syntax
            data: {},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    const vals = response.data; // ข้อมูลปีจาก server
                    const cottonSelect = $("#cottonSelect"); // เลือก select element
                    cottonSelect.empty(); // เคลียร์ค่าเดิม

                    // เพิ่ม option ลงใน select element
                    vals.forEach((val) => {
                        // สร้าง option ใหม่และตรวจสอบว่า val_id ตรงกับ 2 หรือไม่
                        var option = new Option(val.cotton_name, val.cotton_id);
                        if (val.cotton_name === $("#cotton_name").val()) {
                            option.selected = true; // กำหนด selected ให้กับ option
                        }
                        $("#cottonSelect").append(option); // เพิ่ม option ลงใน select
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        confirmButtonText: "ตกลง",
                    });
                }
                $("#modal_edit_cotton").modal("show");
            },
            error: function (xhr, status, error) {
                // Show error if something goes wrong
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    });

    $("#addCotton").on("click", (e) => {
        $("#modal_edit_cotton").modal("hide");
        $("#modal_add_cotton").modal("show");
    });

    $("#btn_submit_add_cotton").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_cotton');
        // console.log(postgetNumberUrl);
        let cottons_val = $("#input_cotton_add").val();
        if (cottons_val != "") {
            send_new_data_ajax("add_cotton", cottons_val);
        } else {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "กรุณากรอกข้อมูลให้ครบถ้วน กรุณาลองใหม่อีกครั้ง",
                confirmButtonText: "ตกลง",
            });
        }
        // $("#input_end_time_edit").val($("#end_time").val());
    });

    $("#btn_submit_edit_cotton").on("click", (e) => {
        e.preventDefault();
        let cotton_val_new = $("#cottonSelect option:selected").text();
        let cotton_val = $("#cottonSelect").val();
        console.log(cotton_val);
        let cotton_val_old = $("#cotton_name").val();
        // สมมติว่า end_time_val_old และ end_time_val_new มีรูปแบบ "YYYY-MM-DDTHH:mm"
        if (cotton_val_new == cotton_val_old || cotton_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ฝ่ายกำกับดูแล`,
                text: `เดิม ฝ่าย${cotton_val_old} เป็น ฝ่าย${cotton_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("cotton", cotton_val);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    // ประเภทท
    $("#btn_edit_type").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
        // console.log(postgetNumberUrl);

        $.ajax({
            type: "POST",
            url: postEditIdNumberUrl + "/getdata_type", // Correctly use Blade syntax
            data: {},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(year_name);
                if (response.success) {
                    const vals = response.data; // ข้อมูลปีจาก server
                    const typesSelect = $("#TypeSelect"); // เลือก select element
                    typesSelect.empty(); // เคลียร์ค่าเดิม

                    // เพิ่ม option ลงใน select element
                    vals.forEach((val) => {
                        // สร้าง option ใหม่และตรวจสอบว่า val_id ตรงกับ 2 หรือไม่
                        var option = new Option(
                            val.type_all_name,
                            val.type_all_id
                        );
                        if (val.type_all_name === $("#type_all_name").val()) {
                            option.selected = true; // กำหนด selected ให้กับ option
                        }
                        $("#TypeSelect").append(option); // เพิ่ม option ลงใน select
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        confirmButtonText: "ตกลง",
                    });
                }
                $("#modal_edit_Type").modal("show");
            },
            error: function (xhr, status, error) {
                // Show error if something goes wrong
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    });

    $("#btn_submit_edit_Type").on("click", (e) => {
        e.preventDefault();
        let type_val_new = $("#TypeSelect option:selected").text();
        let type_val = $("#TypeSelect").val();
        console.log(type_val);
        let type_val_old = $("#type_all_name").val();
        // สมมติว่า end_time_val_old และ end_time_val_new มีรูปแบบ "YYYY-MM-DDTHH:mm"
        if (type_val_new == type_val_old || type_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลประเทภ`,
                text: `เดิม ประเภท ${type_val_old} เป็น ประเภท ${type_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("types", type_val);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    // อาจารย์รับผิดชอบ
    $("#btn_edit_teachers").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
        // console.log(postgetNumberUrl);

        $.ajax({
            type: "POST",
            url: postEditIdNumberUrl + "/getdata_teachers", // Correctly use Blade syntax
            data: {},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                // console.log(response);
                if (response.success) {
                    const vals = response.data; // ข้อมูลปีจาก server
                    const typesSelect = $("#teachersSelect"); // เลือก select element
                    typesSelect.empty(); // เคลียร์ค่าเดิม

                    // เพิ่ม option ลงใน select element
                    vals.forEach((val) => {
                        // สร้าง option ใหม่และตรวจสอบว่า val_id ตรงกับ 2 หรือไม่
                        var option = new Option(
                            val.academic_stort_name +
                                val.teacher_name +
                                " " +
                                val.teacher_lname,
                            val.teacher_id
                        );
                        if (
                            val.academic_stort_name +
                                val.teacher_name +
                                " " +
                                val.teacher_lname ===
                            $("#teacher_name").val()
                        ) {
                            option.selected = true; // กำหนด selected ให้กับ option
                        }
                        $("#teachersSelect").append(option); // เพิ่ม option ลงใน select
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        confirmButtonText: "ตกลง",
                    });
                }
                $("#modal_edit_Teachers").modal("show");
            },
            error: function (xhr, status, error) {
                // Show error if something goes wrong
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    });

    $("#btn_submit_edit_Teacher").on("click", (e) => {
        e.preventDefault();
        let teacher_val_new = $("#teachersSelect option:selected").text();
        let teacher_val = $("#teachersSelect").val();
        console.log(teacher_val);
        let teacher_val_old = $("#teacher_name").val();
        // สมมติว่า end_time_val_old และ end_time_val_new มีรูปแบบ "YYYY-MM-DDTHH:mm"
        if (teacher_val_new == teacher_val_old || teacher_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลอาจารย์ผู้รับผิดชอบ`,
                text: `เดิม  ${teacher_val_old} เป็น  ${teacher_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("teachers", teacher_val);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    // โชว์หน้าเพิ่มช้อมูลอาจารย์

    //เจ้าหน้าที่ผู้รับผิดชอบ
    $("#btn_edit_employee").on("click", (e) => {
        // postgetNumberUrl = postEditIdNumberUrl.replace('edit_data', 'getdata_year');
        // console.log(postgetNumberUrl);

        $.ajax({
            type: "POST",
            url: postEditIdNumberUrl + "/getdata_employee", // Correctly use Blade syntax
            data: {},
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    const vals = response.data; // ข้อมูลปีจาก server
                    const empSelect = $("#EmployeeSelect"); // เลือก select element
                    empSelect.empty(); // เคลียร์ค่าเดิม

                    // เพิ่ม option ลงใน select element
                    vals.forEach((val) => {
                        // สร้าง option ใหม่และตรวจสอบว่า val_id ตรงกับ 2 หรือไม่
                        var option = new Option(
                            val.emp_name + " " + val.emp_lname,
                            val.emp_id
                        );
                        if (
                            val.emp_name + " " + val.emp_lname ===
                            $("#emp_name").val()
                        ) {
                            option.selected = true; // กำหนด selected ให้กับ option
                        }
                        $("#EmployeeSelect").append(option); // เพิ่ม option ลงใน select
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                        confirmButtonText: "ตกลง",
                    });
                }
                $("#modal_edit_Employee").modal("show");
            },
            error: function (xhr, status, error) {
                // Show error if something goes wrong
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    text: "ไม่สามารถอัพเดตข้อมูลได้ กรุณาลองใหม่อีกครั้ง",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    });
    $("#btn_submit_edit_employee").on("click", (e) => {
        e.preventDefault();
        let employee_val_new = $("#EmployeeSelect option:selected").text();
        let employee_val = $("#EmployeeSelect").val();
        console.log(employee_val);
        let employee_val_old = $("#emp_name").val();
        // สมมติว่า end_time_val_old และ end_time_val_new มีรูปแบบ "YYYY-MM-DDTHH:mm"
        if (employee_val_new == employee_val_old || employee_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลอาจารย์ผู้รับผิดชอบ`,
                text: `เดิม  ${employee_val_old} เป็น  ${employee_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("employees", employee_val);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    // อัพโหลดไฟล์

    $(".btn-add-file").on("click", () => {
        $("#modal-add-file").modal("show");
    });
    $("#uploadForm").on("click", function (e) {
        e.preventDefault();
        let name = $("#file-name").val();

        // ดึงไฟล์จาก input โดยตรง
        var formData = new FormData();
        var fileInput = $("#file")[0].files[0];

        if (!fileInput || name == "") {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                html: "กรุณาเลือกไฟล์ก่อนทำการอัปโหลด <br> หรือกรอกข้อมูลให้ครบถ้วน",
                confirmButtonText: "ตกลง",
            });
            return;
        }
        formData.append("name-input", name);
        formData.append("file", fileInput);
        formData.append("id_document", "YOUR_DOCUMENT_UUID_HERE"); // ส่ง UUID ของเอกสารที่เกี่ยวข้อง

        $.ajax({
            url: postEditIdNumberUrl + "/upload",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "สำเร็จ",
                        text: "อัปโหลดไฟล์เรียบร้อย",
                        confirmButtonText: "ตกลง",
                    }).then(() => {
                        location.reload();
                    });
                    $("#modal-add-file").modal("hide");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "เกิดข้อผิดพลาด",
                        text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                        confirmButtonText: "ตกลง",
                    });
                }
            },
            error: function (response) {
                Swal.fire({
                    icon: "error",
                    title: "เกิดข้อผิดพลา2222",
                    text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                    confirmButtonText: "ตกลง",
                });
            },
        });
    });

    $("#btn_edit_description").on("click", (e) => {
        $("#modal_edit_description").modal("show"); // เปิดโมดอล
        $("#input_description_edit").html($("#input_description").val()); // ดึงค่าใน textarea และใส่ใน input ของโมดอล
    });
    $("#btn_submit_edit_description").on("click", (e) => {
        e.preventDefault();
        let description_val_new = $("#input_description_edit").val();
        let description_val_old = $("#input_description").val();

        if (
            description_val_new == description_val_old ||
            description_val_new == ""
        ) {
            Swal.fire({
                icon: "error",
                title: "เกิดข้อผิดพลาด",
                text: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
                confirmButtonText: "ตกลง",
                // text: "Something went wrong!",
                // footer: '< a href="#">Why do I have this issue?</>',
            });
        } else {
            Swal.fire({
                icon: "question",
                title: `คุณต้องการปรับแก้ข้อมูลเวอร์ชั่น`,
                text: `เดิม ${description_val_old} เป็น ${description_val_new}`,
                showCancelButton: true, // Use boolean to show the cancel button
                confirmButtonText: "ยืนยันการบันทึก",
                cancelButtonText: "ยกเลิก", // Text for the cancel button
                customClass: {
                    confirmButton: "btn btn-success", // Use Bootstrap classes for the confirm button
                    cancelButton: "btn btn-danger", // Use Bootstrap classes for the cancel button
                },
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    send_data_ajax("description", description_val_new);
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });

    $(document).on("change", ".toggle-status", function (e) {
        // $(document).on('change', '.toggle-status', function() {
        var toggleSwitch = $(this);
        var fileId = toggleSwitch.data("id");
        var newStatus = toggleSwitch.is(":checked") ? 1 : 0;
        console.log(newStatus);
        if (newStatus === 1) {
            // ถ้าสถานะเปลี่ยนเป็น "เปิด" แสดงการแจ้งเตือน SweetAlert เพื่อยืนยัน
            Swal.fire({
                title: "ต้องการอนุญาตให้ดาวน์โหลดหรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ใช่, อนุญาต",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if (result.isConfirmed) {
                    // ถ้าผู้ใช้ยืนยัน ให้ส่งข้อมูลเพื่อเปลี่ยนสถานะ
                    changeStatus(fileId, 1);
                } else {
                    // ถ้าผู้ใช้ยกเลิก ให้เปลี่ยนสวิตช์กลับไปที่สถานะเดิม
                    toggleSwitch.prop("checked", false);
                }
            });
        } else {
            // ถ้าสถานะเปลี่ยนเป็น "ปิด" ให้เปลี่ยนสถานะโดยไม่ต้องแจ้งเตือน
            Swal.fire({
                title: "ต้องการยกเลิกดาวน์โหลดหรือไม่?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ใช่, อนุญาต",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if (result.isConfirmed) {
                    // ถ้าผู้ใช้ยืนยัน ให้ส่งข้อมูลเพื่อเปลี่ยนสถานะ
                    changeStatus(fileId, 0);
                } else {
                    // ถ้าผู้ใช้ยกเลิก ให้เปลี่ยนสวิตช์กลับไปที่สถานะเดิม
                    toggleSwitch.prop("checked", true);
                }
            });
        }
    });

    // ฟังก์ชันสำหรับส่งข้อมูลไปยังเซิร์ฟเวอร์
    function changeStatus(fileId, newStatus) {
        $.ajax({
            type: "POST",
            url: postEditIdNumberUrl + "/change_status",
            data: {
                status: newStatus,
                fileId: fileId,
            },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    Swal.fire(
                        "สำเร็จ!",
                        "สถานะถูกเปลี่ยนเรียบร้อยแล้ว",
                        "success"
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        "เกิดข้อผิดพลาด!",
                        "ไม่สามารถเปลี่ยนสถานะได้ กรุณาลองใหม่อีกครั้ง",
                        "error"
                    );
                }
            },
            error: function () {
                Swal.fire(
                    "เกิดข้อผิดพลาด!",
                    "ไม่สามารถเปลี่ยนสถานะได้ กรุณาลองใหม่อีกครั้ง",
                    "error"
                );
            },
        });
    }
    $(document).on("click", ".download-btn", function (e) {
        e.preventDefault(); // ป้องกันการทำงานเริ่มต้นของลิงก์

        var fileUrl = $(this).data("file-url"); // URL ของไฟล์
        var fileName = $(this).data("file-name"); // ชื่อไฟล์ที่ต้องการตั้ง
        console.log(fileUrl);
        // ตรวจสอบว่า fileUrl ถูกต้องหรือไม่
        if (fileUrl) {
            // สร้างลิงก์แบบไดนามิกเพื่อดาวน์โหลดไฟล์
            var a = document.createElement("a");
            a.href = fileUrl;
            a.setAttribute("download", fileName); // ตั้งชื่อไฟล์ที่ต้องการดาวน์โหลด

            // ตรวจสอบว่าเบราว์เซอร์รองรับการดาวน์โหลดโดยใช้ download attribute หรือไม่
            if (a.download !== undefined) {
                document.body.appendChild(a); // เพิ่มลิงก์ชั่วคราวไปยัง DOM
                a.click(); // คลิกที่ลิงก์เพื่อดาวน์โหลดไฟล์
                document.body.removeChild(a); // ลบลิงก์ชั่วคราวออกจาก DOM
            } else {
                // หากเบราว์เซอร์ไม่รองรับ ใช้วิธีเปิดหน้าต่างใหม่แทน
                window.open(fileUrl, "_blank");
            }
        } else {
            alert("ไม่พบไฟล์สำหรับดาวน์โหลด");
        }
    });
});
