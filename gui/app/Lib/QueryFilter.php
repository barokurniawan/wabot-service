<?php

namespace App\Lib;

class QueryFilter
{
    private $limit, $offset, $search, $whereClause, $orderBy;

    /**
     * @var self
     */
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Get the value of whereClause
     */
    public function getWhereClause()
    {
        return $this->whereClause;
    }

    /**
     * Set the value of whereClause
     *
     * @return  self
     */
    public function setWhereClause($whereClause)
    {
        $this->whereClause = $whereClause;

        return $this;
    }

    /**
     * Get the value of search
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * Set the value of search
     *
     * @return  self
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * Get the value of offset
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * Set the value of offset
     *
     * @return  self
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Get the value of limit
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the value of orderBy
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set the value of orderBy
     *
     * @return  self
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;

        return $this;
    }
}
