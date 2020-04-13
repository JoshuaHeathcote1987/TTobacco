@extends('layouts.app') @section('title', 'Products') @section('content')

<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/my_stripe.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/stripe.css') }}">

<div class="container py-4">

   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/home">Home</a></li>
         <li class="breadcrumb-item active"><a href="/view-products">Products</a></li>
         <li class="breadcrumb-item active"><a href="/view-cart">Cart</a></li>
         <li class="breadcrumb-item active" aria-current="page">Checkout</li>
      </ol>
   </nav>

   @if (Session::has('success-message'))
   <div class="alert alert-success mb-5">
      {!! Session::get('success-message') !!}
   </div>
   @endif
   @if (Session::has('fail-message'))
   <div class="alert alert-warning mb-5">
      {!! Session::get('fail-message') !!}
   </div>
   @endif
   <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
         <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">{{ count($datas['carts']) }}</span>
         </h4>
         <ul class="list-group mb-3">
            <?php $total = 0; ?>
            @foreach($datas['carts'] as $data)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
               <div>
                  <h6 class="my-0">{{ $data->name }}</h6>
               </div>
               <span class="text-muted">&pound;{{ $data->price * $data->amount }}</span>
            </li>
            <?php $total += $data->price * $data->amount ?>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
               <span>Total</span>
               <strong>&pound;{{ $total }}</strong>
            </li>
         </ul>
      </div>
      <div class="col-md-8 order-md-1">
            <div class="form-group">
            

            @if($datas['input_id'] == 0)
            <label for="exampleFormControlSelect1">Select Shipping Address</label>
            <form action="/update-address" method="POST">
               @csrf
               <select onChange="this.form.submit()" name="select_address" class="form-control" id="exampleFormControlSelect1">
                  <option value="0">Add new shipping address</option>
                  @foreach ($datas['shippings'] as $item)
                     <option value="{{ $item->id }}">{{ $item->address .', '. $item->country .', '. $item->zip }}</option>
                  @endforeach
               </select>
               <hr/>
            </form>
            @endif

            
         </div>
         
         
         <form action="/user/payment/stripe" method="post" id="payment-form">
               {{ csrf_field() }}
         <h4 class="mb-3">Shipping address</h4>
         <div class="row">
            @if ($datas['input_id'] == 0)
               <input type="hidden" id="" name="my_shipping_address_id" value="0">
            @else
               <input type="hidden" id="" name="my_shipping_address_id" value="{{ $datas['my_shipping_address']->id }}">
            @endif
            
            <div class="col-md-6 mb-3">
               <label for="firstName">First name</label>
               @if ($datas['input_id'] == 0)
                  <input name="firstName" type="text" class="form-control" id="firstName" placeholder="" value="" maxlength="20" required>
               @else
                  <input name="firstName" type="text" class="form-control" id="firstName" placeholder="" value="{{ $datas['my_shipping_address']->first_name }}" maxlength="20" required>
               @endif
               
               <div class="invalid-feedback">
                  Valid first name is required.
               </div>
            </div>
            <div class="col-md-6 mb-3">
               <label for="lastName">Last name</label>
               @if ($datas['input_id'] == 0)
                  <input name="lastName" type="text" class="form-control" id="lastName" placeholder="" value="" maxlength="20" required>
               @else
                  <input name="lastName" type="text" class="form-control" id="lastName" placeholder="" value="{{ $datas['my_shipping_address']->last_name }}" maxlength="20" required>
               @endif
               <div class="invalid-feedback">
                  Valid last name is required.
               </div>
            </div>
         </div>
         <div class="mb-3">
            <label for="address">Address</label>
               @if ($datas['input_id'] == 0)
                  <input name="address" type="text" class="form-control" id="address" placeholder="" value="" maxlength="20" required>
               @else
                  <input name="address" type="text" class="form-control" id="address" placeholder="" value="{{ $datas['my_shipping_address']->address }}" maxlength="20" required>
               @endif
            <div class="invalid-feedback">
               Please enter your shipping address.
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 mb-3">
               <label for="address2">County</label>
               @if ($datas['input_id'] == 0)
                  <input name="address2" type="text" class="form-control" id="address2" placeholder="" value="" maxlength="60" required>
               @else
                  <input name="address2" type="text" class="form-control" id="address2" placeholder="" value="{{ $datas['my_shipping_address']->address_2 }}" maxlength="60" required>
               @endif
            </div>
            <div class="col-md-6 mb-3">
               <label for="county">City</label>
               @if ($datas['input_id'] == 0)
                  <input name="city" type="text" class="form-control" id="city" placeholder="" value="" maxlength="60" required>
               @else
                  <input name="city" type="text" class="form-control" id="city" placeholder="" value="{{ $datas['my_shipping_address']->city }}" maxlength="60" required>
               @endif
            </div>
         </div>
         <div class="row">
            <div class="col-md-6 mb-3">
               <label for="country">Country</label>
               <select name="country" class="custom-select d-block w-100" id="country" required>
                  <option value="">Choose...</option>
                  <option value="AF">Afghanistan</option>
                  <option value="AX">Åland Islands</option>
                  <option value="AL">Albania</option>
                  <option value="DZ">Algeria</option>
                  <option value="AS">American Samoa</option>
                  <option value="AD">Andorra</option>
                  <option value="AO">Angola</option>
                  <option value="AI">Anguilla</option>
                  <option value="AQ">Antarctica</option>
                  <option value="AG">Antigua and Barbuda</option>
                  <option value="AR">Argentina</option>
                  <option value="AM">Armenia</option>
                  <option value="AW">Aruba</option>
                  <option value="AU">Australia</option>
                  <option value="AT">Austria</option>
                  <option value="AZ">Azerbaijan</option>
                  <option value="BS">Bahamas</option>
                  <option value="BH">Bahrain</option>
                  <option value="BD">Bangladesh</option>
                  <option value="BB">Barbados</option>
                  <option value="BY">Belarus</option>
                  <option value="BE">Belgium</option>
                  <option value="BZ">Belize</option>
                  <option value="BJ">Benin</option>
                  <option value="BM">Bermuda</option>
                  <option value="BT">Bhutan</option>
                  <option value="BO">Bolivia, Plurinational State of</option>
                  <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                  <option value="BA">Bosnia and Herzegovina</option>
                  <option value="BW">Botswana</option>
                  <option value="BV">Bouvet Island</option>
                  <option value="BR">Brazil</option>
                  <option value="IO">British Indian Ocean Territory</option>
                  <option value="BN">Brunei Darussalam</option>
                  <option value="BG">Bulgaria</option>
                  <option value="BF">Burkina Faso</option>
                  <option value="BI">Burundi</option>
                  <option value="KH">Cambodia</option>
                  <option value="CM">Cameroon</option>
                  <option value="CA">Canada</option>
                  <option value="CV">Cape Verde</option>
                  <option value="KY">Cayman Islands</option>
                  <option value="CF">Central African Republic</option>
                  <option value="TD">Chad</option>
                  <option value="CL">Chile</option>
                  <option value="CN">China</option>
                  <option value="CX">Christmas Island</option>
                  <option value="CC">Cocos (Keeling) Islands</option>
                  <option value="CO">Colombia</option>
                  <option value="KM">Comoros</option>
                  <option value="CG">Congo</option>
                  <option value="CD">Congo, the Democratic Republic of the</option>
                  <option value="CK">Cook Islands</option>
                  <option value="CR">Costa Rica</option>
                  <option value="CI">Côte d'Ivoire</option>
                  <option value="HR">Croatia</option>
                  <option value="CU">Cuba</option>
                  <option value="CW">Curaçao</option>
                  <option value="CY">Cyprus</option>
                  <option value="CZ">Czech Republic</option>
                  <option value="DK">Denmark</option>
                  <option value="DJ">Djibouti</option>
                  <option value="DM">Dominica</option>
                  <option value="DO">Dominican Republic</option>
                  <option value="EC">Ecuador</option>
                  <option value="EG">Egypt</option>
                  <option value="SV">El Salvador</option>
                  <option value="GQ">Equatorial Guinea</option>
                  <option value="ER">Eritrea</option>
                  <option value="EE">Estonia</option>
                  <option value="ET">Ethiopia</option>
                  <option value="FK">Falkland Islands (Malvinas)</option>
                  <option value="FO">Faroe Islands</option>
                  <option value="FJ">Fiji</option>
                  <option value="FI">Finland</option>
                  <option value="FR">France</option>
                  <option value="GF">French Guiana</option>
                  <option value="PF">French Polynesia</option>
                  <option value="TF">French Southern Territories</option>
                  <option value="GA">Gabon</option>
                  <option value="GM">Gambia</option>
                  <option value="GE">Georgia</option>
                  <option value="DE">Germany</option>
                  <option value="GH">Ghana</option>
                  <option value="GI">Gibraltar</option>
                  <option value="GR">Greece</option>
                  <option value="GL">Greenland</option>
                  <option value="GD">Grenada</option>
                  <option value="GP">Guadeloupe</option>
                  <option value="GU">Guam</option>
                  <option value="GT">Guatemala</option>
                  <option value="GG">Guernsey</option>
                  <option value="GN">Guinea</option>
                  <option value="GW">Guinea-Bissau</option>
                  <option value="GY">Guyana</option>
                  <option value="HT">Haiti</option>
                  <option value="HM">Heard Island and McDonald Islands</option>
                  <option value="VA">Holy See (Vatican City State)</option>
                  <option value="HN">Honduras</option>
                  <option value="HK">Hong Kong</option>
                  <option value="HU">Hungary</option>
                  <option value="IS">Iceland</option>
                  <option value="IN">India</option>
                  <option value="ID">Indonesia</option>
                  <option value="IR">Iran, Islamic Republic of</option>
                  <option value="IQ">Iraq</option>
                  <option value="IE">Ireland</option>
                  <option value="IM">Isle of Man</option>
                  <option value="IL">Israel</option>
                  <option value="IT">Italy</option>
                  <option value="JM">Jamaica</option>
                  <option value="JP">Japan</option>
                  <option value="JE">Jersey</option>
                  <option value="JO">Jordan</option>
                  <option value="KZ">Kazakhstan</option>
                  <option value="KE">Kenya</option>
                  <option value="KI">Kiribati</option>
                  <option value="KP">Korea, Democratic People's Republic of</option>
                  <option value="KR">Korea, Republic of</option>
                  <option value="KW">Kuwait</option>
                  <option value="KG">Kyrgyzstan</option>
                  <option value="LA">Lao People's Democratic Republic</option>
                  <option value="LV">Latvia</option>
                  <option value="LB">Lebanon</option>
                  <option value="LS">Lesotho</option>
                  <option value="LR">Liberia</option>
                  <option value="LY">Libya</option>
                  <option value="LI">Liechtenstein</option>
                  <option value="LT">Lithuania</option>
                  <option value="LU">Luxembourg</option>
                  <option value="MO">Macao</option>
                  <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                  <option value="MG">Madagascar</option>
                  <option value="MW">Malawi</option>
                  <option value="MY">Malaysia</option>
                  <option value="MV">Maldives</option>
                  <option value="ML">Mali</option>
                  <option value="MT">Malta</option>
                  <option value="MH">Marshall Islands</option>
                  <option value="MQ">Martinique</option>
                  <option value="MR">Mauritania</option>
                  <option value="MU">Mauritius</option>
                  <option value="YT">Mayotte</option>
                  <option value="MX">Mexico</option>
                  <option value="FM">Micronesia, Federated States of</option>
                  <option value="MD">Moldova, Republic of</option>
                  <option value="MC">Monaco</option>
                  <option value="MN">Mongolia</option>
                  <option value="ME">Montenegro</option>
                  <option value="MS">Montserrat</option>
                  <option value="MA">Morocco</option>
                  <option value="MZ">Mozambique</option>
                  <option value="MM">Myanmar</option>
                  <option value="NA">Namibia</option>
                  <option value="NR">Nauru</option>
                  <option value="NP">Nepal</option>
                  <option value="NL">Netherlands</option>
                  <option value="NC">New Caledonia</option>
                  <option value="NZ">New Zealand</option>
                  <option value="NI">Nicaragua</option>
                  <option value="NE">Niger</option>
                  <option value="NG">Nigeria</option>
                  <option value="NU">Niue</option>
                  <option value="NF">Norfolk Island</option>
                  <option value="MP">Northern Mariana Islands</option>
                  <option value="NO">Norway</option>
                  <option value="OM">Oman</option>
                  <option value="PK">Pakistan</option>
                  <option value="PW">Palau</option>
                  <option value="PS">Palestinian Territory, Occupied</option>
                  <option value="PA">Panama</option>
                  <option value="PG">Papua New Guinea</option>
                  <option value="PY">Paraguay</option>
                  <option value="PE">Peru</option>
                  <option value="PH">Philippines</option>
                  <option value="PN">Pitcairn</option>
                  <option value="PL">Poland</option>
                  <option value="PT">Portugal</option>
                  <option value="PR">Puerto Rico</option>
                  <option value="QA">Qatar</option>
                  <option value="RE">Réunion</option>
                  <option value="RO">Romania</option>
                  <option value="RU">Russian Federation</option>
                  <option value="RW">Rwanda</option>
                  <option value="BL">Saint Barthélemy</option>
                  <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                  <option value="KN">Saint Kitts and Nevis</option>
                  <option value="LC">Saint Lucia</option>
                  <option value="MF">Saint Martin (French part)</option>
                  <option value="PM">Saint Pierre and Miquelon</option>
                  <option value="VC">Saint Vincent and the Grenadines</option>
                  <option value="WS">Samoa</option>
                  <option value="SM">San Marino</option>
                  <option value="ST">Sao Tome and Principe</option>
                  <option value="SA">Saudi Arabia</option>
                  <option value="SN">Senegal</option>
                  <option value="RS">Serbia</option>
                  <option value="SC">Seychelles</option>
                  <option value="SL">Sierra Leone</option>
                  <option value="SG">Singapore</option>
                  <option value="SX">Sint Maarten (Dutch part)</option>
                  <option value="SK">Slovakia</option>
                  <option value="SI">Slovenia</option>
                  <option value="SB">Solomon Islands</option>
                  <option value="SO">Somalia</option>
                  <option value="ZA">South Africa</option>
                  <option value="GS">South Georgia and the South Sandwich Islands</option>
                  <option value="SS">South Sudan</option>
                  <option value="ES">Spain</option>
                  <option value="LK">Sri Lanka</option>
                  <option value="SD">Sudan</option>
                  <option value="SR">Suriname</option>
                  <option value="SJ">Svalbard and Jan Mayen</option>
                  <option value="SZ">Swaziland</option>
                  <option value="SE">Sweden</option>
                  <option value="CH">Switzerland</option>
                  <option value="SY">Syrian Arab Republic</option>
                  <option value="TW">Taiwan, Province of China</option>
                  <option value="TJ">Tajikistan</option>
                  <option value="TZ">Tanzania, United Republic of</option>
                  <option value="TH">Thailand</option>
                  <option value="TL">Timor-Leste</option>
                  <option value="TG">Togo</option>
                  <option value="TK">Tokelau</option>
                  <option value="TO">Tonga</option>
                  <option value="TT">Trinidad and Tobago</option>
                  <option value="TN">Tunisia</option>
                  <option value="TR">Turkey</option>
                  <option value="TM">Turkmenistan</option>
                  <option value="TC">Turks and Caicos Islands</option>
                  <option value="TV">Tuvalu</option>
                  <option value="UG">Uganda</option>
                  <option value="UA">Ukraine</option>
                  <option value="AE">United Arab Emirates</option>
                  <option value="GB" selected>United Kingdom</option>
                  <option value="US">United States</option>
                  <option value="UM">United States Minor Outlying Islands</option>
                  <option value="UY">Uruguay</option>
                  <option value="UZ">Uzbekistan</option>
                  <option value="VU">Vanuatu</option>
                  <option value="VE">Venezuela, Bolivarian Republic of</option>
                  <option value="VN">Viet Nam</option>
                  <option value="VG">Virgin Islands, British</option>
                  <option value="VI">Virgin Islands, U.S.</option>
                  <option value="WF">Wallis and Futuna</option>
                  <option value="EH">Western Sahara</option>
                  <option value="YE">Yemen</option>
                  <option value="ZM">Zambia</option>
                  <option value="ZW">Zimbabwe</option>
               </select>
               <div class="invalid-feedback">
                  Please select a valid country.
               </div>
            </div>
            <div class="col-md-6 mb-3">
               <label for="zip">Post Code</label>
               @if ($datas['input_id'] == 0)
                  <input name="postCode" type="text" class="form-control" id="zip" placeholder="" value="" maxlength="20" required>
               @else
                  <input name="postCode" type="text" class="form-control" id="zip" placeholder="" value="{{ $datas['my_shipping_address']->zip }}" maxlength="20" required>
               @endif
               <div class="invalid-feedback">
                  Post Code code required.
               </div>
            </div>
         </div>
         <hr class="mb-4">



            @if ($datas['input_id'] == 0)
            <input type="hidden" id="save-info" name="saveInfo" value="true">
            @else

            @endif

         
         <i class="fab fa-cc-stripe mx-auto" style="font-size: 42px;"></i>
         <i class="fab fa-cc-visa mb-3" style="font-size: 42px;"></i>

         <!-- Stripe payment form -->
         
         <div class="form-group">
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="">Name on Card</label>
                  <input name="card_name" id="card-name" type="text" class="form-control" placeholder="" value="" maxlength="60" required>
                  <div class="invalid-feedback">
                     Valid first name is required.
                  </div>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="firstName">Address</label>
                  <input name="card-address" id="card-address" type="text" class="form-control" value="" maxlength="40" required>
                  <div class="invalid-feedback">
                     Valid first name is required.
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="firstName">City</label>
                  <input name="card-city" id="card-city" type="text" class="form-control" placeholder="" value="" maxlength="40" required>
                  <div class="invalid-feedback">
                     Valid first name is required.
                  </div>
               </div>
               <div class="col-md-6 mb-3">
                  <label for="firstName">County</label>
                  <input name="card-province" id="card-province" type="text" class="form-control" placeholder="" value="" maxlength="40" required>
                  <div class="invalid-feedback">
                     Valid first name is required.
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 mb-3">
                  <label for="firstName">Post Code</label>
                  <input name="card-postcode" id="card-postcode" type="text" class="form-control" placeholder="" value="" maxlength="30" required>
                  <div class="invalid-feedback">
                     Valid first name is required.
                  </div>
               </div>
            </div>

            <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
         </div>

         <button id="complete-orders" class="btn btn-success btn-block">Submit Payment</button>
         </form>
         <!-- End of the Stripe payment form -->
         
      </div>
   </div>
