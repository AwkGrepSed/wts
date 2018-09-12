<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    // this returns everything, respecting $hidden in the model
    return parent::toArray($request);

    // limit the returned array to just these fields
    //return [
    //  'id'  => $this->id,
    //  'title' => $this->title,
    //  'body'  => $this->body
    //];
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
