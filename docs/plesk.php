<?php
/**
* Reports error during API RPC request
*/
class ApiRequestException extends Exception {}
/**
* Returns DOM object representing request for information about all available domains
* @return DOMDocument
*/
function domainsInfoRequest()
{    
	$xmldoc = new DomDocument('1.0', 'UTF-8');
	$xmldoc->formatOutput = true;
    // <packet>    
	$packet = $xmldoc->createElement('packet');
	$packet->setAttribute('version', '1.6.3.5');
	$xmldoc->appendChild($packet);
    // <packet/domain>
	$domain = $xmldoc->createElement('domain');
	$packet->appendChild($domain);
     // <packet/domain/get>
	 
     $get = $xmldoc->createElement('get');
     
	 $domain->appendChild($get);
     // <packet/domain/get/filter>
     $filter = $xmldoc->createElement('filter');
     $get->appendChild($filter);
     // <packet/domain/get/dataset>
     $dataset = $xmldoc->createElement('dataset');
     $get->appendChild($dataset);
     // dataset elements
     $dataset->appendChild($xmldoc->createElement('hosting'));
     $dataset->appendChild($xmldoc->createElement('gen_info'));
     return $xmldoc;
}
/**
* Prepares CURL to perform the Panel API request
* @return resource
*/
function curlInit($host, $login, $password)
{
     $curl = curl_init();
     curl_setopt($curl, CURLOPT_URL, "https://{$host}:8443/enterprise/control/agent.php");
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_POST,           true);
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
     curl_setopt($curl, CURLOPT_HTTPHEADER,
		array("HTTP_AUTH_LOGIN: {$login}",
			   "HTTP_AUTH_PASSWD: {$password}",
			   "HTTP_PRETTY_PRINT: TRUE",
			   "Content-Type: text/xml")
     );
     return $curl;
}
/**
* Performs a Panel API request, returns raw API response text
*
* @return string
* @throws ApiRequestException
*/
function sendRequest($curl, $packet)
{
	//echo $curl;
	echo $packet;

     curl_setopt($curl, CURLOPT_POSTFIELDS, $packet);
     $result = curl_exec($curl);
     if (curl_errno($curl)) {
            $errmsg  = curl_error($curl);
            $errcode = curl_errno($curl);
            curl_close($curl);
            throw new ApiRequestException($errmsg, $errcode);
     }
     curl_close($curl);
     return $result;
}

/**
* Looks if API responded with correct data
*
* @return SimpleXMLElement
* @throws ApiRequestException
*/
function parseResponse($response_string)
{
     $xml = new SimpleXMLElement($response_string);
     if (!is_a($xml, 'SimpleXMLElement'))
            throw new ApiRequestException("Cannot parse server response: {$response_string}");
     return $xml;
}
/**
* Check data in API response
* @return void
* @throws ApiRequestException
*/
function checkResponse(SimpleXMLElement $response)
{
	print_r($response);
     $resultNode = $response->domain->get->result;
     // check if request was successful
     if ('error' == (string)$resultNode->status)
            throw new ApiRequestException("The Panel API returned an error: " . (string)$resultNode->result->errtext);
}

//
// int main()
//
$host = '216.70.71.235';
$login = 'colin.kennedy@neuronglobal.com';
$password = 'hm_mtplesk_12qwaszx';

$curl = curlInit($host, $login, $password);
try {
     $response = sendRequest($curl, domainsInfoRequest()->saveXML());
     $responseXml = parseResponse($response);
     checkResponse($responseXml);
} catch (ApiRequestException $e) {
     echo $e;
     die();
}
// Explore the result
foreach ($responseXml->xpath('/packet/domain/get/result') as $resultNode) {
     echo "Domain id: " . (string)$resultNode->id . " ";
     echo (string)$resultNode->data->gen_info->name . " (" . (string)$resultNode->data->gen_info->dns_ip_address . ")\n";
}



/*
$doc = new DOMDocument('1.0');
// we want a nice output
$doc->formatOutput = true;

$root = $doc->createElement('book');
$root = $doc->appendChild($root);

$title = $doc->createElement('title');
$title = $root->appendChild($title);

$text = $doc->createTextNode('This is the title');
$text = $title->appendChild($text);

echo "Saving all the document:\n";
echo $doc->saveXML() . "\n";

echo "Saving only the title part:\n";
echo $doc->saveXML($title);
*/
?>