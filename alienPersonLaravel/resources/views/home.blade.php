@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 style="text-align: center">** สรุปข้อมูลประชากร ** </h4>
                </div>

                <?php

                    $datas = DB::select('select h.hoscode, h.hosname, a.hos_no from chospitals h left join (select p.hospcode, count(*) as hos_no from persons p group by p.hospcode)a on (h.hoscode = a.hospcode)');

                ?>

                <div class="panel-body">
                    <div class="row">
                        @foreach($datas as $key => $data)
                        <div class="col-md-3">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{$data->hos_no == null ? 0 : $data->hos_no}} <small> คน </small></h3>
                                    <p>รหัสสถานบริการ ({{$data->hoscode}})</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
