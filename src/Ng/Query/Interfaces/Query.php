<?php
/**
 * Query Interfaces
 *
 * PHP Version 5.4.x
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
namespace Ng\Query\Interfaces;


/**
 * Query Interfaces
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
interface Query
{
    /**
     * Add New Condition
     *
     * @param Condition $condition
     *
     * @return void
     */
    public function addCondition(Condition $condition);

    /**
     * Add New Order
     *
     * @param Order $order
     *
     * @return void
     */
    public function addOrder(Order $order);

    /**
     * Merge another query object into itself
     *
     * @param Query $query
     *
     * @return void
     */
    public function merge(Query $query);

    /**
     * Stringify Order(s)
     *
     * @return string
     */
    public function stringifyOrder();

    /**
     * Check If it has Conditions
     *
     * @return bool
     */
    public function hasConditions();

    /**
     * Get All Conditions
     *
     * @return Condition[]
     */
    public function getConditions();

    /**
     * Check if it has Orders
     *
     * @return bool
     */
    public function hasOrders();

    /**
     * Get All Orders
     *
     * @return Order[]
     */
    public function getOrders();

    /**
     * Get Limit
     *
     * @return int
     */
    public function getLimit();

    /**
     * Set Limit
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit($limit);

    /**
     * Get Offset
     *
     * @return int
     */
    public function getOffset();

    /**
     * Set Offset
     *
     * @param int $offset
     *
     * @return $this
     */
    public function setOffset($offset);

    /**
     * Extracting the query as an array
     *
     * @return array
     */
    public function toArray();

    /**
     * Extracting the query as a string
     *
     * @return string
     */
    public function toString();
}