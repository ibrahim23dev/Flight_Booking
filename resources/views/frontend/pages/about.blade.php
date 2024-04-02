@include('frontend.layouts.header-search')


<!-- ========== MAIN CONTENT ========== -->
<main id="content">
   
    <div class="border-bottom border-color-8 pb-6 pb-lg-9 mb-6 mb-lg-8">
        <div class="container mb-10">
            <div class="slider">
                <div class="container space-1 bg-white">
                    <div class="w-md-80 w-lg-70 text-center mx-md-auto mb-5 mt-3">
                        <h2 class="section-title text-black font-size-xs-28 font-weight-bold mb-0">We’re truely dedicated to make your travel experience as much simple and fun as possible!</h2>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                            <img src="{{ url('storage/images/pages/'.$about->image) }}" style="width: 100%;height:20rem;border-radius:1rem">
                         </div>
                         <div class="row col-md-6">

                                 <h2 class="font-size-21 font-weight-bold text-center text-md-left ">{{ $about->title }}</h2>
                                 <p class="text-gray-1">{!! $about->content !!}</p>

                         </div>
                     </div>
                 </div>
             </div>
        </div>
       
    </div>
</main>
<!-- ========== END MAIN CONTENT ========== -->
@include('frontend.layouts.footer-search')
