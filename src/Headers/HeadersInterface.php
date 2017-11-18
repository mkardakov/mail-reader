<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/5/17
 * Time: 10:18 PM
 */

namespace Mails\Headers;


interface HeadersInterface
{

    public function getDate();

    public function getFrom();

    public function getSubject();

    public function getTo();
}