"use strict";

var KTCalendarBasic = function() {
    return {
        //main function to initiate the module
        init: function() {
            var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var events = JSON.parse($('#events').attr('data'));
            var daysOfWeek = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
            var monthsOfYear = ['janv', 'fév', 'mars', 'avril', 'mail', 'juin', 'juil', 'août', 'sep', 'oct', 'nov', 'dec'];


            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',

                isRTL: KTUtil.isRTL(),

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY + 'T09:25:00', // just for demo

                views: {
                    dayGridMonth: { buttonText: 'month' },
                    timeGridWeek: { buttonText: 'week' },
                    timeGridDay: { buttonText: 'day' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                selectable: true,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                eventOrder: "-title",
                events: events,
                eventRender: function(info) {
                    var element = $(info.el);

                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                },
                dateClick: function(info) {
                    $('.only-date').text('Appliquer uniquement au '+info.date.getDate()+' '+monthsOfYear[info.date.getMonth()]);
                    $('.all-date').text('Appliquer à tous les '+daysOfWeek[info.date.getDay()]);
                    $('#planning_dayName').val(daysOfWeek[info.date.getDay()]);
                    $('#planning_date').datepicker("setDate", info.date);
                    $('#kt_modal').modal('show');
                }
            });

            calendar.render();
        }
    };
}();


jQuery(document).ready(function() {
    KTCalendarBasic.init();
});
