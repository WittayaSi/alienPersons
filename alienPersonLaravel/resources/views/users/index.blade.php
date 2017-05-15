@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
          <div class="col-sm-12">
              <div class="panel panel-success">
                  <div class="panel-heading" style="text-align: center">
                        <p><h4>**ข้อมูล users**</h4><p>
                  </div>
                  <div class="panel-body">
                      <table class="table table-bordered table-hover">
                          <thead>
                              <tr>
                                  <th style="text-align: center">Name</th>
                                  <th style="text-align: center">Username</th>
                                  <!-- <th style="text-align: center">CID</th>
                                  <th style="text-align: center">HID</th> -->
                                  <th style="text-align: center">Email</th>
                                  <th style="text-align: center">Admin</th>
                                  <th style="text-align: center">Created</th>
                                  <th style="text-align: center">Updated</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="d in users">
                                  <td>@{{ d.name }}</td>
                                  <td>@{{ d.username }}</td>
                                  <!-- <td style="text-align: center">@{{ d.CID }}</td>
                                  <td style="text-align: center">@{{ d.HID }}</td> -->
                                  <td>@{{ d.email }}</td>
                                  <td style="text-align: center">@{{ d.admin }}</td>
                                  <td style="text-align: center">@{{ d.created_at }}</td>
                                  <td style="text-align: center">@{{ d.updated_at }}</td>
                                  <td style="text-align: center">
                                      <div class="btn-group" role="group" aria-label="จัดการข้อมูล">
                                          <a :href="'/alienPerson/user/'+ d.id +'/edit'" type="button" class="btn btn-warning btn-xs">
                                              <i class="fa fa-pencil-square-o"></i>
                                          </a>
                                          <a @click="deleteRecord(d.id)" type="button" class="btn btn-danger btn-xs">
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
  <script src="{{asset('/js/users.js')}}"></script>
@endpush
