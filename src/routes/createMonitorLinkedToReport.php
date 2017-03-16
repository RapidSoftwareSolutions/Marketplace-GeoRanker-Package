<?php

$app->post('/api/GeoRanker/createMonitorLinkedToReport', function ($request, $response, $args) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['email', 'session', 'reportId', 'monitorType']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $url = $settings['apiUrl'] . "/monitor/new.json?";

    $json['report_id'] = $postData['args']['reportId'];
    $json['type'] = $postData['args']['monitorType'];
    unset($postData['args']['reportId']);
    unset($postData['args']['monitorType']);

    if (isset($postData['args']['periodicity']) && strlen($postData['args']['periodicity']) > 0) {
        $json['periodicity'] = $postData['args']['periodicity'];
        unset($postData['args']['periodicity']);
    }
    if (isset($postData['args']['isSendEmail']) && strlen($postData['args']['isSendEmail']) > 0) {
        $json['is_sendemail'] = $postData['args']['isSendEmail'];
        unset($postData['args']['isSendEmail']);
    }

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->post($url, [
            'query' => $postData['args'],
            'json' => $json
        ]);
        $vendorResponseBody = $vendorResponse->getBody()->getContents();
        if ($vendorResponse->getStatusCode() == '200') {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = json_decode($vendorResponse->getBody());
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($vendorResponseBody) ? $vendorResponseBody : json_decode($vendorResponseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $vendorResponseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($vendorResponseBody);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});