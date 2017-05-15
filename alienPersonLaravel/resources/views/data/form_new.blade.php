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
                    <!-- <form action="#" @submit.prevent="addEditPerson({{$method}},{{$id}})" method="{{$method}}"> -->
                    {!! Form::open(['@submit.prevent'=>'updatePerson()','method'=>'PUT']) !!}

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
                                    ข้อมูลที่อยู่
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- person tabs  -->
                            <div id="person" class="tab-pane fade in active">
                                <h4 style="text-align: center">**ข้อมูลบุคคล**</h4><hr/>
                                <div class="row">
                                    <div class="form-group col-sm-2">
                                        <!-- <label for="preName">คำนำหน้าชื่อ</label> -->
                                        <?php
                                            $list = App\Cprename::select('id_prename', DB::raw("concat(id_prename,'-',prename) as id_name"))->get()->pluck('id_name', 'id_prename')->toArray();
                                            $selected = '002';
                                            //echo $list;
                                        ?>
                                        {!!Form::label('preName', 'คำนำหน้าชื่อ')!!}
                                        {!!Form::select('preName',array_merge([''=>'เลือกคำนำหน้าชื่อ'],$list), null,['class'=>'form-control','id'=>'preName','required'=>'required','v-model'=>'newPerson.preName'])!!}
                                    </div>
                            </div>
                            <!-- end home tabs  -->
                        </div>
                        <hr/>

                        <div class="alert alert-success" transition="success" style="text-align: center" v-if="success">เพิ่ม " @{{newPerson.fName}} @{{newPerson.lName}} " สำเร็จแล้ว</div>

                        <div style="text-align:center">
                            <button :disabled="!isValid" type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                            <button type="reset" class="btn btn-danger">ล้างข้อมูล</button>
                        </div>

                    {!! Form::close() !!}

                    <!-- </form> -->
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
  <script src="/js/create-form.js"></script>
@endpush
