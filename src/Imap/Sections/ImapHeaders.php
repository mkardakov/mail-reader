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
use Mails\Helpers\Traits\HeadersParser;
use Mails\Imap\Sections\Structure\From;

/**
 * Class ImapHeaders
 * @package Mails\Services\Mailer\Imap\Sections
 */
final class ImapHeaders implements HeadersInterface, Nullable
{

    use HeadersParser;
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
     * @return \DateTime|false
     */
    public function getDate()
    {
        $date = $this->getIfExist('Date');
        return \DateTime::createFromFormat('D# d F Y+', $date);
    }

    /**
     * @return From
     */
    public function getFrom()
    {
        $from = $this->getIfExist('fromaddress');
        return $this->parseFrom($from);
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        $subject = $this->getIfExist('Subject');
        return $this->decodeMimeHeader($subject);
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

}