@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
        <div class="col-sm-12">

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <form action="#" @submit.prevent="updateHomes(`{{$home[0]['HOSPCODE']}}{{$home[0]['HID']}}`)">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <center><h4 class="modal-title" id="myModalLabel"><i class="fa fa-home fa-lg"></i>&nbsp&nbsp ข้อมูลบ้าน (HID :: {{$home[0]['HOSPCODE']}} - {{$home[0]['HID']}})</h4></center>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="hospital">สถานบริการ</label>
                              <select class="form-control" name="hospital" ref="hospital" id="hospital" required="required">
                                  <option v-for="h in allCode.hospital" :value = "h.hoscode" :selected="`{{$home[0]['HOSPCODE']}}` === h.hoscode ? true : false">@{{h.hoscode}}-@{{h.hosname}}</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="vstatus">การอาศัยในพื้นที่</label>
                              <select class="form-control" name="vstatus" ref="vstatus" id="vstatus" required="required">
                                  <option value="1" :selected="{{$home[0]['VSTATUS']}} == 1 ? true : false">
                                      1-อาศัยในประเทศไทย
                                  </option>
                                  <option value="2" :selected="{{$home[0]['VSTATUS']}} == 2 ? true : false">
                                      2-อาศัยในประเทศเมียนมาร์
                                  </option>
                              </select>
                            </div>
                            <div class="form-group col-sm-6">
                              <label for="osm">ชื่อ อสม. ผู้ดูแล</label>
                              <input type="text" name="osm" ref="osm" value="{{$home[0]['OSM']}}" class="form-control" id="osm" placeholder="อสม. ผู้ดูแล">
                            </div>
                            <div class="form-group col-sm-6">
                              <label for="ost">ชื่อ อสต. ผู้ดูแล</label>
                              <input type="text" name="ost" ref="ost" value="{{$home[0]['OST']}}" class="form-control" placeholder="อสต. ผู้ดูแล" id="ost">
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="address">บ้านเลขที่</label>
                              <input type="text" name="address" ref="address" class="form-control" id="address" value="{{$home[0]['HOUSENO']}}" required="required">
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="moo">หมู่ที่</label>
                              <input type="text" name="moo" ref="moo" class="form-control" id="moo" value="{{$home[0]['MOO']}}" required="required">
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="village">หมู่บ้าน</label>
                              <input type="text" name="village" ref="village" class="form-control" id="village" value="{{$home[0]['VILLNAME']}}" required="required">
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="tambon">ตำบล</label>
                              <select class="form-control" name="tambon" ref="tambon" id="tambon" required="required">
                                  <option value="01" :selected="`{{$home[0]['TAMBON']}}` == '01' ? true : false">01-แม่หละ</option>
                                  <option value="02" :selected="`{{$home[0]['TAMBON']}}` == '02' ? true : false">02-แม่ต้าน</option>
                                  <option value="03" :selected="`{{$home[0]['TAMBON']}}` == '03' ? true : false">03-แม่สอง</option>
                                  <option value="04" :selected="`{{$home[0]['TAMBON']}}` == '04' ? true : false">04-แม่อุสุ</option>
                                  <option value="05" :selected="`{{$home[0]['TAMBON']}}` == '05' ? true : false">05-ท่าสองยาง</option>
                                  <option value="06" :selected="`{{$home[0]['TAMBON']}}` == '06' ? true : false">06-แม่วะหลวง</option>
                                  <option value="99" :selected="`{{$home[0]['TAMBON']}}` == '99' ? true : false">99-ไม่ระบุ</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="amphor">อำเภอ</label>
                              <select class="form-control" name="amphor" ref="amphor" id="amphor" required="required">
                                  <option value="05" :selected="{{$home[0]['AMPUR']}} == '05' ? true : false">05-ท่าสองยาง</option>
                                  <option value="99" :selected="{{$home[0]['AMPUR']}} == '99' ? true : false">99-ไม่ระบุ</option>
                              </select>
                            </div>
                            <div class="form-group col-sm-4">
                              <label for="changwat">จังหวัด</label>
                              <select class="form-control" name="changwat" ref="changwat" id="changwat" required="required">
                                  <option value="63" :selected="{{$home[0]['CHANGWAT']}} == '63' ? true : false">63-ตาก</option>
                                  <option value="99" :selected="{{$home[0]['CHANGWAT']}} == '99' ? true : false">99-ไม่ระบุ</option>
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
                    <!-- {{$person}}<br> -->
                </div>
                <div class="panel-body">
                    <form action="#" @submit.prevent="updatePersons(`{{$person[0]['ID']}}`)" >
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
                                <h4 style="text-align: center">**ข้อมูลบุคคล (PID :: {{ $person[0]['PID'] }})**</h4><hr/>

                                <div class="row">
                                  <div class="form-group col-sm-2">
                                      <label for="sTambon">ตำบล</label>
                                      <select name="sTambon" v-model="sTambon" class="form-control" id="sTambon" @change="changeTambon">
                                        <option value="">เลือกตำบล</option>
                                        <option value="01" :selected="`{{$home[0]['TAMBON']}}` == '01' ? true : false">01-แม่หละ</option>
                                        <option value="02" :selected="`{{$home[0]['TAMBON']}}` == '02' ? true : false">02-แม่ต้าน</option>
                                        <option value="03" :selected="`{{$home[0]['TAMBON']}}` == '03' ? true : false">03-แม่สอง</option>
                                        <option value="04" :selected="`{{$home[0]['TAMBON']}}` == '04' ? true : false">04-แม่อุสุ</option>
                                        <option value="05" :selected="`{{$home[0]['TAMBON']}}` == '05' ? true : false">05-ท่าสองยาง</option>
                                        <option value="06" :selected="`{{$home[0]['TAMBON']}}` == '06' ? true : false">06-แม่วะหลวง</option>
                                      </select>
                                  </div>

                                  <div class="form-group col-sm-3">
                                      <label for="hosHid">บ้านเลขที่</label>
                                      <select name="hosHid" ref="hosHid" class="form-control" id="hosHid">
                                          <option  value="">เลือกบ้านเลขที่</option>
                                          <option v-for="s in hosHid"  :value="s.HOSPCODE + s.HID" :selected="`{{$home[0]['HOSPCODE']}}`+`{{$home[0]['HID']}}` == s.HOSPCODE+s.HID ? true : false">@{{s.HOSPCODE}}-@{{s.HID}} ( เลขที่ @{{s.HOUSENO}} หมู่ @{{s.MOO}} )</option>
                                      </select>
                                  </div>
                                  <div class="form-group col-sm-2 pull-right">
                                      <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" style="cursor:pointer;"><i class="fa fa-edit fa-fw"></i> แก้ไขข้อมูลบ้าน</a>
                                  </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="form-group col-sm-2">
                                        <label for="preName">คำนำหน้าชื่อ</label>
                                        <select name="preName" ref="preName" class="form-control" id="preName" required='required' @change="changeGender">
                                            <option v-for="p in allCode.preName" :value="p.mapprename" :selected="`{{$person[0]['PRENAME']}}`  == p.mapprename ? true : false">@{{ p.mapprename }}-@{{ p.prename }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="fName">ชื่อ</label>
                                        <input type="text" name="fName" ref="fName" value="{{$person[0]['NAME']}}" class="form-control" placeholder="กรอกชื่อ" id="fName" required="required">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="lName">นามสกุล</label>
                                        <input type="text" name="lName" ref="lName" value="{{$person[0]['LNAME']}}" class="form-control" placeholder="กรอกนามสกุล" id="lName" placeholder="กรอกนามสกุล" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="dob">ว/ด/ปี(ค.ศ.) เกิด</label>
                                        <input type="date" name="dob" ref="dob" value="{{$person[0]['BIRTH']}}" class="form-control" id="dob" required="required">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <?php
                                            $defaultV = $person[0]['SEX'];
                                            $defaultText = $defaultV == 1 ? `ชาย` : `หญิง`;
                                        ?>
                                        <label for="sex">เพศ</label>
                                        <select class="form-control" name="sex" ref="sex" id="sex" :disabled="true">
                                            <option :value="updatePerson.sex == ''? {{$person[0]['SEX']}} : updatePerson.sex">@{{txtSex}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="mStatus">สถานภาพสมรส</label>
                                        <select class="form-control" name="mStatus" ref="mStatus" id="mStatus" required="required">
                                            <option v-for="m in allCode.mStatus" :value="m.mapmstatus" :selected="`{{$person[0]['MSTATUS']}}` == m.mapmstatus?true:false">@{{m.mapmstatus}}-@{{m.mstatusname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="education">การศึกษา</label>
                                        <select class="form-control" name="education" ref="education" id="education" required="required">
                                            <option v-for="c in allCode.education" :value="c.mapeducation" :selected="`{{$person[0]['EDUCATION']}}` == c.mapeducation?true:false">@{{c.mapeducation}}-@{{c.educationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="occupation">อาชีพ</label>
                                        <select class="form-control" name="occupation" ref="occupation" id="occupation" required="required">
                                            <option v-for="o in allCode.occupation" :value="o.mapoccupation" :selected="`{{$person[0]['OCCUPATION']}}` == o.mapoccupation?true:false">@{{o.mapoccupation}}-@{{o.occupationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="religion">ศาสนา</label>
                                        <select class="form-control" name="religion" ref="religion" id="religion" required="required">
                                            <option v-for="o in allCode.religion" :value="o.mapreligion" :selected="`{{$person[0]['RELIGION']}}` == o.mapreligion?true:false">@{{o.mapreligion}}-@{{o.religionname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="race">เชื้อชาติ</label>
                                        <select class="form-control" name="race" ref="race" id="race" required="required">
                                            <option v-for="b in allCode.nation" :value="b.mapnation" :selected="`{{$person[0]['RACE']}}` == b.mapnation?true:false">@{{b.mapnation}}-@{{b.nationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="nation">สัญชาติ</label>
                                        <select class="form-control" name="nation" ref="nation" id="nation" required="required">
                                            <option v-for="o in allCode.nation" :value="o.mapnation" :selected="`{{$person[0]['NATION']}}` == o.mapnation?true:false">@{{o.mapnation}}-@{{o.nationname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="fStatus">สถานะในครอบครัว</label>
                                        <select class="form-control" name="fStatus" ref="fStatus" id="fStatus" required="required">
                                            <option v-for="o in allCode.fstatus" :value="o.mapfstatus" :selected="`{{$person[0]['FSTATUS']}}` == o.mapfstatus?true:false">@{{o.mapfstatus}}-@{{o.fstatusname}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="typearea">สถานะบุคคล</label>
                                        <select class="form-control" name="typearea" ref="typearea" id="typearea" required="required">
                                            <option v-for="o in allCode.typearea" :value="o.maptypearea" :selected="{{$person[0]['TYPEAREA'] }} == o.maptypearea?true:false">@{{o.maptypearea}}-@{{o.typeareaname}}</option>
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
                                        <div class="col-sm-2">
                                            <input type="checkbox" v-model="updatePerson.{{$key}}" name="{{$key}}"> &nbsp&nbsp {{++$i}} ){{$value}}
                                        </div>
                                        @endforeach
                                        <div v-if="updatePerson.othersHos" class="form-inline col-sm-4">
                                            <input class="form-control" type="text" value="{{$service[0]['Q1_OTHERS']}}" ref="othersTextHos" name="othersTextHos" placeholder="โปรดระบุ...">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <h5><b>- ค่าใช้จ่ายในการรักษาพยาบาล</b></h5>
                                        <?php
                                            $ill_cost = ['ss'=>'ประกันสังคม', 'sh'=>'ประกันสุขภาพ', 'selfCost'=>'จ่ายเอง(จ่ายครบ)', 'free'=>'ฟรี', 'half'=>'จ่ายบางส่วน', 'othersCost'=>'อื่นๆ'];
                                            $i = 0;
                                        ?>
                                        @foreach($ill_cost as $key=>$value)
                                        <div class="col-sm-2">
                                            <input type="checkbox" v-model="updatePerson.{{$key}}" name="{{$key}}"> &nbsp&nbsp {{++$i}} ){{$value}}
                                        </div>
                                        @endforeach
                                        <div v-if="updatePerson.othersCost" class="form-inline col-sm-4">
                                            <input class="form-control" type="text" value="{{$service[0]['Q2_OTHERS']}}" ref="othersTextCost" name="othersTextCost" placeholder="โปรดระบุ...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end service tabs  -->
                        </div>
                        <hr/>

                        <div class="alert alert-success" transition="success" style="text-align: center" v-if="success">บันทึกข้อมูลแล้ว</div>

                        <div style="text-align:center">
                            <button type="submit" class="btn btn-success" :disabled="updateBtn"><i class="fa fa-save fa-lg"></i>&nbsp&nbsp บันทึกข้อมูล</button>
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
  <script>
    var homeData = {!! json_encode($home[0]['TAMBON']) !!}
    var q11Data = {!! json_encode($service[0]['Q1_1'] == '1' ? true : false) !!}
    var q12Data = {!! json_encode($service[0]['Q1_2'] == '1' ? true : false) !!}
    var q13Data = {!! json_encode($service[0]['Q1_3'] == '1' ? true : false) !!}
    var q14Data = {!! json_encode($service[0]['Q1_4'] == '1' ? true : false) !!}
    var q15Data = {!! json_encode($service[0]['Q1_5'] == '1' ? true : false) !!}
    var q1OthersText = {!! json_encode($service[0]['Q1_OTHERS']) !!}

    var q21Data = {!! json_encode($service[0]['Q2_1'] == '1' ? true : false) !!}
    var q22Data = {!! json_encode($service[0]['Q2_2'] == '1' ? true : false) !!}
    var q23Data = {!! json_encode($service[0]['Q2_3'] == '1' ? true : false) !!}
    var q24Data = {!! json_encode($service[0]['Q2_4'] == '1' ? true : false) !!}
    var q25Data = {!! json_encode($service[0]['Q2_5'] == '1' ? true : false) !!}
    var q26Data = {!! json_encode($service[0]['Q2_6'] == '1' ? true : false) !!}
    var q2OthersText = {!! json_encode($service[0]['Q2_OTHERS']) !!}
  </script>
  <script src="{{asset('/js/update-form.js')}}"></script>
@endpush
