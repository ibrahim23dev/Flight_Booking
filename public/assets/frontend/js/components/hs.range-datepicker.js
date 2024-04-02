/**
 * Range datepicker wrapper.
 *
 * @author Htmlstream
 * @version 1.0
 *
 */
;(function ($) {
  'use strict';

  $.HSCore.components.HSRangeDatepicker = {
    /**
     *
     *
     * @var Object _baseConfig
     */
    _baseConfig: {},

    /**
     *
     *
     * @var jQuery pageCollection
     */
    pageCollection: $(),

    /**
     * Initialization of Range datepicker wrapper.
     *
     * @param String selector (optional)
     * @param Object config (optional)
     *
     * @return jQuery pageCollection - collection of initialized items.
     */

    init: function (selector, config) {

      this.collection = selector && $(selector).length ? $(selector) : $();
      if (!$(selector).length) return;

      this.config = config && $.isPlainObject(config) ?
        $.extend({}, this._baseConfig, config) : this._baseConfig;

      this.config.itemSelector = selector;

      this.initRangeDatepicker();

      return this.pageCollection;

    },

    // initRangeDatepicker: function () {
    //   //Variables
    //   var $self = this,
    //     collection = $self.pageCollection;

    //   //Actions
    //   this.collection.each(function (i, el) {
    //     //Variables
    //     var $this = $(el),
    //       optWrapper = $this.data('rp-wrapper'),
    //       optIsInline = Boolean($this.data('rp-is-inline')),
    //       optType = $this.data('rp-type'),
    //       optDateFormat = $this.data('rp-date-format'),
    //       optDefaultDate = JSON.parse(el.getAttribute('data-rp-default-date')),
    //       optIsDisableFutureDates = $this.data('rp-is-disable-future-dates');

    //     $this.flatpickr({
    //       inline: optIsInline, // boolean
    //       mode: optType ? optType : 'single', // 'single', 'multiple', 'range'
    //       dateFormat: optDateFormat ? optDateFormat : 'd M Y',
    //       appendTo: $(optWrapper)[0],
    //       numberOfMonths: 6,
    //       minDate: 'today',
    //       locale: {
    //         firstDayOfWeek: 1,
    //         weekdays: {
    //           shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
    //         },
    //         rangeSeparator: ' / '
    //       }

    //     });

    //     $this.css({
    //       width: $this.val().length * 7.5
    //     });

    //     //Actions
    //     collection = collection.add($this);

    //   });
    // }
    initRangeDatepicker: function () {
      // Variables
      var $self = this,
          collection = $self.pageCollection;
      
      // Actions
      this.collection.each(function (i, el) {
          // Variables
          var $this = $(el),
              optWrapper = $this.data('rp-wrapper'),
              optIsInline = Boolean($this.data('rp-is-inline')),
              optType = $this.data('rp-type'),
              optDateFormat = $this.data('rp-date-format'),
              optDefaultDate = JSON.parse(el.getAttribute('data-rp-default-date')),
              optIsDisableFutureDates = $this.data('rp-is-disable-future-dates'),
              customDatepicker = $this.data('custom-datepicker'), // Added variable
              optMinDate = $this.data('min-date') ? $this.data('min-date') : 'today',
              optMaxDate = $this.data('mix-date') ? $this.data('mix-date') : null;
          $this.flatpickr({
              inline: optIsInline, // boolean
              mode: optType ? optType : 'single', // 'single', 'multiple', 'range'
              dateFormat: optDateFormat ? optDateFormat : 'Y-m-d',
              appendTo: $(optWrapper)[0],
              numberOfMonths: 6,
              minDate: optMinDate,
              maxDate:optMaxDate,
              
              locale: {
                  firstDayOfWeek: 1,
                  weekdays: {
                      shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
                  },
                  rangeSeparator: ' / '
              },
              onChange: function (selectedDates, dateStr, instance) {
                
                  // Check if it's a departure datepicker
                  if (customDatepicker === 'departure') {
                      // Set the minimum date for the return date based on the selected departure date
                      $('#return_date_input').flatpickr({
                          minDate: dateStr,
                          mode: optType ? optType : 'single', // 'single', 'multiple', 'range'
                          dateFormat: optDateFormat ? optDateFormat : 'd M Y',
                          appendTo: $(optWrapper)[0],
                          
                          locale: {
                              firstDayOfWeek: 1,
                              weekdays: {
                                  shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
                              },
                              rangeSeparator: ' / '
                          },
                          
                      });
                     
                  }
                   
                  // Check if it's a return datepicker
                  else if (customDatepicker === 'return') {
                      // Set the maximum date for the departure date based on the selected return date
                      $('#departure_date_input').flatpickr({
                          maxDate: dateStr,
                          mode: optType ? optType : 'single', // 'single', 'multiple', 'range'
                          dateFormat: optDateFormat ? optDateFormat : 'd M Y',
                          appendTo: $(optWrapper)[0],
                           
                          locale: {
                              firstDayOfWeek: 1,
                              weekdays: {
                                  shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
                              },
                              rangeSeparator: ' / '
                          },
                           
                      });
                  }
                 
              }
          });
  
          $this.css({
              width: $this.val().length * 7.5
          });
          
        
          // Actions
          collection = collection.add($this);
      });
  }
  
  };
})(jQuery);
