$(function () {
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $('#calendar-holder').fullCalendar({
        header: {
            left: 'prev, next',
            center: 'title',
            right: 'month, agendaWeek, agendaDay,'
        },
        lazyFetching: true,
        timeFormat: {
            // for agendaWeek and agendaDay
            agenda: 'h:mmt',    // 5:00 - 6:30

            // for all other views
            '': 'h:mmt'         // 7p
        },
        eventSources: [
            {
                url: Routing.generate('fullcalendar_loader'),
                type: 'POST',
                // A way to add custom filters to your event listeners
                data: {
                },
                error: function() {
                   //alert('Erreur de récupération du calendrier, merci de recharger la page');
                }
            }
        ],
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            $('#myModal').modal('show');
            $('#submitEvent').click(function(){
                var description =  $('#eventDescription').val();
                var eventData = {
                        description: description,
                        start: start,
                        end: end
                    };
                $('#myModal').modal('hide');
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            });
            $('#calendar').fullCalendar('unselect');
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        defaultView: 'agendaWeek'
    });
});
