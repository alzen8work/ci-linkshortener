<?php
if ( ! defined('BASEPATH')) { exit('No direct script access allowed'); }

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
				$protocol = (!empty($d))?$d:'http://';
			}
		}
		$return_val['url'] 		= $url;
		$return_val['protocol'] = $protocol;

		// _debug_array($return_val); exit;
		return $return_val;
	}
}

if ( ! function_exists('gen_code'))
{
	function gen_code($num = '')
	{
		$return_val = '';
		if(!empty($num))
		{
			$code		= $num + 100000000;
			$return_val =  base_convert($code,10,36);
		}
		return $return_val;
	}
}

if ( ! function_exists('_debug_array'))
{
	function _debug_array($arr) {
		echo "<pre>".print_r($arr,true)."</pre>\n";
	}
}

//get_browser data
if ( ! function_exists('get_browser_data'))
{
	function get_browser_data() {
		$return_val = '';
        $ci = get_instance();
        $ci->load->library('user_agent');
        $agent = $ci->agent;
    	$return_val = $agent->browser();
        return (empty($return_val))?'unknown':strtolower($return_val);
	}
}

//get_browser data
if ( ! function_exists('get_browser_version'))
{
	function get_browser_version() {
		$return_val = '';
        $ci = get_instance();
        $ci->load->library('user_agent');
        $agent = $ci->agent;
    	$return_val = $agent->version();
        return (empty($return_val))?'unknown':strtolower($return_val);
	}
}

//get_platform data
if ( ! function_exists('get_platform_data'))
{
	function get_platform_data() {
		$return_val = '';
        $ci = get_instance();
        $ci->load->library('user_agent');
        $agent = $ci->agent;
    	$return_val = $agent->platform();
        return (empty($return_val) || $return_val = 'Unknown Platform')?'unknown':strtolower($return_val);
		
	}
}

//get_agent data
if ( ! function_exists('get_agent'))
{
	function get_agent() {
		return (empty($_SERVER['HTTP_USER_AGENT']))?'no HTTP_USER_AGENT':$_SERVER['HTTP_USER_AGENT'];
	}
}

//get_platform data
if ( ! function_exists('get_referer_data'))
{
	function get_referer_data() {
		$return_val = '';
        $ci = get_instance();
        $ci->load->library('user_agent');
        $agent = $ci->agent;
    	$return_val = $agent->referrer();
        return (empty($return_val))?'unknown':strtolower($return_val);
	}
}

//get user ip infos
if ( ! function_exists('ip_info'))
{
	function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
	    $output = NULL;
	    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
	        $ip = $_SERVER["REMOTE_ADDR"];
	        if ($deep_detect) {
	            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	    }
	    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	    $continents = array(
	        "AF" => "Africa",
	        "AN" => "Antarctica",
	        "AS" => "Asia",
	        "EU" => "Europe",
	        "OC" => "Australia (Oceania)",
	        "NA" => "North America",
	        "SA" => "South America"
	    );
	    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
	        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
	        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
	            switch ($purpose) {
	                case "location":
	                    $output = array(
	                        "city"           => @$ipdat->geoplugin_city,
	                        "state"          => @$ipdat->geoplugin_regionName,
	                        "country"        => @$ipdat->geoplugin_countryName,
	                        "country_code"   => @$ipdat->geoplugin_countryCode,
	                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
	                        "continent_code" => @$ipdat->geoplugin_continentCode
	                    );
	                    break;
	                case "address":
	                    $address = array($ipdat->geoplugin_countryName);
	                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
	                        $address[] = $ipdat->geoplugin_regionName;
	                    if (@strlen($ipdat->geoplugin_city) >= 1)
	                        $address[] = $ipdat->geoplugin_city;
	                    $output = implode(", ", array_reverse($address));
	                    break;
	                case "city":
	                    $output = @$ipdat->geoplugin_city;
	                    break;
	                case "state":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "region":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "country":
	                    $output = @$ipdat->geoplugin_countryName;
	                    break;
	                case "countrycode":
	                    $output = @$ipdat->geoplugin_countryCode;
	                    break;
	            }
	        }
	    }
	    return $output;
	}
}

//get user ip
if ( ! function_exists('user_ip'))
{
	function user_ip() {
		return $_SERVER["REMOTE_ADDR"];
	}
}