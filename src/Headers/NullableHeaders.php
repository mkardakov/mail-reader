<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/5/17
 * Time: 10:26 PM
 */

namespace Mails\Headers;

use Mails\Helpers\Nullable;

/**
 * Once no headers available or not successfully parsed
 * Class NullableHeaders
 * @package Mails\Services\Mailer\Headers
 */
class NullableHeaders implements HeadersInterface, Nullable
{

    /**
     * @return null
     */
    public function getDate()
    {
        return NULL;
    }

    /**
     * @return null
     */
    public function getFrom()
    {
        return NULL;
    }

    /**
     * @return null
     */
    public function getSubject()
    {
        return NULL;
    }

    /**
     * @return null
     */
    public function getTo()
    {
        return NULL;
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return true;
    }
}