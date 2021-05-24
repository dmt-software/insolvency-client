<?php

namespace DMT\Insolvency\Model;

/**
 * Class HandlerType
 */
interface BeheerderType
{
    /** Administrator (bankruptcy) */
    public const HANDLER_TYPE_ADMINISTRATOR = 'C';

    /** Receiver (debt restructuring or mortuarium procedure)  */
    public const HANDLER_TYPE_RECEIVER = 'B';
}