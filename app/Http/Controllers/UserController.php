<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\User;
use App\Http\Resources\UserResource;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->is('api/*'))
    {
      $users = User::orderby('id')->paginate(14);
      return UserResource::collection($users); 
    }

    $search = [
      'email'   => $request->input('email'   , ''),
      'name'    => $request->input('name'    , ''),
    ];

    $users = User::wecansee()
      ->where('email' , 'ilike', '%'.$search['email'].'%')
      ->where('name'  , 'ilike', '%'.$search['name'].'%')
      ->orderBy('email')->paginate(14);

    return view('user.index')
      ->with([
        'users'   => $users,
        'search'  => $search
        ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('user.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'name'      => 'required',
      'email'     => 'required|email',
      'password'  => 'required|confirmed',
      ]);

    $user = new User;
    $user->name      = $request->input('name');
    $user->email     = $request->input('email');
    $user->password  = Hash::make($user->password);
    $user->api_token = $user->gennewapitoken();
    $user->save();

    \Mail::to($user)->send(new Welcome($user));

    if ($request->is('api/*'))
    {
      return new UserResource($user);
    }
    return redirect('/user')->with('success', 'UserID '.$user->id.' Saved');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function show($id, Request $request)
  {
    $user  = User::findorfail($id);

    if ($request->is('api/*'))
    {
      return new UserResource($user); 
    }
    return view('user.show')->with('user', $user);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user  = User::find($id);
    return view('user.edit')->with('user', $user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update($id, Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      ]);

    $user = User::findorfail($id);
    $user->name      = $request->input('name');
    $user->email     = $request->input('email');
    $user->save();

    if ($request->is('api/*'))
    {   
      return new UserResource($user);
    }
    return redirect('/user')->with('success', 'UserID '.$id.' Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function destroy($id, Request $request)
  {
    $user = User::find($id);
    $user->delete();

    if ($request->is('api/*'))
    {   
      return new UserResource($user);
    }
    return redirect('/user')->with('success', 'UserID '.$id.' Deleted');
  }
}
