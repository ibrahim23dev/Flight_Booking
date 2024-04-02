$(document).ready(function() {

   //////////// logo slider code start ////////////////// 
  $('.slick-slider').slick({
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: 'no',
    nextArrow: 'no',

    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerPadding: '60px',
          slidesToShow: 3,
          infinite: true,
          autoplay: true,
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerPadding: '60px',
          slidesToShow: 1,
          infinite: true,
          autoplay: true,
        }
      }
    ]

  });
   //////////// logo slider code ends ////////////////// 

    //////////////// datepicker function ////////////////
    $("#check_in_date").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
      startDate: '0d',
      beforeShowDay: function(date) {
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);
        date.setHours(0, 0, 0, 0);
        if (date < currentDate) {
          return {
            enabled: false,
            classes: 'disabled'
          };
        }
        return {
          enabled: true,
          classes: date.getTime() === currentDate.getTime() ? 'highlight-today' : ''
        };
      }
    }).on('changeDate', function(selectedDate) {
      var minDate = new Date(selectedDate.date.valueOf());
      $("#check_out_date").datepicker("setStartDate", minDate);
    });
    
    $("#check_out_date").datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true,
      beforeShowDay: function(date) {
        var currentDate = new Date();
        currentDate.setHours(0, 0, 0, 0);
        date.setHours(0, 0, 0, 0);
        if (date < currentDate) {
          return {
            enabled: false,
            classes: 'disabled'
          };
        }
        return {
          enabled: true,
          classes: date.getTime() === currentDate.getTime() ? 'highlight-today' : ''
        };
      }
    }).on('changeDate', function(selectedDate) {
      var maxDate = new Date(selectedDate.date.valueOf());
      $("#check_in_date").datepicker("setEndDate", maxDate);
    });
    
    
  /////////////// datepicker function end ///////////////////

  ///////////// show hide return date element /////////////

      // Iterate over each div with class 'single_round'
      $('.single_round').each(function() {
        $(this).click(function() {
          $('.single_round').removeClass('bg-dark-4 text-white'); // Remove the classes from all elements
          $(this).addClass('bg-dark-4 text-white'); // Add classes to the clicked element
      
          var value = $(this).data('value'); // Get the value from the data attribute
      
          if (value === 'Round') {
            $('#return_date_element').fadeIn(); // Show the element
          } else if (value === 'Single') {
            $('#return_date_element').fadeOut(); // Hide the element
            $('#check_out_date').val(''); // Empty the check out date
          }
        });
      });
      
  ///////////// show hide return date element end /////////////

});
