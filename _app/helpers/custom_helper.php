<?php
if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

if ( ! function_exists('_debug_array'))
{
	function _debug_array($arr) {
		echo "<pre>".print_r($arr,true)."</pre>\n";
	}
}

if ( ! function_exists('current_url'))
{
	function current_url() {
		return $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
}

if ( ! function_exists('remove_url_last_slash'))
{
	function remove_url_last_slash($url) {
		if(!empty($url))
		{			
			$slash = substr($url, -1);
			if($slash == '/'){
				$url = rtrim($url,"/");
			}
		}
		return $url;
	}
}


if ( ! function_exists('remove_protocols'))
{
	function remove_protocols($url) {
		$return_val = array();
		$protocol 	= 'http://';
		$disallowed = array('https://', 'http://', '://', '//', ':/');
		foreach($disallowed as $d) {
			if(strpos($url, $d) === 0) {
				$url = str_replace($d, '', $url);
				$protocol = (!empty($d) && ($d == '' || $d == ''))?$d:'http://';
			}
		}
		$return_val['url'] 		= $url;
		$return_val['protocol'] = $protocol;

		return $return_val;
	}
}