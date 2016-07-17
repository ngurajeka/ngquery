<?php
/**
 * SQLQuery Module
 *
 * PHP Version 5.4.x
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
namespace Ng\Query\Adapters\SQL;


use Ng\Query\Interfaces\Condition;
use Ng\Query\Interfaces\Order;
use Ng\Query\Interfaces\Query as QueryInterface;

/**
 * SQLQuery Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class Query implements QueryInterface
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
            if ($condition instanceOf Condition) {
                $this->addCondition($condition);
            }
        };

        array_walk($args, $append);
    }

    public function addCondition(Condition $condition)
    {
        $this->conditions[] = $condition;
    }

    public function appendOrder()
    {
        $args   = func_get_args();
        $append = function($order) {
            if ($order instanceOf Order) {
                $this->addOrder($order);
            }
        };

        array_walk($args, $append);
    }

    public function addOrder(Order $order)
    {
        $this->orders[] = $order;
    }

    public function merge(QueryInterface $query)
    {
        foreach ($query->getConditions() as $condition) {
            $this->addCondition($condition);
        }
    }

    public function toArray()
    {
        $conditions = array();
        if (!$this->hasConditions()) {
            return $conditions;
        }

        foreach ($this->getConditions() as $condition) {
            /** @type Condition $condition */
            $conditions[] = $condition->toArray();
        }

        return $conditions;
    }

    public function toString()
    {
        $conditions = "";
        if (!$this->hasConditions()) {
            return $conditions;
        }

        foreach ($this->getConditions() as $condition) {
            /** @type Condition $condition */
            $conditions .= $condition->toString(!empty($conditions));
        }

        return $conditions;
    }

    public function stringifyOrder()
    {
        $orders = "";
        if (!$this->hasOrders()) {
            return $orders;
        }

        foreach ($this->getOrders() as $order) {
            /** @type Order $order */
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

    /**
     * {@inheritdoc}
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * {@inheritdoc}
     */
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
