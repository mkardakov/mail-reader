<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:56 PM
 */

namespace Mails\Search;


class SearchCriteria implements CriteriaInterface
{

    protected $bcc;

    protected $cc;

    protected $from;

    protected $answered;

    protected $body;

    protected $subject;

    /**
     * @return mixed
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * @param mixed $bcc
     * @return $this;
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param mixed $cc
     * @return $this;
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     * @return $this;
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnswered()
    {
        return $this->answered;
    }

    /**
     * @param mixed $answered
     * @return $this;
     */
    public function setAnswered($answered)
    {
        $this->answered = $answered;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return $this;
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return $this;
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }


    /**
     * @return array
     */
    public function getQuery()
    {
        $keyPairs = [];
        foreach ($this as $name => $criteria) {
            if (!empty($criteria)) {
                $keyPairs[$name] = $criteria;
            }
        }
        return $keyPairs;
    }
}