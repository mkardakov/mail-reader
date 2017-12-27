<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 12/25/17
 * Time: 12:37 PM
 */

namespace Mails\Imap\Sections\Structure;


use Mails\Helpers\Nullable;

class From implements Nullable
{

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var bool
     */
    protected $isNull = false;


    /**
     * From constructor.
     * @param $title
     * @param $email
     */
    public function __construct($title = '', $email = '')
    {
        $this->title = $title;
        $this->email = $email;
        if (empty($email) && empty($title)) {
            $this->isNull = true;
        }
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return $this->isNull;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $fullText = "{$this->getTitle()} {$this->getEmail()}";
        return trim($fullText);
    }

}