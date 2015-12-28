<?php
include_once '../init.php';
include_once LIB_ROOT . 'third/GTranslate/GTranslate.php';

error_reporting(E_ALL);
ini_set('display_error', 1);

/**
 * Example using RequestHTTP
 */
$translate_string = "在這不自然的世界上，你應得躲避她像你躲避青草裡一條美麗的花蛇！";
try {
	$gt = new Gtranslate();
	$gt->setApiKey("ABQIAAAAqSHtOYfZQAu5HgvVgxccORQFkJYm3b4tkuBKzPIo19dX7oqslBRx_e7WnsquFW-YWXmMt_DSzyJnmw");
	echo "[HTTP] Translating [$translate_string] German to English => " . $gt->CHINESE_TRADITIONAL_to_english($translate_string) . "\n";
	
	/**
	 * Lets switch the request type to CURL
	 */
	$gt->setRequestType('curl');
	echo "[CURL] Translating [$translate_string] German to English => " . $gt->CHINESE_TRADITIONAL_to_CHINESE_SIMPLIFIED($translate_string) . "\n";
	$translate_string = 'hello';
	echo "[CURL] Translating [$translate_string] English to German=> " . $gt->english_to_german($translate_string) . "\n";
	echo "[CURL] Translating [$translate_string] English to Portuguese=> " . $gt->english_to_portuguese($translate_string) . "\n";
	echo "[CURL] Translating [$translate_string] English to Italian=> " . $gt->english_to_CHINESE_SIMPLIFIED($translate_string) . "\n";

} catch(GTranslateException $ge) {
	echo $ge->getMessage();
}

?>
