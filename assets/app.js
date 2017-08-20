console.log($(document.currentScript).attr('src'));

var ajaxObject;
var details;
var details_new;
var html;
var api_path        = '';
var item_referrer   = [];
var item_browser    = [];
var item_country    = [];
var item_platform   = [];
var count_referrer  = {};
var count_browser   = {};
var count_country   = {};
var count_platform  = {};
var chart_label     = ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"]; 
var chart_type      = 'bar';
var chartReferrer;
var chartBrowser;
var chartCountry;
var chartPlatform;

function count_array(array_elements) {
    array_elements.sort();
    var current = null;
    var cnt = 0;
    var countObj = {};
    
    for (var i = 0; i < array_elements.length; i++) {
        if (array_elements[i] != current) {
            if (cnt > 0) {
                // document.write(current + ' comes --> ' + cnt + ' times<br>');
                // console.log(current + ' comes --> ' + cnt + ' times<br>');
                countObj[current] = cnt;
            }
            current = array_elements[i];
            cnt = 1;
        } else {
            cnt++;
        }
    }
    if (cnt > 0) {
        // document.write(current + ' comes --> ' + cnt + ' times');
        // console.log(current + ' comes --> ' + cnt + ' times');
        countObj[current] = cnt;
    }
    return countObj;

}

//count referrer, browser, country, platform
function generateAnalyticsCounts(details){
  details.forEach(function(item){ 
    // allocate click.item accordingly;
    item_referrer.push(item.referrer);
    item_browser.push(item.browser);
    item_country.push(item.country);
    item_platform.push(item.platform);
  });
  
  // count item and place it in a count Object;
  count_referrer = count_array(item_referrer);
  count_country = count_array(item_country);
  count_browser = count_array(item_browser);
  count_platform = count_array(item_platform);
}

function debug_mode_for_analytics(e) {
  $.each(e, function(key, val) {
      if(key != 'details'){
        // console.log(key + ':' + val);
        html ='';
        html +='<div class="col-md-6 '+key+'">';
        html +='<div class="col-md-2 key">'+key;
        html +='</div>';
        html +='<div class="col-md-4 val">'+val;
        html +='</div></div>';
        $('.well.load_header').append(html);
    
      }else{
        
        details = val;
      }
  });
  $('.well.load_json').append(html);
  
  
  $.each(details, function(d_key , d_val) {
        // console.log(d_key);
        $.each(d_val, function(dd_key , dd_val) {
            // console.log(dd_key);
            // console.log(dd_val);
            // console.log(dd_key + ':' + dd_val);
            html ='';
            html +='<div class="col-lg-12 '+dd_key+'">';
            html +='<div class="col-lg-2">'+dd_key;
            html +='</div>';
            html +='<div class="col-lg-10">'+dd_val;
            html +='</div></div>';
            $('.well.load_detail').append(html);
        });
        
        html ='<div class="col-lg-12"><hr></div>';
        $('.well.load_detail').append(html);
  });
}

// ajaxUsedFunction for analytics
var populateAnalytics = function (e){
	console.log('||===> func :populateAnalytics()');
// 	console.log(e);
  html ='';
  details = '';
  generateAnalyticsCounts(e.details);
  // debug_mode_for_analytics(e);
  
  //long url
	$('a.long_url').attr('href',e.long_url);
	$('span.long_url').text(e.long_url);
	
	//created_on
	$('span.created_on').text(php_date("M d, Y", php_strtotime(e.created_on)));
	
	//total_clicks
	$('span.total_clicks').text(e.total_clicks);
	
	
	
	console.log('<===|| func :populateAnalytics()');
}

//default ajaxUsedFunction
var populateData = function (e){
	console.log('||===> func :populateData()');
	console.log(e);
	//~ check if custInfoByID function exist in this controller if do execute
	// if ( $.isFunction( window.init_analytics) ) {
	// 	init_analytics(ajaxObject);
	// }
	// else {
	// 	console.log('func: no init_analytics');
	// }
	console.log('<===|| func :populateData()');
}



