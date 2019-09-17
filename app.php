<?php

include 'RestApiSender.php';
include 'models/MtResponse.php';
$baseUrl = 'http://162.253.16.28:5010/api/send';

/* TODO: change according to your own data
 * for username & password. If you set 'gw-dlr-mask' to 1,
 * please specify the 'gw-dlr-url'
 */
$data = array(
    'gw-username' => '<YOUR-USERNAME>',
    'gw-password' => '<YOUR-PASSWORD>',
    'gw-from' => 'PHP Sample',
    'gw-to' => '6012345678',
    'gw-text' => 'PHP sample',
    'gw-coding' => '1',
    'gw-dlr-mask' => '0',
    'gw-dlr-url' => '<YOUR-DLR-URL>',
    'gw-resp-type' => 'json'
);

$api = new RestApiSender();
$resp = '';

/* TODO: change this between 1 - 3 to switch result
 * 1 = Send using POST
 * 2 = Send using GET
 * 3 = Send using cURL POST
 */
$type = 1;

switch ($type) {
    case 1: {
            echo "Sending using POST\n";
            $resp = $api->sendPostRequest($data, $baseUrl);
        }
        break;
    case 2: {
            echo "Sending using GET\n";
            $resp = $api->sendGetRequest($data, $baseUrl);
        }
        break;
    case 3: {
            echo "Sending using cURL POST\n";
            $resp = $api->sendCurlPostRequest($data, $baseUrl);
        }
        break;
    default:
        break;
}

try {
    echo "RESULT=\n";

    // Future usage
    // This deserialize json into PHP objects, true will convert to PHP array
    $rawArray = json_decode($resp->responseContentString, true);

    $mtResp = new MtResponse();
    $mtResp->username = $rawArray['username'];
    $mtResp->chargingPlan = $rawArray['chargingPlan'];
    $mtResp->finalMessage = $rawArray['finalMessage'];
    $mtResp->creditDeducted = $rawArray['creditDeducted'];
    $mtResp->mtList = $rawArray['mtList'];

    //print_r($mtResp);
    print_r($resp);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}
