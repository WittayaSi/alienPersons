@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
          <div class="col-sm-12">
              <div class="panel panel-success">
                  <div class="panel-heading" style="text-align: center">
                        <p><h4>**ค้นหาข้อมูลบุคคล**</h4><p>
                  </div>
                  <div class="panel-body">
                      <div class="row">
                          <p style="text-align: center">
                              <input type="radio" v-model="option" value="b"> สถานบริการ &nbsp&nbsp
                              <input type="radio" v-model="option" value="a"> ชื่อ - นามสกุล
                          </p>
                          <p v-if="option === 'b'" class="col-sm-4 col-sm-offset-4">
                              <label for="hoscode">สถานบริการ</label>
                              <select class="form-control" name="hoscode" v-model="hoscode" id="hoscode" @change="getPersonById">
                                  <option value="">
                                      เลือกสถานบริการ
                                  </option>
                                  <option v-for="h in hospital" :value="h.hoscode">@{{h.hoscode}}-@{{h.hosname}}</option>
                              </select>
                          </p>
                          <div v-if="option === 'a'" class="row">
                              <div class="form-group col-sm-4 col-sm-offset-2">
                                  <label for="txtName">ชื่อ</label>
                                  <input type="text" id="txtName" class="form-control" v-model="txtName" @keyup="getPersonByName" :autofocus="true"/>
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="txtLastName">นามสกุล</label>
                                  <input type="text" id="txtLastName" class="form-control" v-model="txtLastName" @keyup="getPersonByLastName"/>
                              </div>
                          </div>
                      </div>
                      <hr/>
                      <table v-show="persons != 0" class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th style="text-align: center">รหัสสถานบริการ</th>
                                  <th style="text-align: center">PID</th>
                                  <!-- <th style="text-align: center">CID</th>
                                  <th style="text-align: center">HID</th> -->
                                  <th style="text-align: center">ชื่อ - สกุล</th>
                                  <th style="text-align: center">เพศ</th>
                                  <th style="text-align: center">ว/ด/ปี เกิด</th>
                                  <th style="text-align: center">สัญชาติ</th>
                                  <th style="text-align: center">TYPE AREA</th>
                                  <th style="text-align: center">จัดการข้อมูล</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="d in persons">
                                  <td style="text-align: center">@{{ d.HOSPCODE }}</td>
                                  <td style="text-align: center">@{{ d.PID }}</td>
                                  <!-- <td style="text-align: center">@{{ d.CID }}</td>
                                  <td style="text-align: center">@{{ d.HID }}</td> -->
                                  <td>@{{ d.PRENAME |getPrename }}@{{ d.NAME }}
                                      @{{ d.LNAME }}</td>
                                  <td style="text-align: center">@{{ d.SEX == 1? 'ชาย' : 'หญิง' }}</td>
                                  <td style="text-align: center">@{{ d.BIRTH | getDate }}</td>
                                  <td style="text-align: center">@{{ d.nationname }}</td>
                                  <td style="text-align: center">@{{ d.TYPEAREA }}</td>
                                  <td style="text-align: center">
                                      <div class="btn-group" role="group" aria-label="จัดการข้อมูล">
                                          <a :href="'/alienPerson/data/'+ d.ID +'/edit'" type="button" class="btn btn-warning btn-xs">
                                              <i class="fa fa-pencil-square-o"></i>
                                          </a>
                                          <a @click="deleteRecord(d.ID)" type="button" class="btn btn-danger btn-xs">
                                              <i class="fa fa-trash"></i>
                                          </a>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
  <script src="{{asset('/js/search.js')}}"></script>
@endpush
