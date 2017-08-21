<?php

$lang['txt[language]'] 		        	= 'language'; //
$lang['txt[english]'] 		        	= 'english'; //
$lang['txt[chinese_simplified]'] 		= '简体中文'; //

//db fields
//urls table
$lang['txt[url]'] 		        	= 'url'; //网址
$lang['txt[protocol]']              = 'protocol'; //协议
$lang['txt[url_id]'] 		    	= 'url_id'; //网址ID
$lang['txt[alias]'] 		        = 'alias'; //缩短网址

//app default configs
$lang['app[skin]'] 	            	='skin-1'; //no-skin //skin-1 //skin-2 //skin-3 no-skin
$lang['app[slogan]']            	='';
$lang['app[name]'] 					='link shortener'; //网址缩短
$lang['app[name_2]'] 				='link shortener analytics'; //网址缩短分析
$lang['app[name_3]'] 				='<b> link shortener </b> analytics'; //网址缩短分析


$lang['app[name_full]']	            ='Link Shortener Analytics'; //网址缩短分析

$lang['app[owner_name]']			= ' Alexander Teh '; //郑 亚历山大
$lang['app[owner_title]']			= ' Fullstack Web Developer '; //全栈网站应用程序人员
$lang['app[owner_comp]']			= ' Alzen8work ';
$lang['app[copy]']					=' Copyright © 2014 -'; ///版权所有©2014 -.date("Y");
$lang['app[copy2]']					=' © '; ///版权所有©2014 -.date("Y");
$lang['app[right]']					= ' All rights reserved. '; //保留所有权利

$lang['app[version]']				= ' <b>Version</b> 1.0.0';
$lang['app[img]']					='https://lovely.ninja/icon.png';
$lang['app[img_2]']					='https://lovely.ninja/icon_analytic.png';

//navigation links
$lang['url[home]'] 					= base_url(); //shorturl detail page
$lang['url[profile]']				='https://lovely.ninja';
$lang['url[shortcode]'] 			= base_url('shortcode');
$lang['url[login]'] 			    = base_url('login');

//standard button for this module
$lang['btn[shorten_url]']			= 'shorten URL'; //缩短网址
$lang['btn[your_shorten_url]']		= 'your short URL'; //你的短网址
$lang['btn[done]']					= 'done'; //完成
$lang['btn[home]']					= 'home'; //主页按钮
$lang['btn[login]']					= 'sign in';//登录
$lang['btn[register]']				= 'sign up'; // 注册
$lang['btn[more_info]']				= 'more info'; // 注册

//standard notified msg
$lang['msg[invalid]']				= 'invalid submission'; //提交无效
$lang['msg[saved]']					= 'record saved'; //记录保存
$lang['msg[deleted]']				= 'record deleted'; //记录删除
$lang['msg[generated]']				= 'record generated'; //记录生成


//404 page
$lang['msg[404_main]']				= '404 Page Not Found';
$lang['msg[404_desc]']				= '<p style="line-height:2em"> <i> %s </i> does not exist.</p> <small>If you typed in or copied/pasted this URL, make sure you included all the characters, with no extra punctuation.</small>';

$lang['msg[already_exist]']		    = 'this %s is already being used.'; //这个％s已经被使用了。

//detail page
$lang['shorten[header]']			= 'symplify your links'; //缩短你的网址
$lang['shorten[analytics]']			= 'see analytics data'; //查看分析数据


//login page
$lang['login[email]']				= 'email'; //'电子邮件'; //
$lang['login[password]']			= 'password'; //'密码'; //

//analytics page
$lang['analytics[header]'] 		    = 'analytics data for '; //分析数据

$lang['analytics[short_url]'] 		= '->';
$lang['analytics[created_on]'] 		= 'created on '; //创建于
$lang['analytics[long_url]'] 		= 'original URL : '; //原始网址
$lang['analytics[total_clicks]'] 	= 'total clicks '; //总点击次数
$lang['analytics[timeframe]'] 	    = 'timeframe : '; //大体时间
$lang['analytics[referrers]'] 	    = 'referrers'; //引荐
$lang['analytics[browsers]'] 	    = 'browsers '; //浏览器
$lang['analytics[countries]'] 	    = 'countries '; //国家
$lang['analytics[platforms]'] 	    = 'platforms '; //平台
$lang['analytics[more_info]']       = 'more info '; //更多信息
$lang['analytics[clicks]']          = 'clicks'; //点击
$lang['analytics[type]']            = 'type';//类别

$lang['analytics[compare]']         = 'comparison'; //对照
$lang['analytics[referrer_url]']    = 'referral URL'; //转介网址