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

$(document).ready(function () {
    let edit_col;
    $("#btn_edit_id_number").on("click", function (e) {
        $("#modal_edit_id_number").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#id_number_edit").val($("#id_number_page").val());
    });
    $("#btn_id_number_edit").on("click", function (e) {
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
    $("#btn_edit_name").on("click", function (e) {
        $("#modal_edit_name").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#input_name_edit").val($("#document_name").val());
    });
    $("#btn_submit_edit_name").on("click", function (e) {
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
                title: `คุณต้องการปรับแก้หมายเลขอ้างอิง`,
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
    $("#btn_edit_version").on("click", function (e) {
        $("#modal_edit_version").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#input_version_edit").val($("#version").val());
    });
    $("#btn_submit_edit_version").on("click", function (e) {
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
                title: `คุณต้องการปรับแก้หมายเลขอ้างอิง`,
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

    $("#btn_edit_end_time").on("click", function (e) {
        $("#modal_edit_end_time").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#input_end_time_edit").val($("#end_time").val());
    });
    $("#btn_submit_edit_end_time").on("click", function (e) {
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
                title: `คุณต้องการปรับแก้หมายเลขอ้างอิง`,
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

    $("#btn_edit_year").on("click", function (e) {
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
                console.log(year_name)
                if (response.success) {
                    const years = response.data; // ข้อมูลปีจาก server
                    const yearSelect = $("#yearSelect"); // เลือก select element
                    yearSelect.empty(); // เคลียร์ค่าเดิม

                    // เพิ่ม option ลงใน select element
                    years.forEach(function (year) {
                        // สร้าง option ใหม่และตรวจสอบว่า year_id ตรงกับ 2 หรือไม่
                        var option = new Option(year.year_name, year.year_id);
                        if (year.year_name === $('#year_name').val()) {
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
    $("#btn_submit_edit_end_time").on("click", function (e) {
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
                title: `คุณต้องการปรับแก้หมายเลขอ้างอิง`,
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
});
