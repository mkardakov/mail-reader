<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:03 PM
 */

namespace Mails;


/**
 * Class MailKit
 * @package Mails\Services\Mailer
 */
class MailKit
{

    /**
     * @param MailConfig $config
     * @return MailerReaderInterface
     */
    public function create(MailConfig $config)
    {
        $proto = $config->getProtocol();
        switch($proto) {
            case MailConfig::PROTO_IMAP:
                $mailer = new Imap\Mailer($config);
                break;
            default:
                throw new \InvalidArgumentException("Mail protocol '{$proto}' is not supported");
        }
        $mailer->checkRequiredDependecies();
        return $mailer;
    }
}