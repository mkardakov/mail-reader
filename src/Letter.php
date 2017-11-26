<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 9:23 PM
 */

namespace Mails;

use Mails\Headers\HeadersInterface;
use Mails\Imap\Sections\ImapBody;

/**
 * Class Letter
 * @package Mails\Services\Mailer
 */
class Letter
{

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var HeadersInterface
     */
    protected $headers;

    /**
     * Letter constructor.
     * @param HeadersInterface $headers
     */
    public function __construct(HeadersInterface $headers, ImapBody $body)
    {
        $this->headers = $headers;
        $this->body = $body;
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
     * @return HeadersInterface
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param HeadersInterface $headers
     * @return $this;
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }


}