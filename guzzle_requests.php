<?php
require 'vendor/autoload.php';

// Specify the correct path to your CA bundle
$caBundlePath = 'C:\Users\C S Pavan Sai\Downloads\cacert-2024-03-11.pem'; // Update this path accordingly

$httpClient = new \GuzzleHttp\Client([
   
    'verify' => $caBundlePath, // Use the specified CA bundle for SSL verification
]);

$response = $httpClient->get('https://books.toscrape.com/');
$htmlString = (string) $response->getBody();

libxml_use_internal_errors(true);
$doc = new DOMDocument();
$doc->loadHTML($htmlString);
$xpath = new DOMXPath($doc);
$titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
$extractedTitles = [];
foreach ($titles as $title) {
    $extractedTitles[] = $title->textContent.PHP_EOL;
    echo $title->textContent.PHP_EOL;
}
