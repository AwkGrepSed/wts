<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // would you prefer using the factory?
    // factory(App\ContactFactory::class, 30)->create();
  
    // (sigh)  you want contacts?  Have I got some yahoo's for you!
    for ($i = 1; $i <= 90; $i++)
    {
    $contact = new Contact;
    $contact->handled   = false;
    $contact->company   = 'Company '.$i;
    $contact->person    = 'Person '.$i;
    $contact->email     = 'contact'.$i.'@yahoo.com';
    $contact->phone     = '512-555-99'.sprintf("%02d",$i);
    $contact->message   = "Yes!  I really want to buy stuff!";
    if ($i %6 == 0)     { $contact->handled = true; }
    $contact->save();
    }
  }
}
