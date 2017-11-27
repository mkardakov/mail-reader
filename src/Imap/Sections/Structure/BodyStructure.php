<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/18/17
 * Time: 10:05 PM
 */

namespace Mails\Imap\Sections\Structure;

/**
 * Interface BodyStructureInterface
 * @package Mails\Imap\Sections\Structure
 */
class BodyStructure
{

    const TEXT = 'TYPETEXT';

    const MULTIPART = 'TYPEMULTIPART';

    protected $structure;

    protected $types = array();



    /**
     * BodyStructure constructor.
     * @param $structure
     */
    public function __construct($structure)
    {
        $this->structure = $structure;
    }

    /**
     * @return int
     */
    public function getEncoding()
    {
        return $this->structure->encoding;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->structure->type;
    }

    /**
     * @return array
     */
    public function getParts()
    {
        if (property_exists($this->structure, 'parts')) {
            return (array)$this->structure->parts;
        }
        $this->structure->parts = [clone $this->structure];
        return $this->getParts();
    }

}