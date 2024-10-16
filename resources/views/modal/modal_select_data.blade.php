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
                <h1 class="modal-title fs-5" id="exampleModalLabel">สิ้นสุดวันที่</h1>
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
                    <button class="btn btn-primary me-2" id="addYear">เพิ่มข้อมูลปี</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">

                <select id="yearSelect" class="form-control mt-3"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_years">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_add_year" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลปี</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input class="form-control" type="number" id="input_year_add" aria-describedby="basic-addon1"
                        placeholder="เลือกปี" min="2015" max="2047">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_add_year">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_edit_cotton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ฝ่ายกำกับดูแล</h1>
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary me-2" id="addCotton">เพิ่มข้อมูลฝ่าย</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">

                <select id="cottonSelect" class="form-control mt-3"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_cotton">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_add_cotton" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข้อมูลฝ่ายกำกับดูแล</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input class="form-control" type="text" id="input_cotton_add" aria-describedby="basic-addon1"
                        placeholder="เพิ่มฝ่ายใหม่">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_add_cotton">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>


<!-- popup  ประเภท -->
<div class="modal fade" id="modal_edit_Type" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ประเภท</h1>
                <div class="d-flex align-items-center">
                    <!-- <button class="btn btn-primary me-2" id="addType">เพิ่มข้อมูลฝ่าย</button> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">

                <select id="TypeSelect" class="form-control mt-3"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_Type">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>




<!-- popup  อาจารย์ -->
<div class="modal fade" id="modal_edit_Teachers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">อาจารย์ที่รับผิดชอบ</h1>
                <div class="d-flex align-items-center">
                    <!-- ทำ link หน้า -->
                    <a class="btn btn-primary me-2" href="#" id="addType">เพิ่มข้อมูลอาจารย์</a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">

                <select id="teachersSelect" class="form-control mt-3"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_Teacher">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>




<!-- popup  เจ้าหน้าที่ผู้รับผิดชอบ -->
<div class="modal fade" id="modal_edit_Employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h1 class="modal-title fs-5" id="exampleModalLabel">เจ้าหน้าที่ผู้รับผิดชอบ</h1>
                <div class="d-flex align-items-center">
                    <!-- ทำ link หน้า -->
                    <a class="btn btn-primary me-2" href="#" id="addType">เพิ่มข้อมูลเจ้าหน้า</a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">

                <select id="EmployeeSelect" class="form-control mt-3"></select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn_submit_edit_employee">ยืนยัน</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>
</div>
