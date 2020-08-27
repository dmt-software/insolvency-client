<?php

namespace DMT\Insolvency\Model;

interface AdresType
{
    /** residential address */
    public const ADDRESS_TYPE_RESIDENCE = "WOON";
    /** Business address */
    public const ADDRESS_TYPE_ESTABLISHMENT = "VEST";
    /** Postal address */
    public const ADDRESS_TYPE_CORRESPONDENCE = "CORR";
    /** formerly */
    public const ADDRESS_TYPE_FORMER = "VRHN";
    /** additional mail blockade */
    public const ADDRESS_TYPE_PBAV = "PBAV";
    /** interim abrogation mail blockade */
    public const ADDRESS_TYPE_PBTI = "PBTI";
}