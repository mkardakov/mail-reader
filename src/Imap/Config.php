<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:34 PM
 */

namespace Mails\Imap;

use Mails\MailConfig;

/**
 * Class Config
 * @package Mails\Services\Mailer\Imap
 */
class Config extends MailConfig
{

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return $this->isSsl() ?
            sprintf('{%s:%d/imap/ssl/novalidate-cert}%s', $this->getHost(), $this->getPort(), $this->getFolder()) :
            sprintf('{%s:%d}%s', $this->getHost(), $this->getPort(), $this->getFolder());
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
    }

    /**
     * @return int
     */
    public function getProtocol()
    {
        return self::PROTO_IMAP;
    }
}