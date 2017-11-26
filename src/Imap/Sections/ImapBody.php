<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/18/17
 * Time: 9:54 PM
 */

namespace Mails\Imap\Sections;

use Mails\Imap\Connection;
use Mails\Imap\Sections\Decoders\Decoder;
use Mails\Imap\Sections\Structure\BodyStructure;
use Mails\Imap\Sections\Structure\EmptyPart;
use Mails\Imap\Sections\Structure\Part;

/**
 * Class ImapBodyStructure
 * @package Mails\Imap\Sections
 */
class ImapBody
{

    /**
     * Meta data fethed from IMAP server for this email
     * @var BodyStructure
     */
    protected $structure;

    /**
     * Socket connection Wrapper
     * @var Connection
     */
    protected $connection;

    /**
     * UID of message
     * @var mixed
     */
    protected $id;

    /**
     * ImapBody constructor.
     * @param Decoder $decoder
     * @param BodyStructure $structure
     */
    public function __construct(Connection $conn, BodyStructure $structure, $id)
    {
        $this->structure = $structure;
        $this->connection = $conn;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getHTML()
    {
        $part = $this->findPartByMimeType('HTML');
        return $part->getContentDecoded();
    }

    /**
     * @param string $mime
     * @return Part
     */
    private function findPartByMimeType($mime)
    {
        if (null !== ($num = $this->calculatePartNumber($mime, $this->structure->getParts()))) {
            $data = imap_fetchbody($this->connection->getDescriptor(), $this->id, $num, FT_UID);
            $partData = $this->getPartData($num);
            return new Part($num, $partData->encoding, $data);
        }
        return new EmptyPart();
    }

    /**
     * Calculate the sequence like 1.2, 1.1.3, 1
     * @link https://tools.ietf.org/html/rfc2683
     * @param string $mimeType
     * @param array $partList
     * @param int $calcNumber
     * @return string|null
     */
    private function calculatePartNumber($mimeType, array $partList, $calcNumber = 0)
    {
        for ($i = 0, $sectionNum = 1, $len = count($partList); $i < $len; ++$i, ++$sectionNum) {
            if ($partList[$i]->subtype === $mimeType) {
                return (string)$sectionNum;
            }
            if (property_exists($partList[$i], 'parts')) {
                $subNumber = $this->calculatePartNumber($mimeType, $partList[$i]->parts, ++$calcNumber);
                if (!is_null($subNumber)) {
                    return "$sectionNum.$subNumber";
                }
            }
        }
        return null;
    }

    /**
     * Get structure of nested part by ID
     * @param string $partNumber
     * @return array
     */
    private function getPartData($partNumber)
    {
        $ids = explode('.', $partNumber);
        $partObject = new \StdClass;
        $partObject->parts = $this->structure->getParts();
        foreach ($ids as $id) {
            $id--;
            $partObject = $partObject->parts[$id];
        }
        return $partObject;
    }

}