<?php

$app->post('/api/GeoRanker/createReport', function ($request, $response, $args) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['email', 'session', 'keywords', 'type']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $json = [];
    $url = $settings['apiUrl'] . "/report/new.json?";

    if (isset($postData['args']['searchEngines']) && strlen($postData['args']['searchEngines']) > 0) {
        $json['searchengines'] = $postData['args']['searchEngines'];
    }
    if (isset($postData['args']['callback']) && strlen($postData['args']['callback']) > 0) {
        $json['callback'] = $postData['args']['callback'];
    }
    if (isset($postData['args']['countries']) && !empty($postData['args']['countries'])) {
        $json['countries'] = $postData['args']['countries'];
    }
    if (isset($postData['args']['ignoreTypes']) && !empty($postData['args']['ignoreTypes'])) {
        $json['ignoretypes'] = $postData['args']['ignoreTypes'];
    }
    if (isset($postData['args']['isFillCities']) && strlen($postData['args']['isFillCities']) > 0) {
        $json['is_fillcities'] = $postData['args']['isFillCities'];
    }
    if (isset($postData['args']['isForMobile']) && strlen($postData['args']['isForMobile']) > 0) {
        $json['is_formobile'] = $postData['args']['isForMobile'];
    }
    if (isset($postData['args']['isGlobal']) && strlen($postData['args']['isGlobal']) > 0) {
        $json['is_global'] = $postData['args']['isGlobal'];
    }
    if (isset($postData['args']['monitorId']) && strlen($postData['args']['monitorId']) > 0) {
        $json['monitor_id'] = $postData['args']['monitorId'];
    }
    if (isset($postData['args']['isUseAlternativeTld']) && strlen($postData['args']['isUseAlternativeTld']) > 0) {
        $json['is_usealternativetld'] = $postData['args']['isUseAlternativeTld'];
    }
    if (isset($postData['args']['language']) && strlen($postData['args']['language']) > 0) {
        $json['language'] = $postData['args']['language'];
    }
    if (isset($postData['args']['maxCities']) && strlen($postData['args']['maxCities']) > 0) {
        $json['maxcities'] = $postData['args']['maxCities'];
    }
    if (isset($postData['args']['regions']) && !empty($postData['args']['regions'])) {
        $json['regions'] = $postData['args']['regions'];
    }
    if (isset($postData['args']['totalResults']) && strlen($postData['args']['totalResults']) > 0) {
        $json['totalresults'] = $postData['args']['totalResults'];
    }
    if (isset($postData['args']['url']) && strlen($postData['args']['url']) > 0) {
        $json['url'] = $postData['args']['url'];
    }

    $json['type'] = $postData['args']['type'];
    $json['keywords'] = $postData['args']['keywords'];
    $json['is_translatekeywords'] = 0;

    unset($postData['args']['searchEngines']);
    unset($postData['args']['callback']);
    unset($postData['args']['countries']);
    unset($postData['args']['ignoreTypes']);
    unset($postData['args']['isFillCities']);
    unset($postData['args']['isForMobile']);
    unset($postData['args']['isGlobal']);
    unset($postData['args']['monitorId']);
    unset($postData['args']['isUseAlternativeTld']);
    unset($postData['args']['keywords']);
    unset($postData['args']['language']);
    unset($postData['args']['maxCities']);
    unset($postData['args']['regions']);
    unset($postData['args']['totalResults']);
    unset($postData['args']['type']);
    unset($postData['args']['url']);

    if(!empty($json)) {
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
    }
    else {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'JSON_VALIDATION';
        $result['contextWrites']['to']['status_msg'] = 'Please select some fields';
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});