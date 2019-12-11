<?php
/*
 * (c) Adam Biciste <adam@freshost.cz>
 *
 * This source file is subject to the Apache 2.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace bicisteadm\SubregAPI;

use SoapClient;

class SubregAPI
{
    private $user;
    private $pass;
    private $test;

    /**
     * SubregAPI constructor.
     * @param $user
     * @param $pass
     * @param bool $test
     */
    public function __construct($user, $pass, $test = false)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->test = $test;
    }

    /**
     * @return SoapClient
     */
    private function client()
    {
        if ($this->test) {
            $urls = [
                "location" => "https://ote-soap.subreg.cz/cmd.php",
                "uri" => "https://demoreg.net/wsdl"
            ];
        } else {
            $urls = [
                "location" => "https://soap.subreg.cz/cmd.php",
                "uri" => "https://subreg.cz/wsdl"
            ];
        }

        $client = new SoapClient(null, $urls);
        return $client;
    }

    /**
     * @param $client
     * @return array
     */
    private function login($client)
    {
        $params = array (
            "data" => array (
                "login" => $this->user,
                "password" => $this->pass,
            )
        );
        $response = $client->__call("Login", $params);

        if ($response["status"] != "ok")
        {
            return ["status" => "err", "return" => $response];
        }

        return $response["data"]["ssid"];
    }

    /**
     * @param $method
     * @param array $data
     * @return mixed
     */
    public function call($method, $data = array())
    {
        $client = $this->client();
        $token = $this->login($client);

        if (isset($token["status"]) == "err")
        {
            return $token["return"];
        }

        $data_send["data"] = array_merge(["ssid" => $token], $data);

        $response = $client->__call($method, $data_send);

        if ($response["status"] != "ok")
        {
            return $response;
        }

        return $response["data"];
    }
}

