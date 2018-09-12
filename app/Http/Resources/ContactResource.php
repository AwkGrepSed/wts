<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    // this returns everything, respecting $hidden in the model
    return parent::toArray($request);
  }

  /**
   * Provide additional details with returned resources
   * 
   * @param \Illuminate\Http\Request $request
   * @return array
   */
  public function with($request) {
    return [
      'version'  => '1.0.0',
      'author_url'  => url('https://wiztechsvcs.com')
    ];
  }
}