function ajaxGetRecord(doc_id,api_path){
	console.log('||===> func :ajaxGetRecord()');
	ajaxObject = '';
	if(typeof doc_id !== 'undefined' && doc_id != '')
	{
		$.ajax({
			url: api_path+doc_id,
			dataType:"json",
			// data: { id:doc_id }, //?id = $_GET['id'] at php controller
			// async: false,
		})
		.done(function(e) {
	  	// console.log( ".done" );
			// console.log(e.success);

			if(e.success){
				// console.log( "e.success" );
				// console.log(e);
				ajaxObject = e;
				populateData(e);
			}else{
				// console.log( "error" );
				// return_val = false;
			}
		})
		.fail(function() {
			console.log( "something went wrong" );
			// return_val = false;
		})
		.always(function() {
			console.log( "complete" );
		})
		;
	}
	console.log('<===|| func :ajaxGetRecord()');
}

function client_info(){
	// swal(navigator.platform);
	// swal(navigator.appName); //incorrect
	// swal(navigator.appName);
}

function init_chartjs(target,type,labels){
  
	var s_type	= ( typeof type == 'undefined' || type === '' ) ? 'bar' : type;
	var s_labels		= ( typeof labels == 'undefined' || labels === '' ) ?  ["Red", "Blue"] : labels;
  
  
   chartBrowser = new Chart(target, {
    type: s_type,
    data: {
        labels: s_labels,
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
  });
}

function init_analytics(){
	init_default();
	var s_code		= ( typeof shortcode == 'undefined' || shortcode === '' ) ? '' : shortcode;
	var s_base_url	= ( typeof base_url == 'undefined' || base_url === '' ) ? '' : base_url;
	
	
	
	
	//'bar' //'radar'//'pie'//'doughnut'//'polarArea'//'bubble' //'line' //'scatter'
	chart_type  = 'bar'; 
	chart_label = ["chrome", "Blue", "Yellow", "Green", "Purple", "Orange"]; 
  init_chartjs($("#pieChart"),chart_type,chart_label);
	
    // Any of the following formats may be used
  // var ctx = document.getElementById("myChart");
  // var ctx = document.getElementById("myChart").getContext("2d");
  // var ctx = "myChart";
 

	if (s_code != '' && s_base_url != '') {
		
		//set up page's header
		$('.shortcode_url').attr('href',shortcode_url);
		$('.shortcode_display').text(shortcode_display);
		
		
		// console.log(s_base_url);
		// console.log(s_code);
		// console.log(shortcode_url);
		// console.log(shortcode_display);
		
		//set ajax populated function
		populateData = populateAnalytics;
		var api_path = s_base_url+'api/';
		ajaxGetRecord(s_code,api_path); // get data from API
		
		// swal({
		// 	html:true,
		// 	// type:'success',
		// 	title:'<i class="fa fa-spinner fa-pulse" style="color:green;"></i>',
		// 	text:'loading analytical data...',

		// });
	}
}

function init_detail(){
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
}

function init_404(){
	init_default();
	client_info();
}

function init_default(){
	event_btn();
}



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

function placeURL(url)
{
	if(typeof url !== 'undefined')
	{
		return window.history.pushState("object or string", "Title", url);
	}
}


function php_strtotime (text, now) {
	
  var parsed
  var match
  var today
  var year
  var date
  var days
  var ranges
  var len
  var times
  var regex
  var i
  var fail = false
  if (!text) {
    return fail
  }
  // Unecessary spaces
  text = text.replace(/^\s+|\s+$/g, '')
    .replace(/\s{2,}/g, ' ')
    .replace(/[\t\r\n]/g, '')
    .toLowerCase()
  var pattern = new RegExp([
    '^(\\d{1,4})',
    '([\\-\\.\\/:])',
    '(\\d{1,2})',
    '([\\-\\.\\/:])',
    '(\\d{1,4})',
    '(?:\\s(\\d{1,2}):(\\d{2})?:?(\\d{2})?)?',
    '(?:\\s([A-Z]+)?)?$'
  ].join(''))
  match = text.match(pattern)
  if (match && match[2] === match[4]) {
    if (match[1] > 1901) {
      switch (match[2]) {
        case '-':
          // YYYY-M-D
          if (match[3] > 12 || match[5] > 31) {
            return fail
          }
          return new Date(match[1], parseInt(match[3], 10) - 1, match[5],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
        case '.':
          // YYYY.M.D is not parsed by strtotime()
          return fail
        case '/':
          // YYYY/M/D
          if (match[3] > 12 || match[5] > 31) {
            return fail
          }
          return new Date(match[1], parseInt(match[3], 10) - 1, match[5],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
      }
    } else if (match[5] > 1901) {
      switch (match[2]) {
        case '-':
          // D-M-YYYY
          if (match[3] > 12 || match[1] > 31) {
            return fail
          }
          return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
        case '.':
          // D.M.YYYY
          if (match[3] > 12 || match[1] > 31) {
            return fail
          }
          return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
        case '/':
          // M/D/YYYY
          if (match[1] > 12 || match[3] > 31) {
            return fail
          }
          return new Date(match[5], parseInt(match[1], 10) - 1, match[3],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
      }
    } else {
      switch (match[2]) {
        case '-':
          // YY-M-D
          if (match[3] > 12 || match[5] > 31 || (match[1] < 70 && match[1] > 38)) {
            return fail
          }
          year = match[1] >= 0 && match[1] <= 38 ? +match[1] + 2000 : match[1]
          return new Date(year, parseInt(match[3], 10) - 1, match[5],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
        case '.':
          // D.M.YY or H.MM.SS
          if (match[5] >= 70) {
            // D.M.YY
            if (match[3] > 12 || match[1] > 31) {
              return fail
            }
            return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
            match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
          }
          if (match[5] < 60 && !match[6]) {
            // H.MM.SS
            if (match[1] > 23 || match[3] > 59) {
              return fail
            }
            today = new Date()
            return new Date(today.getFullYear(), today.getMonth(), today.getDate(),
            match[1] || 0, match[3] || 0, match[5] || 0, match[9] || 0) / 1000
          }
          // invalid format, cannot be parsed
          return fail
        case '/':
          // M/D/YY
          if (match[1] > 12 || match[3] > 31 || (match[5] < 70 && match[5] > 38)) {
            return fail
          }
          year = match[5] >= 0 && match[5] <= 38 ? +match[5] + 2000 : match[5]
          return new Date(year, parseInt(match[1], 10) - 1, match[3],
          match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000
        case ':':
          // HH:MM:SS
          if (match[1] > 23 || match[3] > 59 || match[5] > 59) {
            return fail
          }
          today = new Date()
          return new Date(today.getFullYear(), today.getMonth(), today.getDate(),
          match[1] || 0, match[3] || 0, match[5] || 0) / 1000
      }
    }
  }
  // other formats and "now" should be parsed by Date.parse()
  if (text === 'now') {
    return now === null || isNaN(now)
      ? new Date().getTime() / 1000 | 0
      : now | 0
  }
  if (!isNaN(parsed = Date.parse(text))) {
    return parsed / 1000 | 0
  }
  
  pattern = new RegExp([
    '^([0-9]{4}-[0-9]{2}-[0-9]{2})',
    '[ t]',
    '([0-9]{2}:[0-9]{2}:[0-9]{2}(\\.[0-9]+)?)',
    '([\\+-][0-9]{2}(:[0-9]{2})?|z)'
  ].join(''))
  match = text.match(pattern)
  if (match) {
    // @todo: time zone information
    if (match[4] === 'z') {
      match[4] = 'Z'
    } else if (match[4].match(/^([+-][0-9]{2})$/)) {
      match[4] = match[4] + ':00'
    }
    if (!isNaN(parsed = Date.parse(match[1] + 'T' + match[2] + match[4]))) {
      return parsed / 1000 | 0
    }
  }
  date = now ? new Date(now * 1000) : new Date()
  days = {
    'sun': 0,
    'mon': 1,
    'tue': 2,
    'wed': 3,
    'thu': 4,
    'fri': 5,
    'sat': 6
  }
  ranges = {
    'yea': 'FullYear',
    'mon': 'Month',
    'day': 'Date',
    'hou': 'Hours',
    'min': 'Minutes',
    'sec': 'Seconds'
  }
  function lastNext (type, range, modifier) {
    var diff
    var day = days[range]
    if (typeof day !== 'undefined') {
      diff = day - date.getDay()
      if (diff === 0) {
        diff = 7 * modifier
      } else if (diff > 0 && type === 'last') {
        diff -= 7
      } else if (diff < 0 && type === 'next') {
        diff += 7
      }
      date.setDate(date.getDate() + diff)
    }
  }
  function process (val) {
    // @todo: Reconcile this with regex using \s, taking into account
    // browser issues with split and regexes
    var splt = val.split(' ')
    var type = splt[0]
    var range = splt[1].substring(0, 3)
    var typeIsNumber = /\d+/.test(type)
    var ago = splt[2] === 'ago'
    var num = (type === 'last' ? -1 : 1) * (ago ? -1 : 1)
    if (typeIsNumber) {
      num *= parseInt(type, 10)
    }
    if (ranges.hasOwnProperty(range) && !splt[1].match(/^mon(day|\.)?$/i)) {
      return date['set' + ranges[range]](date['get' + ranges[range]]() + num)
    }
    if (range === 'wee') {
      return date.setDate(date.getDate() + (num * 7))
    }
    if (type === 'next' || type === 'last') {
      lastNext(type, range, num)
    } else if (!typeIsNumber) {
      return false
    }
    return true
  }
  times = '(years?|months?|weeks?|days?|hours?|minutes?|min|seconds?|sec' +
    '|sunday|sun\\.?|monday|mon\\.?|tuesday|tue\\.?|wednesday|wed\\.?' +
    '|thursday|thu\\.?|friday|fri\\.?|saturday|sat\\.?)'
  regex = '([+-]?\\d+\\s' + times + '|' + '(last|next)\\s' + times + ')(\\sago)?'
  match = text.match(new RegExp(regex, 'gi'))
  if (!match) {
    return fail
  }
  for (i = 0, len = match.length; i < len; i++) {
    if (!process(match[i])) {
      return fail
    }
  }
  return (date.getTime() / 1000)
}

function php_date (format, timestamp) {
  var jsdate, f
  // Keep this here (works, but for code commented-out below for file size reasons)
  // var tal= [];
  var txtWords = [
    'Sun', 'Mon', 'Tues', 'Wednes', 'Thurs', 'Fri', 'Satur',
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
  ]
  var formatChr = /\\?(.?)/gi
  var formatChrCb = function (t, s) {
    return f[t] ? f[t]() : s
  }
  var _pad = function (n, c) {
    n = String(n)
    while (n.length < c) {
      n = '0' + n
    }
    return n
  }
  f = {
    // Day
    d: function () {
      // Day of month w/leading 0; 01..31
      return _pad(f.j(), 2)
    },
    D: function () {
      // Shorthand day name; Mon...Sun
      return f.l()
        .slice(0, 3)
    },
    j: function () {
      // Day of month; 1..31
      return jsdate.getDate()
    },
    l: function () {
      // Full day name; Monday...Sunday
      return txtWords[f.w()] + 'day'
    },
    N: function () {
      // ISO-8601 day of week; 1[Mon]..7[Sun]
      return f.w() || 7
    },
    S: function () {
      // Ordinal suffix for day of month; st, nd, rd, th
      var j = f.j()
      var i = j % 10
      if (i <= 3 && parseInt((j % 100) / 10, 10) === 1) {
        i = 0
      }
      return ['st', 'nd', 'rd'][i - 1] || 'th'
    },
    w: function () {
      // Day of week; 0[Sun]..6[Sat]
      return jsdate.getDay()
    },
    z: function () {
      // Day of year; 0..365
      var a = new Date(f.Y(), f.n() - 1, f.j())
      var b = new Date(f.Y(), 0, 1)
      return Math.round((a - b) / 864e5)
    },
    // Week
    W: function () {
      // ISO-8601 week number
      var a = new Date(f.Y(), f.n() - 1, f.j() - f.N() + 3)
      var b = new Date(a.getFullYear(), 0, 4)
      return _pad(1 + Math.round((a - b) / 864e5 / 7), 2)
    },
    // Month
    F: function () {
      // Full month name; January...December
      return txtWords[6 + f.n()]
    },
    m: function () {
      // Month w/leading 0; 01...12
      return _pad(f.n(), 2)
    },
    M: function () {
      // Shorthand month name; Jan...Dec
      return f.F()
        .slice(0, 3)
    },
    n: function () {
      // Month; 1...12
      return jsdate.getMonth() + 1
    },
    t: function () {
      // Days in month; 28...31
      return (new Date(f.Y(), f.n(), 0))
        .getDate()
    },
    // Year
    L: function () {
      // Is leap year?; 0 or 1
      var j = f.Y()
      return j % 4 === 0 & j % 100 !== 0 | j % 400 === 0
    },
    o: function () {
      // ISO-8601 year
      var n = f.n()
      var W = f.W()
      var Y = f.Y()
      return Y + (n === 12 && W < 9 ? 1 : n === 1 && W > 9 ? -1 : 0)
    },
    Y: function () {
      // Full year; e.g. 1980...2010
      return jsdate.getFullYear()
    },
    y: function () {
      // Last two digits of year; 00...99
      return f.Y()
        .toString()
        .slice(-2)
    },
    // Time
    a: function () {
      // am or pm
      return jsdate.getHours() > 11 ? 'pm' : 'am'
    },
    A: function () {
      // AM or PM
      return f.a()
        .toUpperCase()
    },
    B: function () {
      // Swatch Internet time; 000..999
      var H = jsdate.getUTCHours() * 36e2
      // Hours
      var i = jsdate.getUTCMinutes() * 60
      // Minutes
      // Seconds
      var s = jsdate.getUTCSeconds()
      return _pad(Math.floor((H + i + s + 36e2) / 86.4) % 1e3, 3)
    },
    g: function () {
      // 12-Hours; 1..12
      return f.G() % 12 || 12
    },
    G: function () {
      // 24-Hours; 0..23
      return jsdate.getHours()
    },
    h: function () {
      // 12-Hours w/leading 0; 01..12
      return _pad(f.g(), 2)
    },
    H: function () {
      // 24-Hours w/leading 0; 00..23
      return _pad(f.G(), 2)
    },
    i: function () {
      // Minutes w/leading 0; 00..59
      return _pad(jsdate.getMinutes(), 2)
    },
    s: function () {
      // Seconds w/leading 0; 00..59
      return _pad(jsdate.getSeconds(), 2)
    },
    u: function () {
      // Microseconds; 000000-999000
      return _pad(jsdate.getMilliseconds() * 1000, 6)
    },
    // Timezone
    e: function () {
      // Timezone identifier; e.g. Atlantic/Azores, ...
      // The following works, but requires inclusion of the very large
      // timezone_abbreviations_list() function.
      /*              return that.date_default_timezone_get();
       */
      var msg = 'Not supported (see source code of date() for timezone on how to add support)'
      throw new Error(msg)
    },
    I: function () {
      // DST observed?; 0 or 1
      // Compares Jan 1 minus Jan 1 UTC to Jul 1 minus Jul 1 UTC.
      // If they are not equal, then DST is observed.
      var a = new Date(f.Y(), 0)
      // Jan 1
      var c = Date.UTC(f.Y(), 0)
      // Jan 1 UTC
      var b = new Date(f.Y(), 6)
      // Jul 1
      // Jul 1 UTC
      var d = Date.UTC(f.Y(), 6)
      return ((a - c) !== (b - d)) ? 1 : 0
    },
    O: function () {
      // Difference to GMT in hour format; e.g. +0200
      var tzo = jsdate.getTimezoneOffset()
      var a = Math.abs(tzo)
      return (tzo > 0 ? '-' : '+') + _pad(Math.floor(a / 60) * 100 + a % 60, 4)
    },
    P: function () {
      // Difference to GMT w/colon; e.g. +02:00
      var O = f.O()
      return (O.substr(0, 3) + ':' + O.substr(3, 2))
    },
    T: function () {
      return 'UTC'
    },
    Z: function () {
      // Timezone offset in seconds (-43200...50400)
      return -jsdate.getTimezoneOffset() * 60
    },
    // Full Date/Time
    c: function () {
      // ISO-8601 date.
      return 'Y-m-d\\TH:i:sP'.replace(formatChr, formatChrCb)
    },
    r: function () {
      // RFC 2822
      return 'D, d M Y H:i:s O'.replace(formatChr, formatChrCb)
    },
    U: function () {
      // Seconds since UNIX epoch
      return jsdate / 1000 | 0
    }
  }
  var _date = function (format, timestamp) {
    jsdate = (timestamp === undefined ? new Date() // Not provided
      : (timestamp instanceof Date) ? new Date(timestamp) // JS Date()
      : new Date(timestamp * 1000) // UNIX timestamp (auto-convert to int)
    )
    return format.replace(formatChr, formatChrCb)
  }
  return _date(format, timestamp)
}


function display() {
	
}
