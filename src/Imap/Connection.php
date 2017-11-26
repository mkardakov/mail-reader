<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/19/17
 * Time: 11:33 PM
 */

namespace Mails\Imap;


final class Connection
{

    /**
     * @var resource
     */
    private $descriptor;

    /**
     * Connection constructor.
     * @param Config $config
     * @throws \Exception
     */
    public function __construct(Config $config)
    {
        $this->descriptor = imap_open(
            $config->serialize(),
            $config->getUser(),
            $config->getPass(),
            OP_DEBUG | OP_READONLY
        );
        if (!is_resource($this->descriptor)) {
            throw new \Exception('Can`t connect to mail server. Please recheck your credentials');
        }
    }

    /**
     * @return resource
     */
    public function getDescriptor()
    {
        return $this->descriptor;
    }
}