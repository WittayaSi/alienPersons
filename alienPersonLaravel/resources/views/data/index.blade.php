@extends('layouts.app')

@section('content')
<div class="container">
    <div id="vueApp">
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading" style="text-align:center">
                    <h4><i class="fa fa-users"></i>&nbsp&nbsp ข้อมูลประชากร</h4>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                      <a href="{{url('/data/create')}}">
                          <li class="list-group-item"><i class="fa fa-user-plus fa-lg"></i>&nbsp&nbsp เพิ่มข้อมูล</li>
                      </a>
                      <a href="{{url('/data/search')}}">
                        <li class="list-group-item"><i class="fa fa-search fa-lg"></i>&nbsp&nbsp ค้นหาข้อมูลบุคคล</li>
                      </a>
                      <a href="{{url('/data/allPerson')}}">
                          <li class="list-group-item"><i class="fa fa-users fa-lg"></i>&nbsp&nbsp ข้อมูลทั้งหมด</li>
                      </a>
                    </ul>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
@endsection
