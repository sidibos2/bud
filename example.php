<?php

require_once './vendor/autoload.php';

use Bud\ApiClient;

$apiClient = new ApiClient();

$exhaust1 = $apiClient->getReactorExhaust(1);

$prisonerLea = $apiClient->getPrisoner('leia');


