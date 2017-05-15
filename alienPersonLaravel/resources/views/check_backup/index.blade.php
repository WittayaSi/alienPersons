@extends('layouts.app')

@section('content')

<div class="container">
    <div id="vueApp">
      <div class="row">
          <div class="col-sm-12">
              <div class="panel panel-success">
                  <div class="panel-heading" style="text-align: center">
                        <p><h4>**check backup ปี 2560**</h4><p>
                  </div>
                  <div class="panel-body">
                      <table class="table table-bordered table-hover responsive">
                          <thead>
                              <tr class="success">
                                  <th style="text-align: center">รหัสสถานบริการ</th>
                                  <!-- <th style="text-align: center">ต.ค</th>
                                  <th style="text-align: center">พ.ย.</th>
                                  <th style="text-align: center">ธ.ค.</th> -->
                                  <th style="text-align: center">ม.ค.</th>
                                  <th style="text-align: center">ก.พ.</th>
                                  <th style="text-align: center">มี.ค.</th>
                                  <th style="text-align: center">เม.ย.(ปดว)</th>
                                  <!-- <th style="text-align: center"></th> -->
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($hospcode as $key=>$h)
                              <?php
                                $countFiles4 = count(scandir($fold_name4.'\\'.$h->fname));
                                $countFiles3 = count(scandir($fold_name3.'\\'.$h->fname));
                                $countFiles2 = count(scandir($fold_name2.'\\'.$h->fname));
                                $countFiles1 = count(scandir($fold_name1.'\\'.$h->fname));

                                $fileName = max(scandir($fold_name4.'\\'.$h->fname));
                                $d = explode(' ', $fileName);

                                $check4 = $countFiles4 <= 2 ? false : true;
                                $check3 = $countFiles3 <= 2 ? false : true;
                                $check2 = $countFiles2 <= 2 ? false : true;
                                $check1 = $countFiles1 <= 2 ? false : true;
                                $status = $check4 & $check3 & $check2 & $check1;
                              ?>
                              <tr class="{{$status ? 'success' : ''}}">
                                  <td>{{$h->hoscode}} - {{$h->hosname}}</td>
                                  <!-- <td style="text-align: center"></td>
                                  <td style="text-align: center"></td>
                                  <td style="text-align: center"></td> -->
                                  <td class="{{ $check1 ? 'success' : 'danger'}}" style="text-align: center"><i class="fa {{ $check1 ? 'fa-check' : 'fa-times'}}"></i></td>
                                  <td class="{{ $check2 ? 'success' : 'danger'}}" style="text-align: center"><i class="fa {{ $check2 ? 'fa-check' : 'fa-times'}}"></i></td>
                                  <td class="{{ $check3 ? 'success' : 'danger'}}" style="text-align: center"><i class="fa {{ $check3 ? 'fa-check' : 'fa-times'}}"></i></td>
                                  <td class="{{ $check4 ? 'success' : 'danger'}}" style="text-align: center"><i class="fa {{ $check4 ? 'fa-check' : 'fa-times'}}"></i>{{ $check4 ? '( '.$d[1].' )' : '( - )'}}</td>
                                  <!-- <td style="text-align: center">
                                      <div class="btn-group" role="group" aria-label="จัดการข้อมูล">
                                          <a :href="'/alienPerson/data/'+ d.ID +'/edit'" type="button" class="btn btn-warning btn-xs">
                                              <i class="fa fa-pencil-square-o"></i>
                                          </a>
                                          <a @click="deleteRecord(d.ID)" type="button" class="btn btn-danger btn-xs">
                                              <i class="fa fa-trash"></i>
                                          </a>
                                      </div>
                                  </td> -->
                              </tr>
                              @endforeach
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
  <!-- <script src="{{asset('/js/all-person.js')}}"></script> -->
@endpush
