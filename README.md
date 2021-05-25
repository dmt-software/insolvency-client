# Insolvency Client
[![Build Status](https://travis-ci.com/dmt-software/insolvency-client.svg?branch=master)](https://travis-ci.com/dmt-software/insolvency-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dmt-software/insolvency-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dmt-software/insolvency-client/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/dmt-software/insolvency-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dmt-software/insolvency-client/?branch=master)

This is a client for the Dutch insolvency web service from rechtspraak.nl.

## Installation

```composer require dmt-software/insolvency-client```

## Usage

Before using this server please visit [rechtspraak.nl](https://www.rechtspraak.nl/Registers/Paginas/Webservice-Centraal-Insolventieregister.aspx) 
and read the [technical documentation](doc/Technische%20documentatie%20CIR-WS.pdf) (Dutch)  

```php
use DMT\Insolvency\Client;
use DMT\Insolvency\Config;
use DMT\Insolvency\Exception\Exception;
use DMT\Insolvency\Exception\RequestException;
use DMT\CommandBus\Validator\ValidationException;
 
$config = new Config([
    'user' => '{{ username }}',
    'password' => '{{ password }}'
]);
$client = new Client($config);

try {
    $response = $client->searchUndertaking(
       '{{ company name }}',
       '{{ kvk-number }}' // chamber of commerce number
    );

    foreach ($response->result->publicatieLijst->publicatieKenmerk as $publicationNumber) {
        $case = $client->getCase($publicationNumber); // process the retrieved case
    }
} catch (RequestException $exception) {
    // user input errors
    $message = $exception->getMessage();
    if ($exception->getPrevious() instanceof ValidationException) {
        $message = (string) $exception->getPrevious()->getViolations();
    }
    echo $message;
} catch (Exception $exception) {
    // server error
}
```