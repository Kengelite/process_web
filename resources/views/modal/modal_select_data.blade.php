<!-- Modal -->
<div class="modal fade" id="modal_edit_id_number" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">หมายเลขอ้างอิง</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input class="form-control" type="text" id="id_number_edit" aria-describedby="basic-addon1">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_id_number_edit">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_edit_name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ชื่อเอกสาร</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input class="form-control" type="text" id="input_name_edit" aria-describedby="basic-addon1">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_name">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_edit_version" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ชื่อเอกสาร</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input class="form-control" type="text" id="input_version_edit" aria-describedby="basic-addon1">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_version">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_edit_end_time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">วันเวลาสิ้นสุด</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input class="form-control" type="datetime-local" id="input_end_time_edit"
                        aria-describedby="basic-addon1">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_end_time">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_edit_year" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ปี (ค.ศ.)</h1>
                <div class="d-flex align-items-center">
                    <button class="btn btn-success me-2" id="addYearBtn">เพิ่มข้อมูลปี</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">

                <select id="yearSelect" class="form-control mt-3"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_end_time">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>