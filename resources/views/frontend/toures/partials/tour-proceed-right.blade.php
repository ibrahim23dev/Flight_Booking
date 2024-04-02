
<div class="col-lg-4 res-margin">
    <div class="sticky-cls-top">
        <div class="review-section" id="summary">

            <div class="review_box">
                <div class="title-top position-relative">
                    <h5>booking summery</h5>
                  
                </div>
                <div class="flight_detail">
                    <div class="summery_box">
                        <table class="table table-sm">

                            <tbody>
                               <tr>
                                <td class="w-100">
                                    <div class="tour-image">
                                        <img src="{{ asset('storage/'.$package->image) }}"
                                                        alt="{{ $package->packageCategory->location }}" class="br-5" style="width: 100%"/>
                                    </div>
                                </td>
                               </tr>
                               <tr style="font-size:15px;">
                                <td class="text-center">
                                    {{ $package->package_name }}
                                </td>
                               </tr>

                               <tr style="font-size:15px;">
                                <td><strong>Payable</strong> 
                                     <strong style="float: right">{{ number_format($package->total_package_price) }}
                                    {{ $package->packageCategory->currency }}
                                </strong> </td>
                                
                               </tr>

                               
                            </tbody>
                        </table>

                    </div>
                 
                   
                </div>
            </div>

        </div>
    </div>
</div>