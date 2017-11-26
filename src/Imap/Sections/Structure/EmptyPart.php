<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/26/17
 * Time: 7:19 PM
 */

namespace Mails\Imap\Sections\Structure;


class EmptyPart extends Part
{

    public function __construct()
    {
    }


    public function isNull()
    {
        return true;
    }

    public function getPartNumber()
    {
        return null;
    }

    public function getEncoding()
    {
        return null;
    }

    public function getContent()
    {
        return '';
    }

    public function getContentDecoded()
    {
        return '';
    }


}