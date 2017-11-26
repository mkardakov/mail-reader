<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/19/17
 * Time: 10:24 PM
 */

namespace Mails\Imap\Sections\Decoders;

/**
 * Class TextDecoder
 * @package Mails\Imap\Sections\Decoders
 */
class TextDecoder extends Decoder
{

    /**
     * @return string
     */
    public function decode($text)
    {
        return imap_qprint($text);
    }
}