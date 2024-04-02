@extends('backend.layouts.main')
@section('main-container')
    <style>
      .input_select{
          border: 1px solid var(--color-border);
      border-radius: 4px;
      padding: 0 15px;
      padding-top: 25px;
      min-height: 70px;
      transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
      }
      .input_select_label{
        top: 18px !important;
      }
      .image_error p{
          color: red;
      }
      .passenger-heading{
        color: var(--color-blue-1) !important;
      }
    </style>
  <div class="dashboard__main">
      <div class="dashboard__content bg-light-2">
        <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
          <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Edit Ticket</h1>
            <div class="text-15 text-light-1">You can edit ticket from here.</div>

          </div>

        </div>
        
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
          <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

              <div class="col-auto">
                <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Ticket Information</button>
              </div>
              
                    </div>
           <form method="post" action="{{ route('/update-ticket',$ticket['id']) }}">
            @csrf
            @method('post') 
            <div class="tabs__content pt-30 js-tabs-content">

              <div class="tabs__pane -tab-item-1 is-tab-el-active">

                <div class="border-top-light mt-30 mb-30"></div>

                <div class="col-xl-9">
                  <div class="row x-gap-20 y-gap-20">
                   
                    <div class="col-md-6">

                      <div class="form-input">
                        <x-text-input id="pnr_no" name="pnr_no" type="text" :value="old('pnr_no',$ticket['pnr_no'])" />
                        <label class="lh-1 text-16 text-light-1">PNR</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('pnr_no')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="destinations" name="destinations" type="text" :value="old('destinations',$ticket['destinations'])"/>
                        <label class="lh-1 text-16 text-light-1">destinations</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('destinations')" />

                    </div>

                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="departure_date" name="departure_date" type="text" :value="old('departure_date',$ticket['departure_date'])"/>
                        <label class="lh-1 text-16 text-light-1">Depart Date</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('departure_date')" />

                    </div>
                    <div class="col-md-6">

                      <div class="form-input ">
                        <x-text-input id="return_date" name="return_date" type="text" :value="old('return_date',$ticket['return_date'])"/>
                        <label class="lh-1 text-16 text-light-1">Return Date</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('return_date')" />

                    </div>
                    <div class="col-md-6">

                        <div class="form-input ">
                          <x-text-input id="bags" name="bags" type="text" :value="old('bags',$ticket['bags'])" />
                          <label class="lh-1 text-16 text-light-1">Bags</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('bags')" />
  
                      </div>
                      <div class="col-md-6">
                        <div class="form-input ">
                            <select name="tripType" class="input_select">
                            <option value="round" {{$ticket['tripType']=='round' ?'selected':''}}>Round</option>
                            <option value="single"  {{$ticket['tripType']=='single' ?'selected':''}}>Single</option>
                           
                            </select>
                            <label class="lh-1 text-16 text-light-1 input_select_label">Trip Type</label>
                            </div>
                        <x-input-error class="mt-2" :messages="$errors->get('tripType')" />
  
                      </div>
                      <div class="col-md-4">

                        <div class="form-input ">
                          <x-text-input id="ticket_status" name="ticket_status" type="text" :value="old('ticket_status',$ticket['ticket_status'])" />
                          <label class="lh-1 text-16 text-light-1">Ticket Status</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('ticket_status')" />
  
                      </div>
                      <div class="col-md-4">

                        <div class="form-input ">
                          <x-text-input id="total_amount" name="total_amount" type="text" :value="old('total_amount',$ticket['total_amount'])" />
                          <label class="lh-1 text-16 text-light-1">Total Payment</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('total_amount')" />
  
                      </div>
                      <div class="col-md-4">

                        <div class="form-input ">
                            <select name="payment_status" class="input_select">
                            <option value="completed" {{$ticket['payment_status']=='completed' ?'selected':''}}>Completed</option>
                            <option value="pending"  {{$ticket['payment_status']=='pending' ?'selected':''}}>Pending</option>
                           
                            </select>
                            <label class="lh-1 text-16 text-light-1 input_select_label">Payment Status</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('payment_status')" />
  
                      </div>
                  </div>
                </div>

                <div class="d-inline-block pt-30">

                  <button  class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    Save <div class="icon-arrow-top-right ml-15"></div>
                  </button>

                </div>
                
              </div>
            </div>

            </form>

          </div>
          <hr>
          <div class="col-auto">
            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active passenger-heading">Passengers Information</button>
          </div>

          <form method="post" action="{{ route('/update-passengers',$ticket['id']) }}">
            @csrf
            @method('post') 
            <div class="tabs__content pt-30 js-tabs-content">
              <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    @foreach ($ticket['passengers'] as $key=> $passenger)
                        
                <div class="col-xl-9">
                  <h4 class="text-16 lh-14 fw-600">{{$key+1}}: {{$passenger['passType']}}</h4>
                  <input type="hidden" name="passenger_ids[]" value="{{ $passenger['id'] }}">

                  <div class="row x-gap-20 y-gap-20">

                    <div class="col-md-4">

                        <div class="form-input ">
                            <select name="title[]" class="input_select">
                            <option value="Mr." {{$passenger['title']=='Mr.' ?'selected':''}}>Mr.</option>
                            <option value="Mrs."  {{$passenger['title']=='Mrs.' ?'selected':''}}>Mrs.</option>
                            <option value="Ms."  {{$passenger['title']=='Ms.' ?'selected':''}}>Ms.</option>
                            <option value="Miss."  {{$passenger['title']=='Miss.' ?'selected':''}}>Miss.</option>
                           
                            </select>
                            <label class="lh-1 text-16 text-light-1 input_select_label">Title</label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
  
                     </div>
                    <div class="col-md-4">

                      <div class="form-input">
                        <x-text-input id="name" name="name[]" type="text" :value="old('name',$passenger['name'])" />
                        <label class="lh-1 text-16 text-light-1">Name</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('name')" />

                    </div>

                    <div class="col-md-4">

                      <div class="form-input ">
                        <x-text-input id="surname" name="surname[]" type="text" :value="old('surname',$passenger['surname'])"/>
                        <label class="lh-1 text-16 text-light-1">destinations</label>
                      </div>
                      <x-input-error class="mt-2" :messages="$errors->get('surname')" />

                    </div>

                  </div>
                </div>

                @endforeach

                <div class="d-inline-block pt-30">

                  <button  class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                    Save <div class="icon-arrow-top-right ml-15"></div>
                  </button>

                </div>
                
              </div>
            </div>

            </form>

        </div>


  @endsection
     