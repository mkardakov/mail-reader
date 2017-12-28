<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:05 PM
 */

namespace Mails\Imap;

use Mails\Headers\HeadersInterface;
use Mails\Imap\Sections\ImapBody;
use Mails\Imap\Sections\ImapHeaders;
use Mails\Imap\Sections\Structure\BodyStructure;
use Mails\Letter;
use Mails\MailerReaderInterface;
use Mails\Search\SearchCriteria;
use Mails\Sort\Sorter;

/**
 * Class Mailer
 * @package Mails\Imap
 */
class Mailer implements MailerReaderInterface
{

    /**
     * Client config
     * @var Config
     */
    private $config;

    /**
     * resource wrapper
     * @var Connection
     */
    private $connection;

    /**
     * Mailer constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->connection = new Connection($config);
    }


    /**
     * @param SearchCriteria|null $criteria
     * @return \Generator|Letter[]
     */
    final public function getInbox(SearchCriteria $criteria = null, Sorter $sorter = null)
    {
        $connect = $this->getConnection();
        if (is_null($sorter)) {
            $sorter = $this->getDefaultSorter();
        }
        $queryString = (new ImapCriteriaDecorator($criteria))->getQuery();
        if (false !== ($rawData = imap_sort($connect, $sorter->getSortParam(), $sorter->getDirection(), SE_UID, $queryString))) {
            foreach ($rawData as $letterNum) {
                $headers = $this->retrieveEmailHeaders($letterNum);
                $body = $this->retrieveEmailBody($letterNum);
                yield new Letter($headers, $body);
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
        $structure = new BodyStructure(imap_fetchstructure($connect, $letterNum, FT_UID));
        $body = new ImapBody($this->connection, $structure, $letterNum);

        return $body;
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
        return $this->connection->getDescriptor();
    }

    /**
     * @return Sorter
     */
    private function getDefaultSorter()
    {
        $defaultSorter = (new Sorter())->setDirection(Sorter::DESC);
        return $defaultSorter;
    }

}