<?php

namespace App;

use Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  // prefer guarded to fillable, for now though, let me assign what I want
  protected $guarded = [];


  // ---------------------------------------------------------------------------
  // Archives
  // ---------------------------------------------------------------------------

  // archives
  //   select
  //     to_char(created_at, 'YYYY') as year
  //    ,to_char(created_at, 'Mon')  as month
  //    ,count(*) as records
  //  from articles
  //  group by
  //    to_char(created_at, 'YYYY')
  //   ,to_char(created_at, 'Mon')
  //  order by
  //    to_char(created_at, 'YYYY')
  //   ,to_char(created_at, 'Mon')
  //  ;
  public static function archives()
  {
    switch(true)
    {
    // method: mysql
    case (env('DB_CONNECTION') == 'mysql'):
      $select  = 'year (created_at) as year, month(created_at) month, count(*) records';
      $groupby = 'year, month';
      $orderby = 'year desc, month desc';
      break;

    // method: postgres
    case (env('DB_CONNECTION') == 'pgsql'):
      $select  = ' to_char(created_at, \'YYYY\') as year';
      $select .= ',to_char(created_at, \'MM\')  as month';
      $select .= ',count(*) as records';

      $groupby  = ' to_char(created_at, \'YYYY\')';
      $groupby .= ',to_char(created_at, \'MM\')';

      $orderby  = ' to_char(created_at, \'YYYY\') desc';
      $orderby .= ',to_char(created_at, \'MM\') desc';
      break;
    }

    return static::selectraw($select)
      ->groupby(DB::raw($groupby))
      ->orderbyraw($orderby)
      ->get()
      ->toarray();
  }

  // ---------------------------------------------------------------------------
  // QueryScopes
  // ---------------------------------------------------------------------------

  public function scopewecansee($query)
  {
    // if we are NOT logged in, we can see all articles
    if (! auth()->check() )          { return; }

    // unless the user isadmin (who can also see everything)
    if (  auth()->user()->isadmin )  { return; }
    
    // if we are     logged in, we can see only our own articles
    return $query->where('userid', '=', auth()->user()->id);
  }


  // ---------------------------------------------------------------------------
  // Relationships
  // ---------------------------------------------------------------------------

  // $article->userid == $user->id
  public function user()
  {
    return $this->belongsto('App\User', 'userid');
  }
}
