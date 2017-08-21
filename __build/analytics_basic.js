console.log($(document.currentScript).attr('src'));
var item_referrer   = [];
var item_browser    = [];
var item_country    = [];
var item_platform   = [];
var count_referrer  = {};
var count_browser   = {};
var count_country   = {};
var count_platform  = {};

// console.log(s_base_url);
// console.log(s_code);
// console.log(shortcode_url);
// console.log(shortcode_display);
	
function init_analytics(){
	if(typeof proj_dev !== 'undefined') console.log('||===> func :init_analytics()');
	init_default();
	var s_code		= ( typeof shortcode == 'undefined' || shortcode === '' ) ? '' : shortcode;
	var s_base_url	= ( typeof base_url == 'undefined' || base_url === '' ) ? '' : base_url;
	if (s_code != '' && s_base_url != '') {
		
		//set up page's header
		$('.shortcode_url').attr('href',shortcode_url);
		$('.shortcode_display').text(shortcode_display);
		
		//set ajax populated function
		populateData    = populateAnalytics; //set populateData to become pupulateAnalytics 
		api_path        = s_base_url+'api/';
		ajaxGetRecord(s_code,api_path); // get data from API
	}
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :init_analytics()');
}

// ajaxUsedFunction for analytics
var populateAnalytics = function (e) {
	if(typeof proj_dev !== 'undefined') console.log('||===> func :populateAnalytics()');
    //console.log(e);
    generateAnalyticsCounts(e.details);
  
		//long url populate
		$('a.long_url').attr('href',e.long_url);
		$('span.long_url').text(e.long_url);
		
		//created_on populate
		$('span.created_on').text(php_date("M d, Y", php_strtotime(e.created_on)));
		
		//total_clicks populate
		$('span.total_clicks').text(e.total_clicks);
	
		// console.log(count_browser);
	  $.each(count_browser, function(key, val) {
	  		console.log(key + ':' + val);
	  		
	  		percent = val / e.total_clicks * 100;
	  		console.log('percent');
	  		console.log(percent);
	  		
				html += '<tr>';
				html += '<td>'+key.toUpperCase()+'</td>';
				html += '<td><div class="progress progress-xs">';
				html += '<div class="progress-bar progress-bar-warning" style="width: '+percent+'%"></div>';
				html += '</div></td>';
				html += '<td><span class="badge bg-red">'+val+'</span></td>';
				html +='</tr>';
	  });
	  
		$('.populate_browser').html(html);
		
		html = '';
		
		console.log(count_referrer);
	  $.each(count_referrer, function(key, val) {
	  		console.log(key + ':' + val);
	  		var txt = key;
	  		if(txt.length > 70){
				    txt = txt.substr(0, 70) + "...";
				}
	  		if(key == "") key = 'unknown';
				html += '<tr>';
				html += '<td><span class="badge bg-light-green">'+val+'</span></td>';
				html += '<td><a target="_blank" href="'+key+'">'+txt+'</a></td>';
				html +='</tr>';
	  });
	  
		$('.populate_referrer').html(html);
		html = '';
		
		console.log(count_country);
	  $.each(count_country, function(key, val) {
	  		console.log(key + ':' + val);
	  		var txt = key;
	  		if(txt.length > 70){
				    txt = txt.substr(0, 70) + "...";
				}
	  		if(key == "") key = 'unknown';
				html += '<tr>';
				html += '<td><span class="badge bg-green">'+val+'</span></td>';
				html += '<td><a target="_blank" href="'+key+'">'+txt+'</a></td>';
				html +='</tr>';
	  });
	  
		$('.populate_country').html(html);
		html = '';
	
		// console.log(count_platform);
	  $.each(count_platform, function(key, val) {
	  		console.log(key + ':' + val);
	  		
	  		percent = val / e.total_clicks * 100;
	  		console.log('percent');
	  		console.log(percent);
	  		
				html += '<tr>';
				html += '<td>'+key.toUpperCase()+'</td>';
				html += '<td><div class="progress progress-xs">';
				html += '<div class="progress-bar progress-bar-info" style="width: '+percent+'%"></div>';
				html += '</div></td>';
				html += '<td><span class="badge bg-blue">'+val+'</span></td>';
				html +='</tr>';
	  });
	  
		$('.populate_platform').html(html);
		
	
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :populateAnalytics()');
}


function populateObjectToTable(object,target_tbody){
	
	  $.each(object, function(key, val) {
	  		console.log(key + ':' + val);
	  		
	  		percent = val / e.total_clicks * 100;
	  		console.log('percent');
	  		console.log(percent);
	  		
				html += '<tr>';
				html += '<td>'+key.toUpperCase()+'</td>';
				html += '<td><div class="progress progress-xs">';
				html += '<div class="progress-bar progress-bar-primary" style="width: '+percent+'%"></div>';
				html += '</div></td>';
				html += '<td><span class="badge bg-blue">'+val+'</span></td>';
				html +='</tr>';
	  });
	  
		target_tbody.html(html);
}

//count referrer, browser, country, platform
function generateAnalyticsCounts(details){
	if(typeof proj_dev !== 'undefined') console.log('||===> func :generateAnalyticsCounts()');
      details.forEach(function(item){ 
        // allocate click.item accordingly;
        item_referrer.push(item.referrer);
        item_browser.push(item.browser);
        item_country.push(item.country);
        item_platform.push(item.platform);
      });
      
      // count item and place it in a count Object;
      count_referrer    = countArray(item_referrer);
      count_country     = countArray(item_country);
      count_browser     = countArray(item_browser);
      count_platform    = countArray(item_platform);
	if(typeof proj_dev !== 'undefined')	console.log('<===|| func :generateAnalyticsCounts()');
}

function progressbar(){
		// swal({
		// 	html:true,
		// 	// type:'success',
		// 	title:'<i class="fa fa-spinner fa-pulse" style="color:green;"></i>',
		// 	text:'loading analytical data...',

		// });
}