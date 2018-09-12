@extends('layouts.app')

@section('content')
<div class="row"><!-- row begins -->
<div id="mainleft" class="col"><!-- left column begins -->
 <p> </p>
 <h4>Hello!</h4>
 <p>Have you ever been frustrated by the magic of technology?</p>
 <p>I can help!</p>
</div><!-- left column ends -->
<div id="maincntr" class="col-8"><!-- center column -->
 <img src="wizard-headshot-6-275x255.png" alt="wizard-headshot" class="headshot" />
 <p> </p>
 <h3 class="text-center">Gerald B. "<b>The Wizard</b>" Hammack</h3>
 <ul class="list-group">
  <li class="list-group-item list-group-item-primary">Software Development</li>
  <li class="list-group-item list-group-item-primary">Database Administration and Development</li>
  <li class="list-group-item list-group-item-primary">Business Analysis/Management</li>
  <li class="list-group-item list-group-item-primary">System Administration (Installation/Configuration/Performance)</li>
 </ul>

 <!-- Force this below the picture -->
 <p style="clear: both;"> </p>

 <ul class="list-group">
  <li class="list-group-item list-group-item-success">Linux, Bare Metal and/or Cloud based architectures</li>
  <li class="list-group-item list-group-item-success">PHP/Laravel</li>
  <li class="list-group-item list-group-item-success">PostgreSQL</li>
  <li class="list-group-item list-group-item-success">iSeries/AS400 RPG, System Administration (Configuration/Performance)</li>
  <li class="list-group-item list-group-item-success">Network Engineering (Firewalls/Routers/Switches)</li>
  <li class="list-group-item list-group-item-success">Voice over IP Administration (Configuration/Installation/Management)</li>
  <li class="list-group-item list-group-item-success">Asterisk</li>
  <li class="list-group-item list-group-item-success">Kamailio (SIP Servers/Services)</li>
 </ul>
 <p style="clear: both;"> </p>
</div>

<div id="mainrght" class="col"><!-- right column begins -->
 <p> </p>
 <div class="donate" id="donate">
  <h4>Has the Wizard been helpful?</h4>
  <p>Please, help feed the Wizard!</p>
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="donate">
   <div class="btn btn-outline-success">
    <fieldset>
     <input type="hidden" name="bn"               value="Wizard_Technical_Services">
     <input type="hidden" name="business"         value="wizard171@gmail.com">
     <input type="hidden" name="cmd"              value="_s-xclick" />
     <input type="hidden" name="currency_code"    value="USD">
     <input type="hidden" name="hosted_button_id" value="EJKQHSTY9BUWG">
     <input type="hidden" name="item_name"        value="Feed the Wizard!">
     <input type="hidden" name="lc"               value="US">
     <input type="hidden" name="return"           value="">
     <input type="hidden" name="tax"              value="0">
     <input type="image" src="btn_donate.gif" name="submit" alt="PayPal - The safer, easier way to pay online." />
    </fieldset>
   </div>
  </form>
 </div>
</div><!-- right column ends -->
</div><!-- row ends -->
@endsection('content')
