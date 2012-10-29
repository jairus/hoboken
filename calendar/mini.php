<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<base target="_parent" />
<link rel="stylesheet" type="text/css" href="css/fullcalendar-mini.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/fullcalendar.min.js"></script>

<script>
$(document).ready(function() {
	$('#calendar').fullCalendar({	
			header: {
				left: 'title',
				center: '',
				right: 'prev, next'
			},
			
			eventSources: [

        // your event source
        {
            url: 'hoboken-events-mini.php', // use the `url` property
            className: 'hoboken-events',
        },
        {
            url: 'mommies-events-mini.php', // use the `url` property
            className: 'mommies-events',
        }

        // any other sources...

    ],
			
			timeFormat: 'h(:mm)tt',
			
			// add event name to title attribute on mouseover
        eventMouseover: function(event, jsEvent, view) {
            if (view.name !== 'agendaDay') {
                $(jsEvent.target).attr('title', event.title);
            }
        }
			
			
			
		});
		
	});
</script>
</head>

<body>
<div id="calendar"></div>
</body>
</html>