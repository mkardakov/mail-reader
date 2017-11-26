<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/26/17
 * Time: 7:17 PM
 */

namespace Mails\Helpers;

/**
 * Interface Nullable
 * @package Mails\Helpers
 */
interface Nullable
{
    /**
     * @return bool
     */
    public function isNull();
}