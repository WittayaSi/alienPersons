<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Home;
use App\ServiceQ;
use Illuminate\Support\Facades\DB;
use Collective\Html\Eloquent\FormAccessible;

class DataController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('data/create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addHome(Request $request)
    {
      $checkNull  = Home::where('hospcode','=',$request['hospital'])->count();
      $oldHid = $checkNull == 0 ? 0 : DB::table('homes')->where('hospcode','=',$request['hospital'])->max('hid');
      $newHid = $oldHid + 1;

      $home = new Home();
      $home->hospcode = $request['hospital'];
      $home->hid = $newHid ;
      $home->osm = $request['osm'];
      $home->ost = $request['ost'];
      $home->houseno = $request['address'];
      $home->moo = $request['moo'];
      $home->villname = $request['village'];
      $home->tambon = $request['tambon'];
      $home->ampur = $request['amphor'];
      $home->changwat = $request['changwat'];
      $home->vstatus = $request['vstatus'];

      if($home->save()){
          return 1;
      }else{
          return 0;
      }
    }


    public function store(Request $request)
    {
        //
        $checkNull  = Person::where('hospcode','=', substr($request['sAddresses'], 0, 5))->count();
        $oldId = $checkNull == 0 ? 0 : DB::table('persons')->where('hospcode', '=', substr($request['sAddresses'], 0, 5))->max('pid');
        $newId = $oldId + 1;

        // $dob = date("Y-m-d", strtotime($request['dob'] . " -543 years"));

        $person = new Person();

        $service = new ServiceQ();
        $person->hospcode = substr($request['sAddresses'], 0, 5);
        $person->hid = substr($request['sAddresses'], 5, 1);
        $person->pid = $newId;
        $person->prename = $request['preName'];
        $person->name = $request['fName'];
        $person->lname = $request['lName'];
        $person->sex = $request['sex'];
        $person->birth = $request['dob'];
        $person->mstatus = $request['mStatus'];
        $person->education = $request['education'];
        $person->occupation = $request['occupation'];
        $person->race = $request['race'];
        $person->nation = $request['nation'];
        $person->religion = $request['religion'];
        $person->fstatus = $request['fStatus'];
        $person->typearea = $request['typearea'];

        $service->hospcode = substr($request['sAddresses'], 0, 5);
        $service->pid = $newId;
        $service->q1_1 = $request['hosp'] ? '1' : '0';
        $service->q1_2 = $request['anamia'] ? '1' : '0';
        $service->q1_3 = $request['clinic'] ? '1' : '0';
        $service->q1_4 = $request['self'] ? '1' : '0';
        $service->q1_5 = $request['othersHos'] ? '1' : '0';
        $service->q1_others = $request['othersHos'] ? $request['othersTextHos'] : '';
        $service->q2_1 = $request['ss'] ? '1' : '0';
        $service->q2_2 = $request['sh'] ? '1' : '0';
        $service->q2_3 = $request['selfCost'] ? '1' : '0';
        $service->q2_4 = $request['free'] ? '1' : '0';
        $service->q2_5 = $request['half'] ? '1' : '0';
        $service->q2_6 = $request['othersCost'] ? '1' : '0';
        $service->q2_others = $request['othersCost'] ? $request['othersTextCost'] : '';


        if($person->save() && $service->save()){
            return 1;
        }else{
            return 0;
        }
    }

    public function search()
    {
        return view('data/search');
    }

    public function allPerson()
    {
        //
        return view('data/all_person');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['person'] = Person::where('ID', '=', $id)->get();

        $hos_hid = DB::table('persons')->select('hospcode', 'hid','pid')->where('ID', '=', $id)->get();
        $cHosHid = $hos_hid[0]->hospcode . $hos_hid[0]->hid;
        $cHosPid = $hos_hid[0]->hospcode . $hos_hid[0]->pid;

        $data['home'] = Home::where(DB::raw('CONCAT(hospcode,hid)'), '=', $cHosHid)->get();

        $data['service'] = ServiceQ::where(DB::raw('CONCAT(hospcode,pid)'), '=', $cHosPid)->get();
        //var_dump($data['service']);
        //die();

        return view('data/update_form', $data);
    }

    public function updateHome(Request $request, $id)
    {
      //var_dump($id);
      //die();
      $home_id = Home::select('id')->where(DB::raw('CONCAT(hospcode,hid)'), '=', $id)->get();
      $home = Home::find($home_id);

      $home->HOSPCODE = $request['hospital'];
      $home->OSM = $request['osm'];
      $home->OST = $request['ost'];
      $home->HOUSENO = $request['address'];
      $home->MOO = $request['moo'];
      $home->VILLNAME = $request['village'];
      $home->TAMBON = $request['tambon'];
      $home->AMPUR = $request['amphor'];
      $home->CHANGWAT = $request['changwat'];
      $home->VSTATUS = $request['vstatus'];
      if($home->save()){
          return 1;
      }else{
          return 0;
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $dob = date("Y-m-d", strtotime($request['dob'] . " -543 years"));
        $person = Person::find($id);
        $service = ServiceQ::find($id);

        //return ($person);
        $person->HOSPCODE = substr($request['sAddresses'], 0, 5);
        $person->HID = substr($request['sAddresses'], 5, 1);
        $person->PRENAME = $request['preName'];
        $person->NAME = $request['fName'];
        $person->LNAME = $request['lName'];
        $person->SEX = $request['sex'];
        $person->BIRTH = $request['dob'];
        $person->MSTATUS = $request['mStatus'];
        $person->EDUCATION = $request['education'];
        $person->OCCUPATION = $request['occupation'];
        $person->RACE = $request['race'];
        $person->NATION = $request['nation'];
        $person->RELIGION = $request['religion'];
        $person->FSTATUS = $request['fStatus'];
        $person->TYPEAREA = $request['typearea'];

        $service->HOSPCODE = $person->HOSPCODE = substr($request['sAddresses'], 0, 5);
        $service->q1_1 = $request['hosp'] ? '1' : '0';
        $service->q1_2 = $request['anamia'] ? '1' : '0';
        $service->q1_3 = $request['clinic'] ? '1' : '0';
        $service->q1_4 = $request['self'] ? '1' : '0';
        $service->q1_5= $request['othersHos'] ? '1' : '0';
        $service->q1_others = $request['othersHos'] ? $request['othersTextHos'] : '';

        $service->q2_1 = $request['ss'] ? '1' : '0';
        $service->q2_2 = $request['sh'] ? '1' : '0';
        $service->q2_3 = $request['selfCost'] ? '1' : '0';
        $service->q2_4 = $request['free'] ? '1' : '0';
        $service->q2_5 = $request['half'] ? '1' : '0';
        $service->q2_6 = $request['othersCost'] ? '1' : '0';
        $service->q2_others = $request['othersCost'] ? $request['othersTextCost'] : '';

        if($person->save() & $service->save()){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Person::destroy($id);
    }
}
