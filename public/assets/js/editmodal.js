$(document).ready(function () {
    $("#btn_edit_id_number").on("click", function (e) {
        $("#modal_edit_id_number").modal("show");
        //    console.log( $("#id_number_page").val())
        $("#id_number_edit").val($("#id_number_page").val());
    });
    $("#btn_id_number_edit").on("click", function (e) {
        e.preventDefault();
        let id_val_old = $("#id_number_page").val();
        let id_val_new = $("#id_number_edit").val();
        if (id_val_new == id_val_old || id_val_new == "") {
            Swal.fire({
                icon: "error",
                title: "ข้อมูลไม่ถูกต้องหรืออาจเป็นข้อมูลเดิม",
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
                    $.ajax({
                        type: "POST",
                        url: postEditIdNumberUrl, // Correctly use Blade syntax
                        data: {
                            id_number_new: id_val_new
                        },
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success"
                              });
                        },
                        error: function (xhr, status, error) {
                            // Show error if something goes wrong
                            console.log(error);
                        },
                    });
                }
                // else if (result.isDenied) {
                //     Swal.fire("Changes are not saved", "", "info");
                // }
            });
        }
    });
    // Swal.fire({
    //     title: "The Internet?",
    //     text: "That thing is still around?",
    //     icon: "question",
    // });
    // $(".btndata").on("click", function (e) {
    //     e.preventDefault();
    //     $.ajax({
    //         type: "post",
    //         url: "/nextform", // URL ที่ต้องการส่งข้อมูลไป
    //         data: formData,
    //         dataType: "json",
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"), // ใช้เพื่อส่ง CSRF token
    //         },
    //         success: function (response) {
    //             $("#number-choice").html(
    //                 parseInt($("#number-choice").html()) + 1
    //             );
    //             $("#quiz_content").html(quizContent);
    //         },
    //         error: function (xhr, status, error) {
    //             // แสดงข้อผิดพลาดเมื่อมีปัญหา
    //             console.log(error);
    //             alert("เกิดข้อผิดพลาดในการส่งคำตอบ");
    //         },
    //     });
    // });
    // $(".btn_id_show").click(function (event) {
    //     // event.preventDefault();

    //     var documentId = $(this).data("id"); // ดึง id จาก data-id
    //     console.log(documentId);

    //     $.ajax({
    //         type: "post",
    //         url: "{{route('postedit_id_number')}}", // URL ที่ต้องการส่งข้อมูลไป
    //         data: {
    //             id: documentId,
    //         },
    //         // dataType: "json",
    //         headers: {
    //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    //         },
    //         success: function (response) {
    //             // Redirect handled by the server
    //             window.location.href = response.redirect_url;
    //         },
    //         error: function (xhr, status, error) {
    //             console.log(error);
    //             alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง");
    //         },
    //     });
    // });
});
