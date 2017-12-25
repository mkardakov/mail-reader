<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 12/25/17
 * Time: 8:18 PM
 */

namespace Mails\Sort;

/**
 * Class Sorter
 * @package Mails\Sort
 */
class Sorter
{

    const ASC = 0;

    const DESC = 1;

    protected $direction;

    protected $sortParam = SORTARRIVAL;

    /**
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param int $direction
     * @return $this;
     */
    public function setDirection($direction = self::ASC)
    {
        $this->direction = $direction;
        return $this;
    }

    /**
     * @return int
     */
    public function getSortParam()
    {
        return $this->sortParam;
    }

    /**
     * @param int $sortParam
     * @link http://php.net/manual/ru/function.imap-sort.php#refsect1-function.imap-sort-parameters
     * @return $this;
     */
    public function setSortParam($sortParam = SORTARRIVAL)
    {
        $this->sortParam = $sortParam;
        return $this;
    }


}