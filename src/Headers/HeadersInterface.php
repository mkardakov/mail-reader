<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/5/17
 * Time: 10:18 PM
 */

namespace Mails\Headers;


use Mails\Imap\Sections\Structure\From;

interface HeadersInterface
{

    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @return From
     */
    public function getFrom();

    public function getSubject();

    public function getTo();
}