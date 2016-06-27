<?php
/**
 * Query Module
 *
 * PHP Version 5.4.x
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
namespace Ng\Query;


/**
 * Query Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class Query
{
    protected $conditions   = array();
    protected $orders       = array();

    protected $offset       = 0;
    protected $limit        = 10;
    protected $number       = 1;

    public function appendCondition()
    {
        $args   = func_get_args();
        $append = function($condition) {
            if ($condition instanceOf ConditionInterface) {
                $this->addCondition($condition);
            }
        };

        array_walk($args, $append);
    }

    public function addCondition(ConditionInterface $conditionInterface)
    {
        $this->conditions[] = $conditionInterface;
    }

    public function appendOrder()
    {
        $args   = func_get_args();
        $append = function($order) {
            if ($order instanceOf OrderInterface) {
                $this->addOrder($order);
            }
        };

        array_walk($args, $append);
    }

    public function addOrder(OrderInterface $orderInterface)
    {
        $this->orders[] = $orderInterface;
    }

    public function conditionToArray()
    {
        $conditions = array();
        if (!$this->hasConditions()) {
            return $conditions;
        }

        foreach ($this->getConditions() as $condition) {
            /** @type ConditionInterface $condition */
            $conditions[] = $condition->toArray();
        }

        return $conditions;
    }

    public function conditionToString()
    {
        $conditions = "";
        if (!$this->hasConditions()) {
            return $conditions;
        }

        foreach ($this->getConditions() as $condition) {
            /** @type ConditionInterface $condition */
            $conditions .= $condition->toString(!empty($conditions));
        }

        return $conditions;
    }

    public function orderToArray()
    {
        $orders = array();
        if (!$this->hasOrders()) {
            return $orders;
        }

        foreach ($this->getOrders() as $order) {
            /** @type OrderInterface $order */
            $orders[] = $order->toArray();
        }

        return $orders;
    }

    public function orderToString()
    {
        $orders = "";
        if (!$this->hasOrders()) {
            return $orders;
        }

        foreach ($this->getOrders() as $order) {
            /** @type OrderInterface $order */
            $orders .= $order->toString(!empty($orders));
        }

        return $orders;
    }

    public function hasConditions()
    {
        return !empty($this->conditions);
    }

    public function hasOrders()
    {
        return !empty($this->orders);
    }

    public function getConditions()
    {
        return $this->conditions;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

}
