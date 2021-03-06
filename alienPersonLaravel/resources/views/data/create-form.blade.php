@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 style="text-align: center">** เพิ่มข้อมูลประชากร ** </h4>
                </div>
                <div class="panel-body">

                    <form action="#" @submit.prevent="AddNewPerson" method="POST">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#person">
                                    <i class="fa fa-user"></i>
                                    ข้อมูลบุคคล
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#home">
                                    <i class="fa fa-home"></i>
                                    ข้อมูลบ้าน
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- person tabs  -->
                            <div id="person" class="tab-pane fade in active">
                                <h4 style="text-align: center">**ข้อมูลบุคคล**</h4><hr/>
                                <div class="row">

                                    <div class="form-group col-sm-2">
                                        <label for="preName">คำนำหน้าชื่อ</label>
                                        <select name="preName" v-model="newPerson.preName" class="form-control" id="preName" required='required' @change="changeGender">
                                            <option value="">คำนำหน้าชื่อ</option>
                                            <option v-for="p in allCode.preName" :value="p.id_prename">{{ p.id_prename }}-{{ p.prename }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="fName">ชื่อ</label>
                                        <input type="text" name="fName" v-model="newPerson.fName" class="form-control" id="fName" placeholder="กรอกชื่อ" required="required">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lName">นามสกุล</label>
                                        <input type="text" name="lName" v-model="newPerson.lName" class="form-control" id="lName" placeholder="กรอกนามสกุล" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="dob">ว/ด/ปี(พ.ศ.) เกิด</label>
                                        <input type="date" name="dob" v-model="newPerson.dob" class="form-control" id="dob" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="sex">เพศ</label>
                                        <select class="form-control" name="sex" v-model="newPerson.sex" id="sex" :disabled="true">
                                            <option :value="newPerson.sex">{{txtSex}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="mStatus">สถานภาพสมรส</label>
                                        <select class="form-control" name="mStatus" v-model="newPerson.mStatus" id="mStatus" required="required">
                                            <option value="">สถานภาพสมรส</option>
                                            <option v-for="m in allCode.mStatus" :value="m.mapmstatus">{{m.mapmstatus}}-{{m.mstatusname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="education">การศึกษา</label>
                                        <select class="form-control" name="education" v-model="newPerson.education" id="education" required="required">
                                            <option value="">การศึกษา</option>
                                            <option v-for="c in allCode.education" :value="c.mapeducation">{{c.mapeducation}}-{{c.educationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="occupation">อาชีพ</label>
                                        <select class="form-control" name="occupation" v-model="newPerson.occupation" id="occupation" required="required">
                                            <option value="">อาชีพ</option>
                                            <option v-for="o in allCode.occupation" :value="o.mapoccupation">{{o.mapoccupation}}-{{o.occupationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="religion">ศาสนา</label>
                                        <select class="form-control" name="religion" v-model="newPerson.religion" id="religion" required="required">
                                            <option value="">ศาสนา</option>
                                            <option v-for="o in allCode.religion" :value="o.mapreligion">{{o.mapreligion}}-{{o.religionname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="race">เชื้อชาติ</label>
                                        <select class="form-control" name="race" v-model="newPerson.race" id="race" required="required">
                                            <option value="">เชื้อชาติ</option>
                                            <option v-for="o in allCode.nation" :value="o.mapnation">{{o.mapnation}}-{{o.nationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="nation">สัญชาติ</label>
                                        <select class="form-control" name="nation" v-model="newPerson.nation" id="nation" required="required">
                                            <option value="">สัญชาติ</option>
                                            <option v-for="o in allCode.nation" :value="o.mapnation">{{o.mapnation}}-{{o.nationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="fStatus">สถานะในครอบครัว</label>
                                        <select class="form-control" name="fStatus" v-model="newPerson.fStatus" id="fStatus" required="required">
                                            <option value="">สถานะในครอบครัว</option>
                                            <option v-for="o in allCode.fstatus" :value="o.mapfstatus">{{o.mapfstatus}}-{{o.fstatusname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="typearea">สถานะบุคคล</label>
                                        <select class="form-control" name="typearea" v-model="newPerson.typearea" id="typearea" required="required">
                                            <option value="">สถานะบุคคล</option>
                                            <option v-for="o in allCode.typearea" :value="o.maptypearea">{{o.maptypearea}}-{{o.typeareaname}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end person tabs  -->
                            <!-- home tabs  -->
                            <div id="home" class="tab-pane fade">
                                <h4 style="text-align: center">**ข้อมูลบ้าน**</h4><hr/>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="hospital">สถานบริการ</label>
                                        <select class="form-control" name="hospital" v-model="newPerson.hospital" id="hospital" required="required">
                                            <option value="">
                                                เลือกสถานบริการ
                                            </option>
                                            <option v-for="h in allCode.hospital" :value="h.hoscode">{{h.hoscode}}-{{h.hosname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="vstatus">การอาศัยในพื้นที่</label>
                                        <select class="form-control" name="vstatus" v-model="newPerson.vstatus" id="vstatus" required="required">
                                            <option value="">
                                                เลือกการอาศัยในพื้นที่
                                            </option>
                                            <option value="1">
                                                1-อาศัยในประเทศไทย
                                            </option>
                                            <option value="2">
                                                2-อาศัยในประเทศเมียนมาร์
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="address">บ้านเลขที่</label>
                                        <input type="text" name="address" v-model="newPerson.address" class="form-control" id="address" placeholder="บ้านเลขที่" required="required">
                                    </div>
                                    <div class="form-group col-sm-1">
                                        <label for="moo">หมู่ที่</label>
                                        <input type="text" name="moo" v-model="newPerson.moo" class="form-control" id="moo" placeholder="หมู่ที่" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="village">หมู่บ้าน</label>
                                        <input type="text" name="village" v-model="newPerson.village" class="form-control" id="village" placeholder="หมู่บ้าน" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="tambon">ตำบล</label>
                                        <select class="form-control" name="tambon" v-model="newPerson.tambon" id="tambon" required="required">
                                            <option value="">เลือกตำบล</option>
                                            <option value="01">01-แม่หละ</option>
                                            <option value="02">02-แม่ต้าน</option>
                                            <option value="03">03-แม่สอง</option>
                                            <option value="04">04-แม่อุสุ</option>
                                            <option value="05">05-ท่าสองยาง</option>
                                            <option value="06">06-แม่วะหลวง</option>
                                            <option value="99">99-ไม่ระบุ</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="amphor">อำเภอ</label>
                                        <select class="form-control" name="amphor" v-model="newPerson.amphor" id="amphor" required="required">
                                            <option value="">เลือกอำเภอ</option>
                                            <option value="05">05-ท่าสองยาง</option>
                                            <option value="99">99-ไม่ระบุ</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="changwat">จังหวัด</label>
                                        <select class="form-control" name="changwat" v-model="newPerson.changwat" id="changwat" required="required">
                                            <option value="">เลือกจังหวัด</option>
                                            <option value="63">63-ตาก</option>
                                            <option value="99">99-ไม่ระบุ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end home tabs  -->
                        </div>
                        <hr/>

                        <div class="alert alert-success" transition="success" style="text-align: center" v-if="success">เพิ่มบุคคล สำเร็จแล้ว</div>

                        <div style="text-align:center">
                            <button :disabled="!isValid" type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                            <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="/js/create_form.js"></script>
@endpush
