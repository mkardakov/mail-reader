<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/25/17
 * Time: 11:36 PM
 */

namespace Mails\Imap\Sections\Structure;
use Mails\Helpers\Nullable;
use Mails\Imap\Sections\Decoders\Decoder;

/**
 * Class Part
 * @package Mails\Imap\Sections\Structure
 */
class Part implements Nullable
{

    /**
     * @var string
     */
    protected $partNumber;

    /**
     * @var int
     */
    protected $encoding;

    /**
     * @var string
     */
    protected $content;

    /**
     * Part constructor.
     * @param $partNumber
     * @param int $encoding
     * @param string $content
     */
    public function __construct($partNumber, $encoding = ENC7BIT, $content = '')
    {
        $this->partNumber = $partNumber;
        $this->encoding = $encoding;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getPartNumber()
    {
        return $this->partNumber;
    }


    /**
     * @return int
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Decode a content using encoding field
     * @return string
     */
    public function getContentDecoded()
    {
       return Decoder::create($this->encoding)->decode($this->getContent());
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return false;
    }
}