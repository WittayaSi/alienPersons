@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 style="text-align: center">** แก้ไขข้อมูลผู้ใช้ ** </h4>
                </div>
                <div class="panel-body">
                    <form action="#" @submit.prevent="updateUser(`{{$user[0]['id']}}`)" >
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#person">
                                    <i class="fa fa-user"></i>
                                    ข้อมูลผู้ใช้
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- person tabs  -->
                            <div id="person" class="tab-pane fade in active">
                                <h4 style="text-align: center">**ข้อมูลผู้ใช้**</h4><hr/>
                                <div class="row">
                                    <div class="form-group col-sm-2">
                                        <label for="name">ชื่อ-สกุล</label>
                                        <input type="text" name="name" ref="name" value="{{$user[0]['name']}}" class="form-control" placeholder="Name" id="name" required="required">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" ref="username" value="{{$user[0]['username']}}" class="form-control" placeholder="Username" id="username" required="required">
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" ref="email" value="{{$user[0]['email']}}" class="form-control" placeholder="Email" id="email" placeholder="email" required="required">
                                    </div>
                                </div>
                            </div>
                            <!-- end person tabs  -->
                        </div>
                        <hr/>

                        <div class="alert alert-success" transition="success" style="text-align: center" v-if="success">บันทึกข้อมูลแล้ว</div>

                        <div style="text-align:center">
                            <button type="submit" class="btn btn-success" :disabled="updateBt">บันทึกข้อมูล</button>
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
  <script src="{{asset('/js/user-update-form.js')}}"></script>
@endpush
