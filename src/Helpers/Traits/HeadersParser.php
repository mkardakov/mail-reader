<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 12/25/17
 * Time: 6:07 PM
 */

namespace Mails\Helpers\Traits;

use Mails\Imap\Sections\Structure\From;

/**
 * Class HeadersParser
 * @package Helpers\Traits
 */
trait HeadersParser
{

    /**
     * @var string
     */
    private $fromString = '';

    /**
     * @param $fromString
     * @return From
     */
    public function parseFrom($fromString)
    {
        $this->fromString = $this->decodeMimeHeader($fromString);
        if ($from = $this->parseExtendedFormat()) {
            return $from;
        }
        if ($from = $this->parseSimpleFormat()) {
            return $from;
        }
        return new From();
    }

    /**
     * @return bool|From
     */
    private function parseExtendedFormat()
    {
        if (preg_match('/^(?<title>[\s\S]+) \<(?=.*@)(?<email>[^>]+)\>$/', $this->fromString, $matches)) {
            return new From($matches['title'], $matches['email']);
        }
        return false;
    }

    /**
     * @return bool|From
     */
    private function parseSimpleFormat()
    {
        if (preg_match('/^\S+@\w+\.\w+$/', $this->fromString)) {
            return new From('', $this->fromString);
        }
        return false;
    }


    /**
     * @param string $string
     * @return string
     */
    protected function decodeMimeHeader($string)
    {
        $string = (string)$string;
        $result = '';
        foreach (imap_mime_header_decode($string) as $part) {
            if (is_object($part) && property_exists($part, 'text')) {
                $textPiece = $part->text;
                if (!preg_match('/default|utf-?8/i', $part->charset)) {
                    if ($converted = iconv($part->charset, 'UTF-8//IGNORE', $textPiece)) {
                        $textPiece = $converted;
                    }
                }
                $result .= $textPiece;
            }
        }
        return trim($result);
    }

}