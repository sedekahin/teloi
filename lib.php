<?php
function amazonEncode($text) {
    $encodedText = "";
    $j = strlen($text);
    for($i=0;$i<$j;$i++) {
		$c = substr($text,$i,1);
		if (!preg_match("/[A-Za-z0-9\-_.~]/",$c)) {
			$encodedText .= sprintf("%%%02X",ord($c));
		}
		else 
		{
			$encodedText .= $c;
		}
	}
    return $encodedText;
} 


function amazonSign($url,$secretAccessKey) { 
// 0. Append Timestamp parameter    
	$url .= "&Timestamp=".gmdate("Y-m-d\TH:i:s\Z");    
// 1a. Sort the UTF-8 query string components by parameter name    
	$urlParts = parse_url($url);    
	parse_str($urlParts["query"],$queryVars);    
	ksort($queryVars);    
// 1b. URL encode the parameter name and values    
	$encodedVars = array();    
	foreach($queryVars as $key => $value) {
		$encodedVars[amazonEncode($key)] = amazonEncode($value); 
	}    
// 1c. 1d. Reconstruct encoded query    
	$encodedQueryVars = array();    
	foreach($encodedVars as $key => $value) {
		$encodedQueryVars[] = $key."=".$value;    
	}    
	$encodedQuery = implode("&",$encodedQueryVars);    
// 2. Create the string to sign    
	$stringToSign  = "GET";    
	$stringToSign .= "\n".strtolower($urlParts["host"]);    
	$stringToSign .= "\n".$urlParts["path"];    
	$stringToSign .= "\n".$encodedQuery;    
// 3. Calculate an RFC 2104-compliant HMAC with the string you just created,   
//    your Secret Access Key as the key, and SHA256 as the hash algorithm.    
	
	if (function_exists("hash_hmac")) {
		$hmac = hash_hmac("sha256",$stringToSign,$secretAccessKey,TRUE);
	}
    elseif(function_exists("mhash")) {
	$hmac = mhash(MHASH_SHA256,$stringToSign,$secretAccessKey);    
	}
    else
	{
		die("No hash function available!");    
	}    
	// 4. Convert the resulting value to base64    
	$hmacBase64 = base64_encode($hmac);    
	// 5. Use the resulting value as the value of the Signature request parameter    
	// (URL encoded as per step 1b)    
	$url .= "&Signature=".amazonEncode($hmacBase64);    
	return $url;  
}

function SEO($input){ 
    //SEO - friendly URL String Converter    
    //ex) this is an example -> this-is-an-example
    $input = str_replace("&nbsp;", " ", $input);
    $input = str_replace(array("'", "-"), "", $input); //remove single quote and dash
    $input = mb_convert_case($input, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
    $input = preg_replace("#[^a-zA-Z]+#", "-", $input); //replace everything non an with dashes
    $input = preg_replace("#(-){2,}#", "$1", $input); //replace multiple dashes with one
    $input = trim($input, "-"); //trim dashes from beginning and end of string if any
    return $input; 
}

?> 
	