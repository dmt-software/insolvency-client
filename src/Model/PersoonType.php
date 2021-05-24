<?php

namespace DMT\Insolvency\Model;

interface PersoonType
{
    /** Natural person */
    public const ENTITY_TYPE_NATURAL_PERSON = 'natuurlijk persoon';
    /** Legal person */
    public const ENTITY_TYPE_LEGAL_ENTITY = 'rechtspersoon';
}