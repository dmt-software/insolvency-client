<?php

namespace DMT\Insolvency\Model;

use DMT\Insolvency\Client;

interface ConstructWithClientInterface
{
    public function __construct(Client $client);
}