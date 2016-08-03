<?php
/**
 * SimpleOrder Module
 *
 * PHP Version 5.4.x
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
namespace Ng\Query\Adapters\SQL\Orders;


use Ng\Query\Interfaces\Order;

/**
 * SimpleOrder Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class SimpleOrder implements Order
{
    protected $field;
    protected $order;

    public function __construct($field, $order=Order::ORDER_DESC)
    {
        $this->field    = $field;
        $this->order    = $order;
    }

    public function setField($field)
    {
        $this->field    = $field;
        return $this;
    }

    public function getField()
    {
        return $this->field;
    }

    public function setOrder($order)
    {
        $this->order    = $order;
        return $this;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function toArray()
    {
        return array(
            "field" => $this->getField(),
            "order" => $this->getOrder(),
        );
    }

    public function toString($useComma)
    {
        $str = sprintf("%s %s", $this->getField(), $this->getOrder());
        if ($useComma === true) {
            $str = sprintf(", %s", $str);
        }

        return $str;
    }
}
