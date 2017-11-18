<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 7:59 PM
 */

namespace Mails;

use Mails\Search\SearchCriteria;


/**
 * Interface Mailer
 * @package Mails\Services\Mailer\Imap
 */
interface MailerReaderInterface
{

    /**
     * @param SearchCriteria|null $criteria
     * @return \Generator|Letter[]
     */
    public function getInbox(SearchCriteria $criteria = null);


    /**
     * @return void
     * @throws \Exception if server configuration is incorrect
     */
    public function checkRequiredDependecies();

}