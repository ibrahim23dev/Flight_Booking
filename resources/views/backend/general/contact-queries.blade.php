@extends('backend.layouts.main')
@section('main-container')
  
  
  <div class="dashboard__main">
    <div class="dashboard__content bg-light-2">
      <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

          <h1 class="text-30 lh-14 fw-600">Contact Queries</h1>
          <div class="text-15 text-light-1">Find all contact queries list from here.</div>

        </div>
      </div>

      @if(session()->has('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
      @endif
      @if(session()->has('error'))
      <div class="alert alert-danger">
          {{ session('error') }}
      </div>
      @endif
      <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
          <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

            <div class="col-auto">
              <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">All Queries</button>

            </div>


          </div>

          <div class="tabs__content pt-30 js-tabs-content">

            <div class="tabs__pane -tab-item-1 is-tab-el-active">
              <div class="overflow-scroll scroll-bar-1">
                <table class="-border-bottom col-12 nowrap" id="my-datatable">
                  <thead class="bg-light-2">
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Message</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($queries as $key=>$query)
                         
                     <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$query['name']}}</td>
                      <td>{{$query['email']}}</td>
                      <td>{{Str::words($query['message'], 5, '...')}}</td>
                    
                      <td>
                        <div class="message-container">
                          <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 {{$query['status']=='active' ? 'bg-blue-1-05 text-blue-1':'bg-red-3 text-red-2'}} view-status-button" id="status_{{$query['id']}}">{{$query['status']}}</span>
                        </div>
                      </td>
                    
                      <td>
                        <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 bg-blue-1-05 text-blue-1">{{date('M-d-Y h:i a', strtotime($query['created_at']))}}</span> 
                      </td>
                    
                      <td>
                        <div class="col-auto">
                          <a href="#" class="bg-blue-1-05 text-blue-1 get_detail_message" data-message="{{$query['message']}}" data-messageId="{{$query['id']}}">
                            <i class="icon-eye text-16 text-light-1"></i>
                          </a>
                          <form method="post" action="{{route('/general/delete-message',$query['id'])}}" onsubmit="return confirm('Are you sure to delete')" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit"><i class="icon-trash-2 text-16 text-light-1"></i></button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>


          </div>
        </div>

      </div>

      <script>
        $(document).ready( function () {
            $('#my-datatable').DataTable({
              responsive: true
            });
        } );
      </script>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Message Details</h5>
            <span  class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </span>
          </div>
          <div class="modal-body">

          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        // Bind click event to elements
        $('.get_detail_message').each(function() {
          $(this).click(function(event) {
            event.preventDefault(); // Prevent form submission
      
            // Get the message from data-message attribute
            var message = $(this).data('message');
            // Get the message ID from data-messageId attribute
            var messageId = $(this).data('messageid');
      
            // Set the message content in the modal body
            $('.modal-body').text(message);
      
            // Open the Bootstrap modal
            $('#exampleModalCenter').modal('show');
      
            // Update the status to 'viewed' in the database
            updateMessageStatus(messageId,$(this));
          });
        });
      
        $('.modal-header .close').click(function() {
          $('#exampleModalCenter').modal('hide');
        });
      
        // Function to update the message status to 'viewed' in the database
         function updateMessageStatus(messageId, detailButton) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
              url: '{{ route("/general/updateMessageStatus") }}',
              type: 'POST',
              data: {
                messageId: messageId,
                _token: csrfToken
              },
              success: function (response) {
               // Find the closest 'tr' element containing both the button and status
             var trElement = detailButton.closest('tr');

            // Find the status button within the 'tr' element and update text and class
              var viewStatusButton = trElement.find('.view-status-button');
              viewStatusButton.text(response.status);
              viewStatusButton.removeClass('bg-blue-1-05 text-blue-1 bg-red-3 text-red-2').addClass(response.statusClass);
              },
              error: function (xhr, status, error) {
                console.error('Error updating status:', error);
              }
            });
          }

      });
      
      </script>

  @endsection
