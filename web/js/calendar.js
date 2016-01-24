function getCalendar(target_div,year,month){
	$.ajax({
		type:'POST',
		url: 'app/getCalendar.php',
		dataType: 'html',
		data: {	
			'year' : year,
			'month' : month
		},
		success:function(html){
			$('#'+target_div).html(html);
		}
	});
	return false;
}

$(document).ready(function(){
	$('.month_dropdown').on('change',function(){
		getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
	});
	$('.year_dropdown').on('change',function(){
		getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
	});
});