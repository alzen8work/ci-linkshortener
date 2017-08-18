console.log($(document.currentScript).attr('src'));

function showLoginModal(){
	$('#modal_login').modal({
		backdrop: 'static',
		keyboard: false
	})
}

function event_btn(){
	if($('.btn_login').length > 0)
	{
		$('.btn_login').click(function(){
			showLoginModal();
		});
	}
}

function init_default(){
	event_btn();
}

function init_404(){
	init_default();
}