</div>

<script>
// Create a Stripe client.
var stripe = Stripe('pk_test_mEGovgs2OKywyKpKPUOterGU00pxndMlRN');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
   base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
         color: '#aab7c4'
      }
   },
   invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
   }
};

// Create an instance of the card Element.
var card = elements.create('card', 
{
   style: style,
   hidePostalCode:true
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
   var displayError = document.getElementById('card-errors');
   if (event.error) {
      displayError.textContent = event.error.message;
   } else {
      displayError.textContent = '';
   }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
   event.preventDefault();

   var options = {
      name: document.getElementById('card-name').value,
      address_line1: document.getElementById('card-address').value,
      address_city: document.getElementById('card-city').value,
      address_state: document.getElementById('card-province').value,
      address_zip: document.getElementById('card-postcode').value,
   };

   document.getElementById('card-city').disable = true;

   stripe.createToken(card, options).then(function(result) {
      if (result.error) {
         // Inform the user if there was an error.
         var errorElement = document.getElementById('card-errors');
         errorElement.textContent = result.error.message;
         document.getElementById('card-city').disable = false;
      } else {
         // Send the token to your server.
         stripeTokenHandler(result.token);
      }
   });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
   // Insert the token ID into the form so it gets submitted to the server
   var form = document.getElementById('payment-form');
   var hiddenInput = document.createElement('input');
   hiddenInput.setAttribute('type', 'hidden');
   hiddenInput.setAttribute('name', 'stripeToken');
   hiddenInput.setAttribute('value', token.id);
   form.appendChild(hiddenInput);

   // Submit the form
   form.submit();
}
</script>

@endsection