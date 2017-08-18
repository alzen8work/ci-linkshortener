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

function init_detail(){
	init_default();
	if(shortcode != '' && (typeof shortcode !== 'undefined') ){					
		swal({
			html: true,
			title: swal_title,
			confirmButtonText:btn_done,
			text:"<span class='well well-sm' id='content'>"+shortcode+"</span>&nbsp;<a target='_blank' href='"+shortcode+"' id='copy_url' class='swal btn btn-default btn-md' data-toggle='tooltip' title='"+copy_url+"'><i class='fa fa-external-link'></i></a>"
		});
	}
}

function init_404(){
	init_default();
}

function init_default(){
	event_btn();
}