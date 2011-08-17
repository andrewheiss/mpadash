$(function() {
	$.simpleWeather({
	        zipcode: '84602',
	        unit: 'f',
	        success: function(weather) {
					html = '<div id="today">'
					html +=	'<img src="'+Drupal.settings.vars.weather_path+weather.code+'.png" />'
					html +=	'<div class="details">'
					html +=	'	<p>'+weather.temp+'&deg; '+weather.units.temp+'</p>'
					html +=	'	<p>'+weather.currently+'</p>'
					html += '	</div>'
					html += '</div>'
					html += '<div id="tomorrow">'
					html += '	<img src="'+Drupal.settings.vars.weather_path+weather.tomorrow.code+'.png" />'
					html += '	<div class="details">'
					html += '		<p><strong>Tomorrow:</strong></p>'
					html += '		<p>'+weather.tomorrow.forecast+'<p>'
					html += '		<p>High: '+weather.tomorrow.high+'&deg; | Low: '+weather.tomorrow.low+'&deg;</p>'
					html += '	</div>'
					html += '</div>'
	                
	                $("#weather").html(html);
	        },
	        error: function(error) {
	                $("#weather").html("<p>"+error+"</p>");
	        }
	});
	
	var options_time={
	  format: '%I:%M %P',
	};
	var options_date={
	  format: '%A, %B %d, %Y',
	};
	$('#time').jclock(options_time);
	$('#date').jclock(options_date);
	
});