<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/19/17
 * Time: 10:23 PM
 */

namespace Mails\Imap\Sections\Decoders;

/**
 * Class Base64Decoder
 * @package Mails\Imap\Sections\Decoders
 */
class Base64Decoder extends Decoder
{

    /**
     * @return string
     */
    public function decode($text)
    {
        return imap_base64($text);
    }
}