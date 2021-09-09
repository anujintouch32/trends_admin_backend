$(document).ready(function () {
	$('ul.nav > li > a').click(function (e) {
	    $('ul.nav > li > a').removeClass('active');
	    $(this).addClass('active');                
	});            
});