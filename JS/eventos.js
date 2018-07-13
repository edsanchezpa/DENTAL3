  $(document).ready(function() {

   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: './dao/load.php',
    selectable:true,
    selectHelper:true,
/*
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      

      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })

     }
    },*/

    select: function(start,end, allDay){
      $('#registrar #start').val(moment(start).format('DD/MM/YYYY HH:mm:ss'));
      $('#registrar #end').val(moment(end).format('DD/MM/YYYY HH:mm:ss'));
      $('#registrar').modal('show');},


    editable:true,

    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

/*
    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    */

    eventClick: function(event) {
            
            $('#visualizar #id_cita').text(event.id);
            $('#visualizar #id_paciente').text(event.e_id_paciente);
            $('#visualizar #title').text(event.title);
            $('#visualizar #start').text(event.start.format('DD/MM/YYYY HH:mm:ss'));
            $('#visualizar #end').text(event.end.format('DD/MM/YYYY HH:mm:ss'));
            $('#visualizar #obs').text(event.custom_param2);
            $('#visualizar').modal('show');
            

//Verificamos si esta confirmado o no, revisando el campo de la bd
            var colorestado = event.color;

            if(colorestado=="#4C78CE"){
             $('#visualizar #estado').html('<p><span style="color: #0000ff;"><strong>Confirmado</strong></span></p>');
            } else{ $('#visualizar #estado').html('<p><span style="color: #039737;"><strong>Por confirmar</strong></span></p>');;;

            }

            return false;
          },

   });
  });
   