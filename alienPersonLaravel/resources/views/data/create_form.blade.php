@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
        <div class="col-sm-12">

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <form action="#" @submit.prevent="addHome">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <center><h4 class="modal-title" id="myModalLabel"><i class="fa fa-home fa-lg"></i>&nbsp&nbsp ข้อมูลบ้าน</h4></center>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                              <div class="form-group col-sm-12">
                                  <label for="hospital">สถานบริการ</label>
                                  <select class="form-control" name="hospital" v-model="newHome.hospital" id="hospital" required="required">
                                      <option value="">
                                          เลือกสถานบริการ
                                      </option>
                                      <option v-for="h in allCode.hospital" :value="h.hoscode">@{{h.hoscode}}-@{{h.hosname}}</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-12">
                                  <label for="vstatus">การอาศัยในพื้นที่</label>
                                  <select class="form-control" name="vstatus" v-model="newHome.vstatus" id="vstatus" required="required">
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
                              <div class="form-group col-sm-6">
                                  <label for="osm">ชื่อ อสม. ผู้ดูแล</label>
                                  <input type="text" name="osm" v-model="newHome.osm" class="form-control" id="osm" placeholder="อสม. ผู้ดูแล">
                              </div>
                              <div class="form-group col-sm-6">
                                  <label for="ost">ชื่อ อสต. ผู้ดูแล</label>
                                  <input type="text" name="ost" v-model="newHome.ost" class="form-control" id="ost" placeholder="อสต. ผู้ดูแล">
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="address">บ้านเลขที่</label>
                                  <input type="text" name="address" v-model="newHome.address" class="form-control" id="address" placeholder="บ้านเลขที่" required="required">
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="moo">หมู่ที่</label>
                                  <input type="text" name="moo" v-model="newHome.moo" class="form-control" id="moo" placeholder="หมู่ที่" required="required">
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="village">หมู่บ้าน</label>
                                  <input type="text" name="village" v-model="newHome.village" class="form-control" id="village" placeholder="หมู่บ้าน" required="required">
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="tambon">ตำบล</label>
                                  <select class="form-control" name="tambon" v-model="newHome.tambon" id="tambon" required="required">
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
                              <div class="form-group col-sm-4">
                                  <label for="amphor">อำเภอ</label>
                                  <select class="form-control" name="amphor" v-model="newHome.amphor" id="amphor" required="required">
                                      <option value="">เลือกอำเภอ</option>
                                      <option value="05">05-ท่าสองยาง</option>
                                      <option value="99">99-ไม่ระบุ</option>
                                  </select>
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="changwat">จังหวัด</label>
                                  <select class="form-control" name="changwat" v-model="newHome.changwat" id="changwat" required="required">
                                      <option value="">เลือกจังหวัด</option>
                                      <option value="63">63-ตาก</option>
                                      <option value="99">99-ไม่ระบุ</option>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times fa-fw"></i> ยกเลิก</button>
                          <button type="submit"class="btn btn-primary btn-sm"><i class="fa fa-save fa-fw"></i> บันทึก</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
              </form>
            <!-- /.modal-dialog -->
            </div>

            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 style="text-align: center">** เพิ่มข้อมูลประชากร ** </h4>
                </div>
                <div class="panel-body">
                    <form action="#" @submit.prevent="addPerson">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#person">
                                    <i class="fa fa-user"></i>
                                    ข้อมูลบุคคล
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#service">
                                    <i class="fa fa-plus-square"></i>
                                    ข้อมูลการเข้าถึงบริการ
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- person tabs  -->
                            <div id="person" class="tab-pane fade in active">
                                <h4 style="text-align: center">**ข้อมูลบุคคล**</h4><hr/>

                                <div class="row">
                                  <div class="form-group col-sm-2">
                                      <label for="sTambon">ตำบล</label>
                                      <select name="sTambon" v-model="sTambon" class="form-control" id="sTambon" @change="changeTambon">
                                        <option value="">เลือกตำบล</option>
                                        <option value="01">01-แม่หละ</option>
                                        <option value="02">02-แม่ต้าน</option>
                                        <option value="03">03-แม่สอง</option>
                                        <option value="04">04-แม่อุสุ</option>
                                        <option value="05">05-ท่าสองยาง</option>
                                        <option value="06">06-แม่วะหลวง</option>
                                      </select>
                                  </div>

                                  <div class="form-group col-sm-3">
                                      <label for="sAddresses">บ้านเลขที่</label>
                                      <select v-model="newPerson.sAddresses"  name="sAddresses" class="form-control" id="sAddresses">
                                          <option  value="">เลือกบ้านเลขที่</option>
                                          <option v-for="p in sAddresses" :value="p.HOSPCODE+p.HID">@{{ p.HOSPCODE }}-@{{ p.HID }} ( เลขที่ @{{ p.HOUSENO }} หมู่ @{{ p.MOO }} )</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-sm-2 pull-right">
                                      <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><i class="fa fa-plus fa-fw"></i> เพิ่มบ้านใหม่</a>
                                  </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-sm-2">
                                        <label for="preName">คำนำหน้าชื่อ</label>
                                        <select name="preName" v-model="newPerson.preName" class="form-control" id="preName" required='required' @change="changeGender">
                                            <option  value="">เลือกคำนำหน้าชื่อ</option>
                                            <option v-for="p in allCode.preName" :value="p.mapprename">@{{ p.mapprename }}-@{{ p.prename }}</option>
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
                                        <label for="dob">ว/ด/ปี(ค.ศ.) เกิด</label>
                                        <input type="date" name="dob" v-model="newPerson.dob" class="form-control" id="dob" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="sex">เพศ</label>
                                        <select class="form-control" name="sex" v-model="newPerson.sex" id="sex" :disabled="true">
                                            <option :value="newPerson.sex">@{{txtSex}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="mStatus">สถานภาพสมรส</label>
                                        <select class="form-control" name="mStatus" v-model="newPerson.mStatus" id="mStatus" required="required">
                                            <option value="">สถานภาพสมรส</option>
                                            <option v-for="m in allCode.mStatus" :value="m.mapmstatus">@{{m.mapmstatus}}-@{{m.mstatusname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="education">การศึกษา</label>
                                        <select class="form-control" name="education" v-model="newPerson.education" id="education" required="required">
                                            <option value="">การศึกษา</option>
                                            <option v-for="c in allCode.education" :value="c.mapeducation">@{{c.mapeducation}}-@{{c.educationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="occupation">อาชีพ</label>
                                        <select class="form-control" name="occupation" v-model="newPerson.occupation" id="occupation" required="required">
                                            <option value="">อาชีพ</option>
                                            <option v-for="o in allCode.occupation" :value="o.mapoccupation">@{{o.mapoccupation}}-@{{o.occupationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="religion">ศาสนา</label>
                                        <select class="form-control" name="religion" v-model="newPerson.religion" id="religion" required="required">
                                            <option value="">ศาสนา</option>
                                            <option v-for="o in allCode.religion" :value="o.mapreligion">@{{o.mapreligion}}-@{{o.religionname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="race">เชื้อชาติ</label>
                                        <select class="form-control" name="race" v-model="newPerson.race" id="race" required="required">
                                            <option value="">เชื้อชาติ</option>
                                            <option v-for="o in allCode.nation" :value="o.mapnation">@{{o.mapnation}}-@{{o.nationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="nation">สัญชาติ</label>
                                        <select class="form-control" name="nation" v-model="newPerson.nation" id="nation" required="required">
                                            <option value="">สัญชาติ</option>
                                            <option v-for="o in allCode.nation" :value="o.mapnation">@{{o.mapnation}}-@{{o.nationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="fStatus">สถานะในครอบครัว</label>
                                        <select class="form-control" name="fStatus" v-model="newPerson.fStatus" id="fStatus" required="required">
                                            <option value="">สถานะในครอบครัว</option>
                                            <option v-for="o in allCode.fstatus" :value="o.mapfstatus">@{{o.mapfstatus}}-@{{o.fstatusname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="typearea">สถานะบุคคล</label>
                                        <select class="form-control" name="typearea" v-model="newPerson.typearea" id="typearea" required="required">
                                            <option value="">สถานะบุคคล</option>
                                            <option v-for="o in allCode.typearea" :value="o.maptypearea">@{{o.maptypearea}}-@{{o.typeareaname}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- end person tabs  -->
                            <!-- service tabs  -->
                            <div id="service" class="tab-pane fade">
                                <h4 style="text-align: center">**ข้อมูลการเข้าถึงบริการ**</h4><hr/>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <h5><b>- เมื่อเจ็บป่วยไปรักษาที่ใด</b></h5>
                                        <?php
                                            $ill_hos = ['hosp'=>'โรงพยาบาล', 'anamia'=>'สถานีอนามัย', 'clinic'=>'คลีนิค', 'self'=>'ซื้อยากินเอง', 'othersHos'=>'อื่นๆ'];
                                            $i = 0;
                                        ?>
                                        @foreach($ill_hos as $key=>$value)
                                        <?php $i++;?>
                                        <div class="col-sm-2">
                                            <input type="checkbox" v-model="newPerson.{{$key}}" name="{{$key}}" id="{{$i}}"> &nbsp&nbsp {{$i}} ){{$value}}
                                        </div>
                                        @endforeach
                                        <div v-if="newPerson.othersHos" class="form-inline col-sm-4">
                                            <input class="form-control" type="text" v-model="newPerson.othersTextHos" name="othersTextHos" placeholder="โปรดระบุ..." required="required">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <h5><b>- ค่าใช้จ่ายในการรักษาพยาบาล</b></h5>
                                        <?php
                                            $ill_cost = ['ss'=>'ประกันสังคม', 'sh'=>'ประกันสุขภาพ', 'selfCost'=>'จ่ายเอง(จ่ายครบ)', 'free'=>'ฟรี', 'half'=>'จ่ายบางส่วน', 'othersCost'=>'อื่นๆ'];
                                            $i = 0;
                                        ?>
                                        @foreach($ill_cost as $key=>$value)
                                        <?php $i++;?>
                                        <div class="col-sm-2">
                                            <input type="checkbox" v-model="newPerson.{{$key}}" name="{{$key}}" id="{{$i}}"> &nbsp&nbsp {{$i}} ){{$value}}
                                        </div>
                                        @endforeach
                                        <div v-if="newPerson.othersCost" class="form-inline col-sm-4">
                                            <input class="form-control" type="text" v-model="newPerson.othersTextCost" name="othersTextCost" placeholder="โปรดระบุ..." required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end service tabs  -->
                        </div>
                        <hr/>

                        <div class="alert alert-success" transition="success" style="text-align: center" v-if="success">เพิ่ม " @{{newPerson.fName}} @{{newPerson.lName}} " สำเร็จแล้ว</div>

                        <div style="text-align:center">
                            <button :disabled="!isValid" type="submit" class="btn btn-success"><i class="fa fa-save fa-lg"></i>&nbsp&nbsp บันทึกข้อมูล</button>
                            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-lg"></i>&nbsp&nbsp ล้างข้อมูล</button>
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
  <script src="{{asset('/js/create-form.js')}}"></script>
@endpush
