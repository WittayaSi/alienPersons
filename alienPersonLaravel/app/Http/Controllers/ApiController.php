<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Person;

class ApiController extends Controller
{
  public function getPersonByFullName(Request $request)
  {
    $fname = $request['fName'];
    $lname = $request['lName'];
    if($fname == null & $lname == null){
        $person = 0;
        return $person;
    }else{
        $person = DB::table('persons')->leftJoin('cnations','cnations.mapnation','=','persons.nation')
        ->where('name', 'like', '%' . $fname . '%')
        ->where('lname', 'like', '%' . $lname . '%')
        ->limit(20)
        ->orderBy('hospcode', 'ASC')
        ->orderBy('pid', 'ASC')
        ->get();
        return $person;
    }
  }

  public function getPersonById(Request $request)
  {
    $hid = $request->getContent();
    $person = DB::table('persons as p')->leftJoin('cnations as c', 'c.mapnation', '=', 'p.nation')
    ->where('p.hospcode', '=', $hid)
    ->orderBy('pid', 'ASC')
    ->get();
    return $person;
  }

  public function allPerson(Request $req){
    $datas = DB::table('persons')
    ->select('persons.*','cnations.*','homes.houseno','homes.moo')
    ->leftJoin('cnations','cnations.mapnation','=','persons.nation')
    ->leftJoin('homes', DB::raw('CONCAT(homes.hospcode,homes.hid)'),'=',DB::raw('CONCAT(persons.hospcode,persons.hid)'))
    ->orderBy('hospcode', 'ASC')
    ->orderBy('pid', 'ASC')
    ->paginate(10);
    $res = [
      'pagination' => [
          'total' => $datas->total(),
          'per_page' => $datas->perPage(),
          'current_page' => $datas->currentPage(),
          'last_page' => $datas->lastPage(),
          'from' => $datas->firstItem(),
          'to' => $datas->lastItem()
      ],
      'rawData' => $datas
    ];
    return response()->json($res);
  }

  public function allUsers(Request $req){
    $datas = DB::table('users')->latest()->paginate(10);
    $res = [
      'pagination' => [
          'total' => $datas->total(),
          'per_page' => $datas->perPage(),
          'current_page' => $datas->currentPage(),
          'last_page' => $datas->lastPage(),
          'from' => $datas->firstItem(),
          'to' => $datas->lastItem()
      ],
      'rawData' => $datas
    ];
    return response()->json($res);
  }

  public function getAddresses(Request $req){
    $hid = $req->getContent();
    //var_dump($hid);
    //die();
    $datas = DB::table('homes')->where('TAMBON', $hid)->get();
    //var_dump($datas);
    //die();
    return $datas;
  }

}
