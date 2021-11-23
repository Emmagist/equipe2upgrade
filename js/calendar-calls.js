$(document).ready(function () {
    var caltype = $("#caltype").val(); ///////////The caltype is included in the page that load calendar
    var calendar = $('#calendar').fullCalendar({
        themeSystem: 'bootstrap4',
        header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listMonth'
        },
        weekNumbers: true,
        editable: true,
        events: getURL()+"/package.calendar/fetch-event.php?caltype="+caltype,
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var start = $.fullCalendar.formatDate(start, "MM/DD/Y");
            var end = $.fullCalendar.formatDate(end, "MM/DD/Y");
            $("#tdate5").val(formatDate(start,1))
            $("#tdate6").val(formatDate(end,1))
            $('#CalenderModalNew').modal('show');
            $(".antosubmit").on("click", function () {
                var title = $("#title").val(); 
                start = stringToDate($("#tdate5").val());
                end = stringToDate($("#tdate6").val());
                
                if (title) {
                    mypath = $("#antoform").serialize()+"&mode=addEvent"
                    $.ajax({
                        type:'POST',
                        url:getURL()+'/loaddata.php',
                        data:mypath,
                        dataType: "json",
                        //cache:false,
                        success:function(respons){
                            displayMessage("Added Successfully");
                        }
                    });

                    calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                        true // make the event "stick"
                    );
                    calendar.fullCalendar('unselect');
                }
                $('#title').val('');
                $('#descr').val('');
                start = '';
                end = '';

                $('.antoclose').click();

                return false;
            });
            
        },
        
        editable: true,
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: getURL()+'/package.calendar/edit-event.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function (response) {
                    displayMessage("Updated Successfully");
                }
            });
        },
        eventClick: function (event) {
            $('#actionmenus').modal('show');
            $('#title2').val(event.title);
            $('#descr2').val(event.descr);
            $('#matno').val(event.matno);
            $("#tdate3").val(formatDate(event.start,1))
            $("#tdate4").val(formatDate(event.end,1))
            $('#stime2').val(event.stime);
            $('#etime2').val(event.etime);
            $('#location2').val(event.venue); 
            $('#catid2').val(event.catid); 
            $('#rno2').val(event.reminderno); 
            $('#rweek2').val(event.reminder); 
            $('#eid').val(event.id); 

            $("#deleteEvent").click(function() {
                swal({
                    title: "Deleting!",
                    text: "Do you want to delete this Event?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete!",
                    closeOnConfirm: false
                }, function() {
                    $('#actionmenus').modal('hide');
                    $.ajax({
                        type: "POST",
                        url: getURL()+"/package.calendar/delete-event.php",
                        data: "&id=" + event.id,
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                swal.close()
                                $('#calendar').fullCalendar('removeEvents', event.id);
                                displayMessage("Deleted Successfully");
                            }
                        }
                    });
                    return true;
                })
                
            })
        
        
            $(".antosubmit2").on("click", function () {
                mypath = $("#antoform2").serialize()+"&mode=updateEvent";
                $('#CalenderModalEdit').modal('hide');
                $.ajax({
                    type:'POST',
                    url: getURL()+'/loaddata.php',
                    data:mypath,
                    dataType: "json",
                    success:function(respons){
                        $('#calendar').fullCalendar('refetchEvents', event.id);
                        displayMessage("Updated Successfully");
                    }
                });
            })

        }

    });
});

function displayMessage(message) {
    $(".response").show()
	$(".response").html("<div class='success'><b>"+message+"</b></div>");
    setInterval(function() { $(".success").fadeOut(); $(".response").hide() }, 1000);
}