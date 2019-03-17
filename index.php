<?php 
/*
СГЕНЕРИРОВАННЫЕ БИЛЕТЫ НЕ ПОДЛЕЖАТ ВАЛИДАЦИИ НА ТЕРМИНАЛАХ КОНТРОЛЯ !!!
НЕ ЯВЛЯЮТСЯ СРЕДСТВОМ ПОДТВЕРЖДЕНИЯ ОПЛАТЫ ПРОЕЗДА
СГЕНЕРИРОВАННЫЕ ИЗОБРАЖЕНИЕ (БИЛЕТ) - СОЗДАН В ДЕМОНСТРАЦИОННЫХ ЦЕЛЯХ
*/

?>
<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta name="keywords" content="-" />
		<meta name="author" content="-" />
		<meta name="description" content="-" />
		
		<script src="./jquery/jquery.js"></script>
		<script src="./jquery/jquery-ui.js"></script>
		
		<link rel="stylesheet" type="text/css" href="./jquery/jquery-ui.css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans|PT+Sans|Roboto" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/main.css" />
		<title>СЗППК - тестовый билет</title>
</head>
	<body>
		<div class="wrapper">
			<div class="header">
				
			</div>
			<div class="container">
				<form action="#" method="post">
					<br>
					<h2>ГЕНЕРАТОР БИЛЕТОВ</h3>
					<br>
					<h2>СТАНЦИЯ ОТПРАВЛЕНИЯ</h3>
					<input type="text" name="start" class="namestation" autocomplete="off">
					<h2>СТАНЦИЯ НАЗНАЧЕНИЯ</h3>
					<input type="text" name="finish" class="namestation" autocomplete="off"><br><br>
					<input type="submit" class="buy btn btn-orange" value="ПОКАЗАТЬ БИЛЕТ" onclick="return false;">
				</form>
			</div>
			<div class="response"></div>
		</div>
	</body>
</html>

<script>
	$(document).ready(function(){
    	$('.namestation').keyup(function()
    	{
    		var station = $(this).attr('name');
    		$(".response").html('');
		    var text = $(this).val();
		    if( text.length >= 3)
		    {
				$.ajax({
					            type: 'POST',
					            url: './allstation.php',
					            data: { text: text },
					            beforeSend: function(){
					            						$(".response").html('');
					                                  },
					            success: function(data) {
					            							var jsondata = $.parseJSON(data);
					            							$.each(jsondata,function(index,value){
					            								$(".response").append("<div><button class='autocomplite btn btn-green' value='" + value + "' station='" + station + "'>" + value +"</button></div>");
					            							});
												        }				        
						});
		    }
		    else
		    {
		    	$('#search_response').html('');
		    	$('#search_response').append("ошибка - запрос менее 3 символов");
		    }
    	});
    	
    	$("body").on("click",".autocomplite", function()
    	{
    		var station = $(this).attr('station');
    		var name_station = $(this).attr('value');
    		$("input[name='"+ station +"']").val(name_station);
    		$(".response").html('');
    	});
    	
    	/* покупка билета */
    	$(".buy").click(function()
    	{
    		var start = $("input[name='start']").val().toLowerCase();
    		start = capitalizeMe(start);
    		var finish = $("input[name='finish']").val().toLowerCase();
    		finish = capitalizeMe(finish);
				$.ajax({
					            type: 'POST',
					            url: './nwppk.php',
					            data: { start: start, finish: finish },
					            beforeSend: function(){
					            						$(".response").html('подождите, идёт обработка запроса...');
					                                  },
					            success: function(data) {
					            							$(".response").html('');
					            							$(".response").html("<button class='myticket btn btn-green' link='"+data+"'>ОТКРЫТЬ БИЛЕТ</button>");
												        }				        
						});    		
    	});
    	
    	$("body").on("click",".myticket", function()
    	{
    		var link = $(this).attr('link');
    		document.location.href=link;
    	});
    	
    	function capitalizeMe(val)
    	{
    	return val.charAt(0).toUpperCase()+val.substr(1).toLowerCase();
		}
	});
</script>