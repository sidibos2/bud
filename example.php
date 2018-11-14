<?php

require_once './vendor/autoload.php';

use Bud\ApiClient;

try {
    $apiClient = new ApiClient();
    $exhaust1 = $apiClient->getReactorExhaust(1);
    $prisonerLea = $apiClient->getPrisoner('leia');
} catch(Exception $e) {
    echo $e->getMessage();
}



