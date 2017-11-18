<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:05 PM
 */

namespace Mails\Imap;

use Mails\Headers\HeadersInterface;
use Mails\Imap\Sections\ImapHeaders;
use Mails\Letter;
use Mails\MailerReaderInterface;
use Mails\Search\SearchCriteria;


class Mailer implements MailerReaderInterface
{

    /**
     * @var Config
     */
    private $config;

    /**
     * Mailer constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }


    /**
     * @param SearchCriteria|null $criteria
     * @return \Generator|Letter[]
     */
    final public function getInbox(SearchCriteria $criteria = null)
    {
        $connect = $this->getConnection();
        $queryString = (new ImapCriteriaDecorator($criteria))->getQuery();
        if (false !== ($rawData = imap_search($connect, $queryString, SE_UID))) {
            foreach ($rawData as $letterNum) {
                $headers = $this->retrieveEmailHeaders($letterNum);
                $body = $this->retrieveEmailBody($letterNum);
                yield (new Letter($headers))->setBody($body);
            }
        }
        return [];
    }

    /**
     * @param int $letterNum
     * @return string
     */
    private function retrieveEmailBody($letterNum)
    {
        $connect = $this->getConnection();
        $body = imap_body($connect, $letterNum, FT_UID);
        return !empty($body) ? imap_base64($body) : '';
    }

    /**
     * @param $letterNum
     * @return HeadersInterface
     */
    private function retrieveEmailHeaders($letterNum)
    {
        $connect = $this->getConnection();
        $rawHeaders = imap_fetchheader($connect, $letterNum, FT_UID);
        return ImapHeaders::createFromRaw($rawHeaders);
    }


    /**
     * @throws \ErrorException
     * @return void
     */
    public function checkRequiredDependecies()
    {
        if (function_exists('imap_open') && function_exists('openssl_open')) {
            return;
        }
        throw new \ErrorException('imap and openssl extensions are required for ' . __CLASS__);
    }

    /**
     * @return resource
     * @throws \Exception
     */
    private function getConnection()
    {
        static $res;
        if (!is_resource($res)) {
            $res = imap_open($this->config->serialize(), $this->config->getUser(), $this->config->getPass());
            if (!is_resource($res)) {
                throw new \Exception('Can`t connect to mail server. Please recheck your credentials');
            }
        }
        return $res;
    }

}