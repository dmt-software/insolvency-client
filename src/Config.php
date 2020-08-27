<?php

namespace DMT\Insolvency;

/**
 * Class Config
 */
class Config
{
    /**
     * The soap WSDL.
     *
     * @var string $wsdl [optional]
     */
    public $wsdl;

    /**
     * The soap end point.
     *
     * @var string $endPoint
     */
    public $endPoint;

    /**
     * The authorized user.
     *
     * @var string $user
     */
    public $user;

    /**
     * The password for the authorized user.
     *
     * @var string $password
     */
    public $password;

    /**
     * The end point for retrieving the document.
     *
     * @var string $documentUri
     */
    public $documentUri;

    /**
     * Config constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        foreach ($options as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
}
