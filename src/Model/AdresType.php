<?php

namespace DMT\Insolvency\Model;

interface AdresType
{
    /** Residential address */
    public const ADDRESS_TYPE_RESIDENTIAL = 'WOON';
    /** Business address */
    public const ADDRESS_TYPE_BUSINESS = 'VEST';
    /** Postal address */
    public const ADDRESS_TYPE_CORRESPONDENCE = 'CORR';
    /** Formerly */
    public const ADDRESS_TYPE_FORMERLY = 'VRHN';
    /** Additional mail blockade */
    public const ADDRESS_TYPE_BLOCKED = 'PBAV';
    /** Interim abrogation mail blockade */
    public const ADDRESS_TYPE_TEMPORARY_UNBLOCKED = 'PBTI';
}