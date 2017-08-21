console.log($(document.currentScript).attr('src')); //load url of the script

var html;

function init_detail() {
	if(typeof proj_dev !== 'undefined') console.log('||===> func :init_detail()');
	init_default();
	var s_code	= ( typeof shortcode == 'undefined' || shortcode === '' ) ? '' : shortcode;
	var	s_title	= ( typeof swal_title == 'undefined' || swal_title === '' ) ? '' : swal_title;
	var s_done	= ( typeof btn_done == 'undefined' || btn_done === '' ) ? 'Done' : btn_done;
	var s_info	= ( typeof copy_url == 'undefined' || copy_url === '' ) ? 'Test' : copy_url;
	
	var html = '';
	
	if(s_code != ''){	
		
		html += "<span class='well well-sm' id='content'>"+s_code+"</span>&nbsp;";
		html += "<a target='_blank' href='"+s_code+"' class='swal btn btn-default btn-md'>";
		html += "<i class='fa fa-external-link'></i>";
		html += "</a>";
		
		swal({
			html				:true,
			// type				:'success',
			title				:s_title,
			confirmButtonText	:s_done,
			text				:html,
		});
	}
	placeURL(base_url);
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :init_detail()');
}
function init_404() {
	if(typeof proj_dev !== 'undefined') console.log('||===> func :init_404()');
	init_default();
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :init_404()');
}
function init_default() {
	if(typeof proj_dev !== 'undefined') console.log('||===> func :init_default()');
	event_btn();
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :init_default()');
}
function showLoginModal(){
	if(typeof proj_dev !== 'undefined') console.log('||===> func :showLoginModal()');
	$('#modal_login').modal({
		backdrop: 'static',
		keyboard: false
	});
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :showLoginModal()');
}


function event_btn(){
	if(typeof proj_dev !== 'undefined') console.log('||===> func :event_btn()');
	if($('.btn_login').length > 0) {
		$('.btn_login').click(function(){
			showLoginModal();
		});
	}
	
	if($('.change_lang').length > 0) {
		$('.change_lang').click(function(e) {
			if(typeof $(e.target).attr('data-id') !== 'undefined') {
				// swal($(e.target).attr('data-id'));
				insertParam('lang',$(e.target).attr('data-id'));
			} else {
				insertParam('lang','english');
			}
		});
	}
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :event_btn()');
}
