<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/5/17
 * Time: 10:09 PM
 */

namespace Mails\Imap\Sections;

use Mails\Headers\HeadersInterface;
use Mails\Headers\NullableHeaders;
use Mails\Helpers\Nullable;

/**
 * Class ImapHeaders
 * @package Mails\Services\Mailer\Imap\Sections
 */
final class ImapHeaders implements HeadersInterface, Nullable
{

    /**
     * @var \StdClass
     */
    private $dataObject;

    /**
     * ImapHeaders constructor.
     * @param \StdClass $dataObject
     */
    private function __construct(\StdClass $dataObject)
    {
        $this->dataObject = $dataObject;
    }

    /**
     * Headers from imap_fetchheader
     * @param $rawHeaders
     * @return HeadersInterface
     */
    public static function createFromRaw($rawHeaders)
    {
        if (!empty($rawHeaders) && ($dataObject = imap_rfc822_parse_headers($rawHeaders))) {
            return new self($dataObject);
        }
        return new NullableHeaders();
    }

    /**
     * @param $propName
     * @return mixed
     */
    private function getIfExist($propName)
    {
        return property_exists($this->dataObject, $propName) ? $this->dataObject->$propName : null;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->getIfExist('Date');
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        $from = $this->getIfExist('fromaddress');
        return $this->isStringMimeDecoded($from) ? $this->decodeMimeHeader($from) : $from;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        $subject = $this->getIfExist('Subject');
        return $this->isStringMimeDecoded($subject) ? $this->decodeMimeHeader($subject) : $subject;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->getIfExist('toaddress');
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return false;
    }

    /**
     * @param $string
     * @return string
     */
    private function decodeMimeHeader($string)
    {
        return iconv_mime_decode($string, ICONV_MIME_DECODE_CONTINUE_ON_ERROR, "UTF-8");
    }

    private function isStringMimeDecoded($string)
    {
        return preg_match('/^=\?/', $string);
    }

}