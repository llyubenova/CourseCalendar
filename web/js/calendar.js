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
			console.log(html);
			$('#'+target_div).html(html);
		}
	});
	return false;
}

$(document).ready(function(){
	$('.date_cell').mouseenter(function(){
		date = $(this).attr('date');
		$(".date_popup_wrap").fadeOut();
		$("#date_popup_"+date).fadeIn();	
	});
	$('.date_cell').mouseleave(function(){
		$(".date_popup_wrap").fadeOut();		
	});
	$('.month_dropdown').on('change',function(){
		getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
	});
	$('.year_dropdown').on('change',function(){
		getCalendar('calendar_div',$('.year_dropdown').val(),$('.month_dropdown').val());
	});
	$(document).click(function(){
		$('#event_list').slideUp('slow');
	});
});