@extends('layouts.app')

@section('content')
<div class="container">
    <div id ="vueApp">
      <div class="row">
          <div class="col-sm-12">
              <div class="panel panel-success">
                  <div class="panel-heading" style="text-align: center">
                        <p><h4>**ข้อมูลบุคคลทั้งหมด**</h4><p>
                  </div>
                  <div class="panel-body">
                      <table class="table table-bordered table-hover responsive">
                          <thead>
                              <tr>
                                  <th style="text-align: center" id="thfixed">รหัสสถานบริการ</th>
                                  <th style="text-align: center">PID</th>
                                  <!-- <th style="text-align: center">CID</th>
                                  <th style="text-align: center">HID</th> -->
                                  <th style="text-align: center">ชื่อ - สกุล</th>
                                  <th style="text-align: center">เพศ</th>
                                  <th style="text-align: center">ว/ด/ปี เกิด</th>
                                  <th style="text-align: center">สัญชาติ</th>
                                  <th style="text-align: center">TYPE AREA</th>
                                  <th style="text-align: center">ที่อยู่</th>
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
                                  <td style="text-align: center">@{{ d.houseno }} หมู่ @{{ d.moo }}</td>
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
                      <!-- Pagination -->
                  		<nav class="pull-right">
                  	        <ul class="pagination">
                  	            <li v-if="pagination.current_page > 1">
                  	                <a href="#" aria-label="Previous"
                  	                   @click.prevent="changePage(pagination.current_page - 1)">
                  	                    <span aria-hidden="true">«</span>
                  	                </a>
                  	            </li>
                  	            <li v-for="page in pagesNumber"
                  	                v-bind:class="[ page == isActived ? 'active' : '']">
                  	                <a href="#"
                  	                   @click.prevent="changePage(page)">@{{ page }}</a>
                  	            </li>
                  	            <li v-if="pagination.current_page < pagination.last_page">
                  	                <a href="#" aria-label="Next"
                  	                   @click.prevent="changePage(pagination.current_page + 1)">
                  	                    <span aria-hidden="true">»</span>
                  	                </a>
                  	            </li>
                  	        </ul>
                  	    </nav>

                  </div>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
  <script src="{{asset('/js/all-person.js')}}"></script>
@endpush
