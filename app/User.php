<?php

namespace App;

use Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


//class User extends Authenticatable
class User extends Authenticatable
{
  use Notifiable;

  // ---------------------------------------------------------------------------
  // The attributes that are mass assignable.
  // 
  // @var array
  //
  protected $fillable = [
    'name', 'email', 'password',
  ];

  // ---------------------------------------------------------------------------
  // The attributes that should be hidden for arrays.
  //
  // @var array
  //
  protected $hidden = [
    'password','remember_token','api_token'
  ];


  // ---------------------------------------------------------------------------
  // api_token, as you can see is a hexadecimal value of a randomly
  // generated number of characters.  I chose 40, arbitrarily and
  // it generates a value 80 bytes in length, making it hard to guess
  // and possibly cryptographically insignificant.
  //
  // yes, I know, its not "jwt", "oauth2", yada, yada -- sue me
  public function gennewapitoken()
  {
    return bin2hex(openssl_random_pseudo_bytes(40));
  }


  // ---------------------------------------------------------------------------
  // generate a new password reset token
  // - delete any others which exist
  // - insert the new value, hashed
  // - return the token, unhashed for use on the form
  public static function genNewPassResetToken($user)
  {
    $token = str_random(60);
    \DB::table('password_resets')->where('email', $user->email)->delete();
    \DB::table('password_resets')->insert([
      'email' => $user->email,
      'token' => \Hash::make($token)
    ]);
    return $token;
  }


  // ---------------------------------------------------------------------------
  // QueryScopes
  // ---------------------------------------------------------------------------

  public function scopeisactive($query)
  {
    return $query->where('isactive', true);
  }

  public function scopeisadmin($query)
  {
    return $query->where('isadmin', true);
  }

  public function scopewecansee($query)
  { 
    // if we are NOT logged in, we should not see any users, eh?
    if (! auth()->check() )          { return; }

    // unless the user isadmin (who can see everyone)
    if (  auth()->user()->isadmin )  { return; }
    
    // if we are     logged in, not isadmin, we can see only our own user
    return $query->where('id', '=', auth()->user()->id);
  }


  // ---------------------------------------------------------------------------
  // Relationships
  // ---------------------------------------------------------------------------

  // $user->id == $article->userid
  public function articles()
  {
    return $this->hasmany('App\Article', 'userid');
  }
}
