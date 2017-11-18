<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/12/17
 * Time: 8:51 PM
 */

namespace Mails;

/**
 * Class Envelope
 * @package Mails\Services\Mailer
 */
abstract class Envelope
{

    /**
     * @var string
     */
    protected $from = '';

    /**
     * @var string
     */
    protected $to;

    /**
     * @var string
     */
    protected $charset = 'utf-8';

    /**
     * @var string
     */
    protected $subject = 'no-subject';

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return $this;
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return $this;
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * @param string $charset
     * @return $this;
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return $this;
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return $this;
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    abstract public function transformData();
}