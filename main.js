function readMore(e){
	e.preventDefault();
	$(this).next().toggle('slow');
}
function refresh(e){
	e.preventDefault();
	window.location.href = '/';
}
function newQuestion(e){
	e.preventDefault();
	var updatePart = $(this).attr('data-part');
	var updateQ = $(this).attr('data-q');
	$.ajax({
		type: 'POST',
		url: '/update.php',
		data: {'updatePart': updatePart, 'updateQ': updateQ},
		success: function(dataResp){
			$("#question_"+updatePart).html(dataResp);
			$(".readMore").unbind();
			$(".readMore").bind('click', readMore);
			$(".newQuestion").unbind();
			$(".newQuestion").bind('click', newQuestion);
		},
	});
}
$(".refresh").bind('click', refresh);
$(".readMore").bind('click', readMore);
$(".newQuestion").bind('click', newQuestion);