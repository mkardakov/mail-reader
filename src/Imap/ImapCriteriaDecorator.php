<?php
/**
 * Created by PhpStorm.
 * User: mkardakov
 * Date: 11/4/17
 * Time: 9:05 PM
 */

namespace Mails\Imap;

use Mails\Search\CriteriaInterface;
use Mails\Search\SearchCriteria;


/**
 * Class ImapCriteriaDecorator
 * @package Mails\Services\Mailer\Imap
 */
class ImapCriteriaDecorator implements CriteriaInterface
{

    const DEFAULT_CRITERIA = 'ALL';
    /**
     * @var SearchCriteria
     */
    private $criteria;

    /**
     * ImapCriteriaDecorator constructor.
     * @param SearchCriteria $criteria
     */
    public function __construct(SearchCriteria $criteria = null)
    {
        $this->criteria = $criteria;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        if (is_null($this->criteria)) {
            return self::DEFAULT_CRITERIA;
        }
        $queryArr = $this->criteria->getQuery();
        $query = '';
        foreach ($queryArr as $name => $value) {
            $query .= strtoupper($name) . ' ' . "\"$value\" ";
        }
        return $query;
    }
}