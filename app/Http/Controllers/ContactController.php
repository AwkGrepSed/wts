<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\SalesContact;
use Auth;

use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;

class ContactController extends Controller
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
      $contacts = Contact::orderby('id')->paginate(14);
      return ContactResource::collection($contacts);
    }

    $search = [
      'company' => $request->input('company' , ''),
      'person'  => $request->input('person'  , ''),
      'email'   => $request->input('email'   , ''),
      'phone'   => $request->input('phone'   , ''),
      'message' => $request->input('message' , ''),
    ];

    $orderby  = "updated_at asc, company";
    $contacts = Contact::
        where('company' , 'ilike', '%'.$search['company'].'%')
      ->where('person'  , 'ilike', '%'.$search['person'].'%')
      ->where('email'   , 'ilike', '%'.$search['email'].'%')
      ->where('phone'   , 'ilike', '%'.$search['phone'].'%')
      ->where('message' , 'ilike', '%'.$search['message'].'%')
      ->orderbyraw($orderby)
      ->paginate(14);

    return view('contact.index')
      ->with([
        'contacts' => $contacts,
        'search'   => $search
        ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('contact.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $isauth = Auth::check();

    $this->validate($request, [
      'email'   => 'required|email',
      'person'  => 'required',
      'message' => 'required',
      ]);

    $contact = new Contact;
    $contact->email   = $request->input('email'   , 'NoEmail');
    $contact->company = $request->input('company' , 'NoCompany');
    $contact->person  = $request->input('person'  , 'NoName');
    $contact->phone   = $request->input('phone'   , 'NoPhone');
    $contact->message = $request->input('message' , 'NoMessage');
    $contact->handled = $request->input('handled' , false);
    $contact->save();

    // send the sales notification email  (only when not authenticated)
    if ( ! $isauth )
    {
      \Mail::to(env('MAIL_CONTACTSTO'))->send(new SalesContact($contact));
    }
    
    // api?
    if ($request->is('api/*'))
    {
      return new ContactResource($contact);
    }

    // authenticated user?
    if ( $isauth )
    {
      return redirect('/contact')
        ->with('success', 'ContactID '.$contact->id.' Saved');
    } else {
      return redirect('/')
        ->with('success', 'Thanks for reaching out to us!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Contact  $contact
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function show(Contact $contact, Request $request)
  {
    if ($request->is('api/*'))
    {
      return new ContactResource($contact);
    }
    return view('contact.show')->with('contact', $contact);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function edit(Contact $contact)
  {
    return view('contact.edit')->with('contact', $contact);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Contact  $contact
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Contact $contact, Request $request)
  {
    $this->validate($request, [
      'email'   => 'required|email',
      'company' => 'required',
      'person'  => 'required',
      'message' => 'required',
      ]);

    $contact->email   = $request->input('email'   , 'NoEmail');
    $contact->company = $request->input('company' , 'NoCompany');
    $contact->person  = $request->input('person'  , 'NoName');
    $contact->message = $request->input('message' , 'NoMessage');
    $contact->handled = $request->input('handled' , false);
    $contact->save();

    if ($request->is('api/*'))
    {
      return new ContactResource($contact);
    }
    return redirect('/contact')->with('success', 'ContactID '.$contact->id.' Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Contact  $contact
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function destroy(Contact $contact, Request $request)
  {
    $contact->delete();

    if ($request->is('api/*'))
    {   
      return new ContactResource($contact);
    }
    return redirect('/contact')->with('success', 'ContactID '.$contact->id.' Deleted');
  }
}
