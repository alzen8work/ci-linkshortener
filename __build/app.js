console.log($(document.currentScript).attr('src')); //load url of the script

var html;
var url;

function init_detail() {
	if(typeof proj_dev !== 'undefined') console.log('||===> func :init_detail()');
	init_default();
	var s_code	= ( typeof shortcode == 'undefined' || shortcode === '' ) ? '' : shortcode;
	var	s_title	= ( typeof swal_title == 'undefined' || swal_title === '' ) ? '' : swal_title;
	var s_done	= ( typeof btn_done == 'undefined' || btn_done === '' ) ? 'Done' : btn_done;
	var s_info	= ( typeof copy_url == 'undefined' || copy_url === '' ) ? 'Test' : copy_url;
	var html = '';
	
	var param_analytics = s_code.replace(/^https?\:\/\//i, "");
	
	if(s_code != ''){	
		html += "<input id='swal-input1' class='swal2-input' value='"
		html += s_code;
		html += "' disabled />";
		html += "<a target='_blank' href='"+base_url+'analytics/'+param_analytics+"' class=''>"+btn_analytics;
		html += "&nbsp;<i class='fa fa-external-link'></i>";
		html += "</a>";
		
		swal({
			// type				:'input',
			html				:html,
			inputPlaceholder:	"Write something",
			title				:s_title,
			confirmButtonText	:s_done,
			text				:html,
		});
		// $swal_target = $('.sweet-alert input[type=text]:first' );
		// $swal_target.val(s_code);
		// $swal_target.prop('disabled', true);
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

function LoginModal($show=1){
	if(typeof proj_dev !== 'undefined') console.log('||===> func :showLoginModal()');
	if($show != '' && $show != 0) {
		url = window.location.hostname + window.location.pathname;
		showModal('#modal_login',location.protocol+'//'+url+'?login');
	} else {
		url = window.location.hostname + window.location.pathname;
		hideModal('#modal_login',location.protocol+'//'+url+'');
	}
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :showLoginModal()');
}

function event_btn(){
	if(typeof proj_dev !== 'undefined') console.log('||===> func :event_btn()');
	if($('.btn_login').length > 0) {
		$('.btn_login').click(function(){ LoginModal(1);});
	}
	
	if($('.form_login_close').length > 0) {
		$('.form_login_close').click(function(){ LoginModal(0); });
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
