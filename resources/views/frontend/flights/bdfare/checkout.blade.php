@extends('frontend.layouts.main')
@section('main-container')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/themes/custom/search-results.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/themes/custom/image-checkbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/Content/tripploytrv/home/css/line-awesome.css') }}">
@endsection

@if ($paymentIntent!=null)
@php
$paymentIntent=$paymentIntent; 
$getid=$result->id;
@endphp 

<script src="https://js.stripe.com/v3/"></script>
@endif

<div class="container">
    <div class="row">
        <div class="col-lg-8">

            <div class="review-section ">
                
                <div class="review_box mt-5 p-2">

                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {!! session('error') !!}

                    </div>
                  @endif 
                  @if ($paymentIntent!=null)
                      
                    <form id="payment-form">

                        <div id="payment-element"></div>
        
                        <div class="continue-btn text-center mb-2">
                            <button type="submit" class="button ladda-button m-auto has-spinner" data-style="slide-left" id="pay-btn">
                                <span class="button-text">Pay Now</span>
                            </button>
                        </div>
        
                        <div id="error-messages" class="text-danger"></div>
                
                    </form>

                    @elseif($paypal)
                    <div class="continue-btn text-center mb-2">
                        <a href="{{ route('paypal.checkout',$result->id) }}" class="button ladda-button m-auto has-spinner" data-style="slide-left" id="pay-btn">
                            <span class="button-text">Pay With Paypal ({{ $result->currency }}  {{ number_format($result->total_amount) }})</span>
                        </a>
                    </div>
                  @endif

                </div>
          
            </div>
        </div> 

        @include('frontend.flight.partials.Bdfare-proceed-right',['selectedFlightData'=>$selectedFlightData])

    </div>
   
</div>
@if ($paymentIntent!=null)
<script>
    const stripe=Stripe('{{ $paymentData["public_key"] }}');
    const elements =stripe.elements({
        clientSecret:'{{ $paymentIntent->client_secret }}'
    })
    const paymentElement=elements.create('payment')
    paymentElement.mount('#payment-element')
    const form=document.getElementById('payment-form')
    const payButton = document.getElementById('pay-btn');
    const messages = document.getElementById('error-messages');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        payButton.disabled=true;
        
        const { error } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                return_url: window.location.href.split('?')[0] = '{{route("/payment-proceed",$getid)}}'
            }
        });

        if (error) {
            messages.innerText = error.message;
           payButton.disabled=false;

            payButton.classList.remove('loading');                
            payButton.innerHTML='<span class="button-text">Pay Now</span>'
        } 
    });

</script> 
@endif

<!-- ========== END MAIN CONTENT ========== -->
@endsection
