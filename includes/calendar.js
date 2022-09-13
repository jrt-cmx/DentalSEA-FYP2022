document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      // height: 400,
      themeSystem: 'bootstrap5',
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: '',
        center: 'title',
        right: ''
      },
      events: [
        {
          title: 'Presentation',
          start: '2022-06-25T13:30:00',
          end: '2022-06-25T14:00:00'
        },
        // {
        //   title: 'Submission 2',
        //   start: '2022-06-25T21:00:00'
        // },
        // {
        //   title: 'Conference',
        //   start: '2022-04-11',
        //   end: '2022-04-13'
        // },
        // {
        //   title: 'Meeting',
        //   start: '2022-06-12T10:30:00',
        //   end: '2022-06-12T12:30:00'
        // }
      ]
    });
    calendar.render();
  });