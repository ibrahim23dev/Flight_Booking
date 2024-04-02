@extends('frontend.layouts.main')
@section('main-container')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/themes/custom/search-results.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/themes/custom/image-checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/tripploytrv/home/css/line-awesome.css') }}">
@endsection

<div class="container">
    <div class="row">
        <div class="col-lg-8">

            <div class="review-section">
                
                <div class="review_box">
                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {!! session('error') !!}

                    </div>
                  @endif 

                  @if (session()->has('success'))
                  <div class="alert alert-success">
                      {!! session('success') !!}

                  </div>
                @endif 
                  
                </div>
              <form action="{{ route('tours.book',$package->package_id) }}" method="POST">
                @csrf
             
                <div class="review_box">
                    <div class="title-top">
                        <h5><i class="fa-solid fa-address-book text-info me-2"></i>Contact Information</h5>
                    </div>
                    <div class="flight_detail">
                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <div class="form-group form-floating mb-0">
                                    <select id="title" class="select2 form-select"
                                        name="title"
                                        data-val-required="Title is required." data-val="true"
                                         aria-hidden="true" required>
                                        <option value="">Title</option>

                                        <option selected="selected" value="MR"
                                           >MR</option>
                                        <option value="MRS">MRS</option>
                                        <option value="MISS">MISS</option>

                                    </select>
                                    <label for="title" class="required">Choose Title</label>
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group form-floating mb-0">
                                    <span class="fa-regular text-muted fa-user"></span>
                                    <input id="full_name" class="form-control pl-3" type="text"
                                        name="full_name" placeholder="Enter Full Name"
                                        data-val-required="Full name is required."
                                        data-val-maxlength-max="50"
                                        data-val-maxlength="Cannot be more than 50 characters"
                                        data-val-regex-pattern="^[0-9a-zA-Z''-'\s]{1,40}$"
                                        data-val-regex="Special characters are not allowed" data-val="true" autocomplete="off" required
                                        value="{{ old('full_name') }}">
                                    <label for="full_name">Full Name</label>
                                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                </div>
                               

                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="form-group form-floating mb-0">
                                    <select class="select2 form-select" id="mobile-cc"
                                        name="country_code" required>
                                        <option value="">Select Country Code</option>
                                        <option value="93" data-code="93">Afghanistan (+93)</option>
                                        <option value="355" data-code="355">Albania (+355)</option>
                                        <option value="213" data-code="213">Algeria (+213)</option>
                                        <option value="1684" data-code="1684">American Samoa (+1684)</option>
                                        <option value="376" data-code="376">Andorra (+376)</option>
                                        <option value="244" data-code="244">Angola (+244)</option>
                                        <option value="1264" data-code="1264">Anguilla (+1264)</option>
                                        <option value="0" data-code="0">Antarctica (+0)</option>
                                        <option value="1268" data-code="1268">Antigua And Barbuda (+1268)</option>
                                        <option value="54" data-code="54">Argentina (+54)</option>
                                        <option value="374" data-code="374">Armenia (+374)</option>
                                        <option value="297" data-code="297">Aruba (+297)</option>
                                        <option value="61" data-code="61">Australia (+61)</option>
                                        <option value="43" data-code="43">Austria (+43)</option>
                                        <option value="994" data-code="994">Azerbaijan (+994)</option>
                                        <option value="1242" data-code="1242">Bahamas The (+1242)</option>
                                        <option value="973" data-code="973">Bahrain (+973)</option>
                                        <option  value="880" data-code="880">Bangladesh (+880)</option>
                                        <option value="1246" data-code="1246">Barbados (+1246)</option>
                                        <option value="375" data-code="375">Belarus (+375)</option>
                                        <option value="32" data-code="32">Belgium (+32)</option>
                                        <option value="501" data-code="501">Belize (+501)</option>
                                        <option value="229" data-code="229">Benin (+229)</option>
                                        <option value="1441" data-code="1441">Bermuda (+1441)</option>
                                        <option value="975" data-code="975">Bhutan (+975)</option>
                                        <option value="591" data-code="591">Bolivia (+591)</option>
                                        <option value="387" data-code="387">Bosnia and Herzegovina (+387)
                                        </option>
                                        <option value="267" data-code="267">Botswana (+267)</option>
                                        <option value="0" data-code="0">Bouvet Island (+0)</option>
                                        <option value="55" data-code="55">Brazil (+55)</option>
                                        <option value="246" data-code="246">British Indian Ocean Territory (+246)
                                        </option>
                                        <option value="673" data-code="673">Brunei (+673)</option>
                                        <option value="359" data-code="359">Bulgaria (+359)</option>
                                        <option value="226" data-code="226">Burkina Faso (+226)</option>
                                        <option value="257" data-code="257">Burundi (+257)</option>
                                        <option value="855" data-code="855">Cambodia (+855)</option>
                                        <option value="237" data-code="237">Cameroon (+237)</option>
                                        <option value="1" data-code="1">Canada (+1)</option>
                                        <option value="238" data-code="238">Cape Verde (+238)</option>
                                        <option value="1345" data-code="1345">Cayman Islands (+1345)</option>
                                        <option value="236" data-code="236">Central African Republic (+236)
                                        </option>
                                        <option value="235" data-code="235">Chad (+235)</option>
                                        <option value="56" data-code="56">Chile (+56)</option>
                                        <option value="86" data-code="86">China (+86)</option>
                                        <option value="61" data-code="61">Christmas Island (+61)</option>
                                        <option value="672" data-code="672">Cocos (Keeling) Islands (+672)
                                        </option>
                                        <option value="57" data-code="57">Colombia (+57)</option>
                                        <option value="269" data-code="269">Comoros (+269)</option>
                                        <option value="242" data-code="242">Congo (+242)</option>
                                        <option value="242" data-code="242">Congo The Democratic Republic Of The
                                            (+242)</option>
                                        <option value="682" data-code="682">Cook Islands (+682)</option>
                                        <option value="506" data-code="506">Costa Rica (+506)</option>
                                        <option value="225" data-code="225">Cote D'Ivoire (Ivory Coast) (+225)
                                        </option>
                                        <option value="385" data-code="385">Croatia (Hrvatska) (+385)</option>
                                        <option value="53" data-code="53">Cuba (+53)</option>
                                        <option value="357" data-code="357">Cyprus (+357)</option>
                                        <option value="420" data-code="420">Czech Republic (+420)</option>
                                        <option value="45" data-code="45">Denmark (+45)</option>
                                        <option value="253" data-code="253">Djibouti (+253)</option>
                                        <option value="1767" data-code="1767">Dominica (+1767)</option>
                                        <option value="1809" data-code="1809">Dominican Republic (+1809)</option>
                                        <option value="593" data-code="593">Ecuador (+593)</option>
                                        <option value="20" data-code="20">Egypt (+20)</option>
                                        <option value="503" data-code="503">El Salvador (+503)</option>
                                        <option value="240" data-code="240">Equatorial Guinea (+240)</option>
                                        <option value="291" data-code="291">Eritrea (+291)</option>
                                        <option value="372" data-code="372">Estonia (+372)</option>
                                        <option value="251" data-code="251">Ethiopia (+251)</option>
                                        <option value="500" data-code="500">Falkland Islands (+500)</option>
                                        <option value="298" data-code="298">Faroe Islands (+298)</option>
                                        <option value="679" data-code="679">Fiji Islands (+679)</option>
                                        <option value="358" data-code="358">Finland (+358)</option>
                                        <option value="33" data-code="33">France (+33)</option>
                                        <option value="594" data-code="594">French Guiana (+594)</option>
                                        <option value="689" data-code="689">French Polynesia (+689)</option>
                                        <option value="0" data-code="0">French Southern Territories (+0)
                                        </option>
                                        <option value="241" data-code="241">Gabon (+241)</option>
                                        <option value="220" data-code="220">Gambia The (+220)</option>
                                        <option value="995" data-code="995">Georgia (+995)</option>
                                        <option value="49" data-code="49">Germany (+49)</option>
                                        <option value="233" data-code="233">Ghana (+233)</option>
                                        <option value="350" data-code="350">Gibraltar (+350)</option>
                                        <option value="30" data-code="30">Greece (+30)</option>
                                        <option value="299" data-code="299">Greenland (+299)</option>
                                        <option value="1473" data-code="1473">Grenada (+1473)</option>
                                        <option value="590" data-code="590">Guadeloupe (+590)</option>
                                        <option value="1671" data-code="1671">Guam (+1671)</option>
                                        <option value="502" data-code="502">Guatemala (+502)</option>
                                        <option value="224" data-code="224">Guinea (+224)</option>
                                        <option value="245" data-code="245">Guinea-Bissau (+245)</option>
                                        <option value="592" data-code="592">Guyana (+592)</option>
                                        <option value="509" data-code="509">Haiti (+509)</option>
                                        <option value="0" data-code="0">Heard and McDonald Islands (+0)
                                        </option>
                                        <option value="504" data-code="504">Honduras (+504)</option>
                                        <option value="852" data-code="852">Hong Kong S.A.R. (+852)</option>
                                        <option value="36" data-code="36">Hungary (+36)</option>
                                        <option value="354" data-code="354">Iceland (+354)</option>
                                        <option value="91" data-code="91">India (+91)</option>
                                        <option value="62" data-code="62">Indonesia (+62)</option>
                                        <option value="98" data-code="98">Iran (+98)</option>
                                        <option value="964" data-code="964">Iraq (+964)</option>
                                        <option value="353" data-code="353">Ireland (+353)</option>
                                        <option value="972" data-code="972">Israel (+972)</option>
                                        <option value="39" data-code="39">Italy (+39)</option>
                                        <option value="1876" data-code="1876">Jamaica (+1876)</option>
                                        <option value="81" data-code="81">Japan (+81)</option>
                                        <option value="962" data-code="962">Jordan (+962)</option>
                                        <option value="7" data-code="7">Kazakhstan (+7)</option>
                                        <option value="254" data-code="254">Kenya (+254)</option>
                                        <option value="686" data-code="686">Kiribati (+686)</option>
                                        <option value="850" data-code="850">Korea North (+850)</option>
                                        <option value="82" data-code="82">Korea South (+82)</option>
                                        <option value="965" data-code="965">Kuwait (+965)</option>
                                        <option value="996" data-code="996">Kyrgyzstan (+996)</option>
                                        <option value="856" data-code="856">Laos (+856)</option>
                                        <option value="371" data-code="371">Latvia (+371)</option>
                                        <option value="961" data-code="961">Lebanon (+961)</option>
                                        <option value="266" data-code="266">Lesotho (+266)</option>
                                        <option value="231" data-code="231">Liberia (+231)</option>
                                        <option value="218" data-code="218">Libya (+218)</option>
                                        <option value="423" data-code="423">Liechtenstein (+423)</option>
                                        <option value="370" data-code="370">Lithuania (+370)</option>
                                        <option value="352" data-code="352">Luxembourg (+352)</option>
                                        <option value="853" data-code="853">Macau S.A.R. (+853)</option>
                                        <option value="389" data-code="389">Macedonia (+389)</option>
                                        <option value="261" data-code="261">Madagascar (+261)</option>
                                        <option value="265" data-code="265">Malawi (+265)</option>
                                        <option value="60" data-code="60">Malaysia (+60)</option>
                                        <option value="960" data-code="960">Maldives (+960)</option>
                                        <option value="223" data-code="223">Mali (+223)</option>
                                        <option value="356" data-code="356">Malta (+356)</option>
                                        <option value="692" data-code="692">Marshall Islands (+692)</option>
                                        <option value="596" data-code="596">Martinique (+596)</option>
                                        <option value="222" data-code="222">Mauritania (+222)</option>
                                        <option value="230" data-code="230">Mauritius (+230)</option>
                                        <option value="269" data-code="269">Mayotte (+269)</option>
                                        <option value="52" data-code="52">Mexico (+52)</option>
                                        <option value="691" data-code="691">Micronesia (+691)</option>
                                        <option value="373" data-code="373">Moldova (+373)</option>
                                        <option value="377" data-code="377">Monaco (+377)</option>
                                        <option value="976" data-code="976">Mongolia (+976)</option>
                                        <option value="1664" data-code="1664">Montserrat (+1664)</option>
                                        <option value="212" data-code="212">Morocco (+212)</option>
                                        <option value="258" data-code="258">Mozambique (+258)</option>
                                        <option value="95" data-code="95">Myanmar (+95)</option>
                                        <option value="264" data-code="264">Namibia (+264)</option>
                                        <option value="674" data-code="674">Nauru (+674)</option>
                                        <option value="977" data-code="977">Nepal (+977)</option>
                                        <option value="599" data-code="599">Netherlands Antilles (+599)</option>
                                        <option value="31" data-code="31">Netherlands The (+31)</option>
                                        <option value="687" data-code="687">New Caledonia (+687)</option>
                                        <option value="64" data-code="64">New Zealand (+64)</option>
                                        <option value="505" data-code="505">Nicaragua (+505)</option>
                                        <option value="227" data-code="227">Niger (+227)</option>
                                        <option value="234" data-code="234">Nigeria (+234)</option>
                                        <option value="683" data-code="683">Niue (+683)</option>
                                        <option value="672" data-code="672">Norfolk Island (+672)</option>
                                        <option value="1670" data-code="1670">Northern Mariana Islands (+1670)
                                        </option>
                                        <option value="47" data-code="47">Norway (+47)</option>
                                        <option value="968" data-code="968">Oman (+968)</option>
                                        <option value="92" data-code="92">Pakistan (+92)</option>
                                        <option value="680" data-code="680">Palau (+680)</option>
                                        <option value="970" data-code="970">Palestinian Territory Occupied (+970)
                                        </option>
                                        <option value="507" data-code="507">Panama (+507)</option>
                                        <option value="675" data-code="675">Papua new Guinea (+675)</option>
                                        <option value="595" data-code="595">Paraguay (+595)</option>
                                        <option value="51" data-code="51">Peru (+51)</option>
                                        <option value="63" data-code="63">Philippines (+63)</option>
                                        <option value="0" data-code="0">Pitcairn Island (+0)</option>
                                        <option value="48" data-code="48">Poland (+48)</option>
                                        <option value="351" data-code="351">Portugal (+351)</option>
                                        <option value="1787" data-code="1787">Puerto Rico (+1787)</option>
                                        <option value="974" data-code="974">Qatar (+974)</option>
                                        <option value="262" data-code="262">Reunion (+262)</option>
                                        <option value="40" data-code="40">Romania (+40)</option>
                                        <option value="70" data-code="70">Russia (+70)</option>
                                        <option value="250" data-code="250">Rwanda (+250)</option>
                                        <option value="290" data-code="290">Saint Helena (+290)</option>
                                        <option value="1869" data-code="1869">Saint Kitts And Nevis (+1869)
                                        </option>
                                        <option value="1758" data-code="1758">Saint Lucia (+1758)</option>
                                        <option value="508" data-code="508">Saint Pierre and Miquelon (+508)
                                        </option>
                                        <option value="1784" data-code="1784">Saint Vincent And The Grenadines
                                            (+1784)</option>
                                        <option value="684" data-code="684">Samoa (+684)</option>
                                        <option value="378" data-code="378">San Marino (+378)</option>
                                        <option value="239" data-code="239">Sao Tome and Principe (+239)</option>
                                        <option value="966" data-code="966">Saudi Arabia (+966)</option>
                                        <option value="221" data-code="221">Senegal (+221)</option>
                                        <option value="248" data-code="248">Seychelles (+248)</option>
                                        <option value="232" data-code="232">Sierra Leone (+232)</option>
                                        <option value="65" data-code="65">Singapore (+65)</option>
                                        <option value="421" data-code="421">Slovakia (+421)</option>
                                        <option value="386" data-code="386">Slovenia (+386)</option>
                                        <option value="677" data-code="677">Solomon Islands (+677)</option>
                                        <option value="252" data-code="252">Somalia (+252)</option>
                                        <option value="27" data-code="27">South Africa (+27)</option>
                                        <option value="0" data-code="0">South Georgia (+0)</option>
                                        <option value="34" data-code="34">Spain (+34)</option>
                                        <option value="94" data-code="94">Sri Lanka (+94)</option>
                                        <option value="249" data-code="249">Sudan (+249)</option>
                                        <option value="597" data-code="597">Suriname (+597)</option>
                                        <option value="47" data-code="47">Svalbard And Jan Mayen Islands (+47)
                                        </option>
                                        <option value="268" data-code="268">Swaziland (+268)</option>
                                        <option value="46" data-code="46">Sweden (+46)</option>
                                        <option value="41" data-code="41">Switzerland (+41)</option>
                                        <option value="963" data-code="963">Syria (+963)</option>
                                        <option value="886" data-code="886">Taiwan (+886)</option>
                                        <option value="992" data-code="992">Tajikistan (+992)</option>
                                        <option value="255" data-code="255">Tanzania (+255)</option>
                                        <option value="66" data-code="66">Thailand (+66)</option>
                                        <option value="228" data-code="228">Togo (+228)</option>
                                        <option value="690" data-code="690">Tokelau (+690)</option>
                                        <option value="676" data-code="676">Tonga (+676)</option>
                                        <option value="1868" data-code="1868">Trinidad And Tobago (+1868)</option>
                                        <option value="216" data-code="216">Tunisia (+216)</option>
                                        <option value="90" data-code="90">Turkey (+90)</option>
                                        <option value="7370" data-code="7370">Turkmenistan (+7370)</option>
                                        <option value="1649" data-code="1649">Turks And Caicos Islands (+1649)
                                        </option>
                                        <option value="688" data-code="688">Tuvalu (+688)</option>
                                        <option value="256" data-code="256">Uganda (+256)</option>
                                        <option value="380" data-code="380">Ukraine (+380)</option>
                                        <option value="971" data-code="971">United Arab Emirates (+971)</option>
                                        <option value="44" data-code="44">United Kingdom (+44)</option>
                                        <option value="1" data-code="1">United States (+1)</option>
                                        <option value="598" data-code="598">Uruguay (+598)</option>
                                        <option value="998" data-code="998">Uzbekistan (+998)</option>
                                        <option value="678" data-code="678">Vanuatu (+678)</option>
                                        <option value="39" data-code="39">Vatican City State (Holy See) (+39)
                                        </option>
                                        <option value="58" data-code="58">Venezuela (+58)</option>
                                        <option value="84" data-code="84">Vietnam (+84)</option>
                                        <option value="1284" data-code="1284">Virgin Islands (British) (+1284)
                                        </option>
                                        <option value="1340" data-code="1340">Virgin Islands (US) (+1340)</option>
                                        <option value="681" data-code="681">Wallis And Futuna Islands (+681)
                                        </option>
                                        <option value="212" data-code="212">Western Sahara (+212)</option>
                                        <option value="967" data-code="967">Yemen (+967)</option>
                                        <option value="260" data-code="260">Zambia (+260)</option>
                                        <option value="263" data-code="263">Zimbabwe (+263)</option>




                                    </select>
                                    <label class="label-text">Country Code</label>
                                    <x-input-error :messages="$errors->get('country_code')" class="mt-2" />
                                </div>
                            </div><!-- end col-md-4 -->
                            <div class="col-md-4 mb-3">
                                <div class="form-floating form-group mb-0">
                                    <span class="la la-phone text-muted"></span>
                                    <input id="mobile-c" class="form-control pl-3" value=""
                                        type="text" name="contact_no" placeholder="Mobile number"
                                        data-val-required="Contact mobile number is required" data-val="true"
                                        data-val-maxlength-max="11"
                                        data-val-maxlength="Contact mobile number cannot be more than 15 characters"
                                        data-val-regex-pattern="^[0-9]{1,40}$"
                                        data-val-regex="Only numbers are allowed for contact mobile number" required  value="{{ old('contact_no') }}">
                                    <label class="label-text">Contact Mobile</label>
                                    <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                                </div>
                                <span data-valmsg-replace="true" data-valmsg-for="Contact.Mobile"
                                    class="field-validation-valid text-danger"></span>

                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group form-floating mb-0">

                                    <span class="fa-envelope fa-regular text-muted"></span>
                                    <input id="email-c" class="form-control" value=""
                                        type="email" name="email" placeholder="Email address"
                                        data-val-required="Contact email address is required"
                                        data-val-maxlength-max="100"
                                        data-val-maxlength="Contact email address cannot be more than 100 characters"
                                        data-val="true"  value="{{ old('email') }}">
                                    <label class="label-text">Your Email</label>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <span data-valmsg-replace="true" data-valmsg-for="Contact.Email"
                                    class="field-validation-valid text-danger"></span>

                            </div><!-- end col-md-4 -->
                        </div>
                    </div>

                </div>

                <div class="review_box">
                    <div class="title-top">
                        <h5><i class="fa-solid fa-money-check-dollar text-info me-2"></i>Payment Method</h5>
                    </div>
                    <div class="flight_detail">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="boxes row">
                                    
                                    
                                    @foreach ($paymentGateWays as $gKey => $paymentGateWay)
                                        
                                    <div class="form-check col-xl-3 col-md-3 col-12 image-checkbox">
                                        <input class="form-check-input radio_animated" type="radio"
                                            name="payment_gateway" id="payment_gateway_{{ $gKey }}" value="{{ $paymentGateWay->id }}" required>
                                        <label class="form-check-label" for="payment_gateway_{{ $gKey }}">
                                            <img src="{{ url('storage/'.$paymentGateWay->icon) }}" width="140" alt="{{ $paymentGateWay->agent }}">
                                        </label>
                                    </div>

                                    @endforeach
                                    <x-input-error :messages="$errors->get('payment_gateway')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="continue-btn text-center mb-2">
                   
                    <button type="submit" class="button ladda-button m-auto has-spinner" data-style="slide-left"><span class="button-text">Book Now</span></button>
                </div>
            </form>
            </div>
        </div>

        @include('frontend.toures.partials.tour-proceed-right',['packageDetails'=>$package])

    </div>
   
</div>
<!-- ========== END MAIN CONTENT ========== -->
@endsection
