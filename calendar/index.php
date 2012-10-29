<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<base target="_parent" />
<link rel="stylesheet" type="text/css" href="css/fullcalendar.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
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
            url: 'hoboken-events.php', // use the `url` property
            className: 'hoboken-events',
        },
        {
            url: 'mommies-events.php', // use the `url` property
            className: 'mommies-events',
        },
        {
            url: 'holiday-events.php', // use the `url` property
            className: 'holiday-events',
        }

        // any other sources...

    ],
    	loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			},
			
			timeFormat: 'h(:mm)tt'
			
			
			
		});
		
	});
</script>
</head>

<body>
<div id="loading" style="display:none"><img src="images/loader.gif" width="16" height="16" alt="loading" border="0" /></div>
<div class="legend"><span class="pink">Mommies Events</a> <span class="blue">Hoboken Events</span></div>
<div id="calendar"></div>
<p>Hoboken's best source for children's classes: <a href="http://www.classdash.com">ClassDash.com</a></p>
</body>
</html>