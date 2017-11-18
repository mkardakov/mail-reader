<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 8:59 PM
 */

namespace Mails\Search;

/**
 * Interface CriteriaInterface
 * @package Mails\Services\Mailer
 */
interface CriteriaInterface
{

    /**
     * @return mixed
     */
    public function getQuery();
}