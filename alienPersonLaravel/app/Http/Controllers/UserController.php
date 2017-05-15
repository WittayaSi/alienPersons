<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
      return view('users/index');
  }

  public function edit($id)
  {
      $data['user'] = User::where('id', '=', $id)->get();
      //var_dump($data['person']);
      return view('users/update_form', $data);
  }

  public function destroy($id)
  {
      //
      User::destroy($id);
  }
}
