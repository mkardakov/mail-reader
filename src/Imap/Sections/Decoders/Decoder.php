<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/19/17
 * Time: 10:18 PM
 */

namespace Mails\Imap\Sections\Decoders;

/**
 * Interface DecodeInterface
 * @package Mails\Imap\Sections\Decoders
 */
abstract class Decoder
{


    /**
     * @param $encoding
     * @return Base64Decoder|TextDecoder
     */
    public static function create($encoding)
    {
        switch ($encoding) {
            case ENCBASE64:
                return new Base64Decoder();
                break;
            case ENC7BIT:
            case ENC8BIT:
            case ENCBINARY:
            default:
                return new TextDecoder();
        }
    }

    /**
     * @return string
     */
    abstract public function decode($text);

}