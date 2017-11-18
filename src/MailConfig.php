<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:07 PM
 */

namespace Mails;

/**
 * Class MailConfig
 * @package Mails\Services\Mailer
 */
abstract class MailConfig implements \Serializable
{

    const PROTO_IMAP = 1;

    const PROTO_POP3 = 2;

    const PROTO_SMTP = 3;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var string
     */
    protected $user;

    /**
     * @var string
     */
    protected $pass;

    /**
     * @var string
     */
    protected $folder = 'INBOX';

    /**
     * @var bool
     */
    protected $ssl = false;

    /**
     * @var int
     */
    protected $protocol;

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     * @return $this;
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     * @return $this;
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return $this;
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     * @return $this;
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param mixed $folder
     * @return $this;
     */
    public function setFolder($folder)
    {
        $this->folder = $folder;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSsl()
    {
        return $this->ssl;
    }

    /**
     * @param bool $ssl
     * @return $this;
     */
    public function setSsl($ssl)
    {
        $this->ssl = $ssl;
        return $this;
    }

    /**
     * @return int
     */
    abstract public function getProtocol();


}