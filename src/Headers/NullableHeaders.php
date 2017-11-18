<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/5/17
 * Time: 10:26 PM
 */

namespace Mails\Headers;

/**
 * Once no headers available or not successfully parsed
 * Class NullableHeaders
 * @package Mails\Services\Mailer\Headers
 */
class NullableHeaders implements HeadersInterface
{

    public function getDate()
    {
        return NULL;
    }

    public function getFrom()
    {
        return NULL;
    }

    public function getSubject()
    {
        return NULL;
    }

    public function getTo()
    {
        return NULL;
    }
}