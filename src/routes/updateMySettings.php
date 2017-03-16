<?php

$app->post('/api/GeoRanker/updateMySettings', function ($request, $response, $args) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['email', 'session']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $url = $settings['apiUrl'] . "/account/settings.json?";

    $params = [];
    if (isset($postData['args']['countryCode']) && strlen($postData['args']['countryCode']) > 0) {
        $params['country_code'] = $postData['args']['countryCode'];
        unset($postData['args']['countryCode']);
    }
    if (isset($postData['args']['isMergeNotifications']) && strlen($postData['args']['isMergeNotifications']) > 0) {
        $params['is_mergenotifications'] = $postData['args']['isMergeNotifications'];
        unset($postData['args']['isMergeNotifications']);
    }
    if (isset($postData['args']['isSendNews']) && strlen($postData['args']['isSendNews']) > 0) {
        $params['is_sendnews'] = $postData['args']['isSendNews'];
        unset($postData['args']['isSendNews']);
    }
    if (isset($postData['args']['notificationsTime']) && strlen($postData['args']['notificationsTime']) > 0) {
        $params['notificationstime'] = $postData['args']['notificationsTime'];
        unset($postData['args']['notificationsTime']);
    }
    if (isset($postData['args']['timezone']) && strlen($postData['args']['timezone']) > 0) {
        $params['timezone'] = $postData['args']['timezone'];
        unset($postData['args']['countryCode']);
    }
    if (isset($postData['args']['wlHeading']) && strlen($postData['args']['wlHeading']) > 0) {
        $params['wl_heading'] = $postData['args']['wlHeading'];
        unset($postData['args']['wlHeading']);
    }
    if (isset($postData['args']['wlSubheading']) && strlen($postData['args']['wlSubheading']) > 0) {
        $params['wl_subheading'] = $postData['args']['wlSubheading'];
        unset($postData['args']['wlSubheading']);
    }
    if (isset($postData['args']['wlUserLogo']) && strlen($postData['args']['wlUserLogo']) > 0) {
        $params['wl_userlogo'] = $postData['args']['wlUserLogo'];
        unset($postData['args']['wlUserLogo']);
    }

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->put($url, [
            'query' => $postData['args'],
            'json' => $params
        ]);
        $vendorResponseBody = $vendorResponse->getBody()->getContents();
        if (($vendorResponse->getStatusCode() == 200 || $vendorResponse->getStatusCode() == 204)) {
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