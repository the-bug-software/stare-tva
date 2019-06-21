<?php

namespace TheBugSoftware\StareTva\Services;

use TheBugSoftware\StareTva\Exceptions\ResponseException;

/**
 * Request class.
 */
class Request
{
    /**
     * @var string
     */
    private $apiUrl = 'https://webservicesp.anaf.ro/PlatitorTvaRest/api/v3/ws/tva';

    /**
     * cURL request.
     *
     * @param array $data
     *
     * @return array
     * @throws \TheBugSoftware\StareTva\Exceptions\ResponseException
     */
    public function get($data)
    {
        sleep(1);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $this->apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_POSTFIELDS     => json_encode($data),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Cache-Control: no-cache',
            ],
        ]);

        $response = curl_exec($curl);
        $info = curl_getinfo($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if (empty($response) || ! isset($info['http_code']) || $info['http_code'] !== 200) {
            throw new ResponseException(sprintf(
                'Invalid results returned. API responded with status #:',
                $info['http_code']
            ));
        }

        return $response;
    }
}
