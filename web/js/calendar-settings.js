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
        select: function(start, end, allDay) {
            $('#myModal').modal('show');
            $('#submitEvent').click(function(){
                var description =  $('#eventDescription').val();
                var title =  $('#eventTitle').val();
                start = start.getTime();
                end = end.getTime();
                var e = {
                        title: title,
                        description: description,
                        start: start,
                        end: end,
                        allDay: allDay
                    };
                if(e.title){
                    $.ajax({
                        url: Routing.generate('fullcalendar_loader'),
                        data: 'title='+ e.title+'&start='+ e.start +'&end='+ e.end +'&description='+ e.description,
                        type: "POST",
                        success: function(json) {
                            $('#eventDescription').val('');
                            $('#myModal').modal('hide');
                            alert('Added Successfully');
                        }
                    });
                }
                $('#myModal').modal('hide');
                $('#calendar').fullCalendar('refetchEvents');
            });
            $('#calendar').fullCalendar('unselect');
        },
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        defaultView: 'agendaWeek',
    });
});
