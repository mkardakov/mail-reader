<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/5/17
 * Time: 10:18 PM
 */

namespace Mails\Headers;


use Mails\Imap\Sections\Structure\From;

/**
 * Interface HeadersInterface
 * @package Mails\Headers
 */
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

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return string
     */
    public function getTo();
}