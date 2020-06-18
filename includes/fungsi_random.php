<?php
function randomcodeAlpha($len="4") {

	$code = NULL;
	for($i=0;$i<$len;$i++) {
		$char = chr(rand(48,122));
		while(!ereg("[A-Z]", $char)) {
			if($char == $lchar) { continue; }
			$char = chr(rand(48,90));
		}
		$pass .= $char;
		$lchar = $char;
	}
	return $pass;

} // END randomcode() FUNCTION

function randomcodeNumeric($len="2") {

	$code = NULL;
	for($i=0;$i<$len;$i++) {
		$char = chr(rand(48,122));
		while(!ereg("[0-9]", $char)) {
			if($char == $lchar) { continue; }
			$char = chr(rand(48,90));
		}
		$pass .= $char;
		$lchar = $char;
	}
	return $pass;

} // END randomcode() FUNCTION

function randomProductCode($len="13") {

	$code = NULL;
	for($i=0;$i<$len;$i++) {
		$char = chr(rand(48,122));
		while(!ereg("[0-9]", $char)) {
			if($char == $lchar) { continue; }
			$char = chr(rand(48,90));
		}
		$pass .= $char;
		$lchar = $char;
	}
	return $pass;

} // END randomcode() FUNCTION
?>