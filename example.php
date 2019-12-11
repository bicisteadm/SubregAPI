<?php

include "vendor/autoload.php";

use bicisteadm\SubregAPI\SubregAPI;

/*
 * class SubregAPI(username, password, OT&E (Test) Environment true/false)
 * OT&E (Test) Environment : http://demoreg.net/
 */

$client = new SubregAPI("username", "password", true);

$params = [
    "domain" => "freshtest01.cz",
    "template" => "freshtest"
];

$data = $client->call("Add_DNS_Zone", $params);

print_r($data);
