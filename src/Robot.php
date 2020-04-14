<?php

namespace Luffy\QQWebHook;

use RuntimeException;

class Robot
{
    private static $instance;

    private static $key;

    public static function getInstance(string $key)
    {
        if (!isset(self::$instance) && !self::$instance instanceof self) {
            self::$key = $key;
            self::$instance = new static($key);
        }
        return self::$instance;
    }

    const SEND = 0;

    /**
     * @param $msg
     * @param int $pushType
     * @return bool
     */
    public function send($msg, $pushType = self::SEND)
    {
        $url = $this->apiUrl($pushType) . "?" . http_build_query(['key' => self::$key]);
        $data = json_encode(
            array(
                "content" => array(
                    array(
                        "type" => $pushType,
                        "data" => $msg
                    )
                )
            )
        );
        $response = $this->httpCurlPost($url, $data);
        if ($response != "") {
            $jsonResponse = json_decode($response, true);
            throw new RuntimeException($jsonResponse['em']);
            return false;
        }
        return true;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key)
    {
        self::$key = $key;
    }

    /**
     * @param $type
     * @return string
     */
    private function apiUrl($type)
    {
        switch ($type) {
            case self::SEND :
                return "https://app.qun.qq.com/cgi-bin/api/hookrobot_send";
        }
    }

    /**
     * @param $url
     * @param $params
     * @return bool|string
     */
    private function httpCurlPost($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $response = curl_exec($ch);
        if ($response === false) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }
}