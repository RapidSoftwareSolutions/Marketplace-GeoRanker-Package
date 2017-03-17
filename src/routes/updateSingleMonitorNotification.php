<?php

$app->post('/api/GeoRanker/updateSingleMonitorNotification', function ($request, $response) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['email', 'session', 'monitorId', 'notification']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $url = $settings['apiUrl'] . "/monitor/" . $postData['args']['monitorId'] . ".json?";
    $json['is_sendemail'] = (int) filter_var($postData['args']['notification'], FILTER_VALIDATE_BOOLEAN);

    unset($postData['args']['monitorId']);
    unset($postData['args']['notification']);

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->put($url, [
            'query' => $postData['args'],
            'json' => $json
        ]);
        $vendorResponseBody = $vendorResponse->getBody()->getContents();
        if ($vendorResponse->getStatusCode() == 200) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = json_decode($vendorResponse->getBody());
        }
        elseif ($vendorResponse->getStatusCode() == 204) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = [];
        }
        else {
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