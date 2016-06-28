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
namespace Ng\Query\Order;


use Ng\Query\OrderInterface;

/**
 * Query Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class SimpleOrder implements OrderInterface
{
    const ORDER_ASC     = "ASC";
    const ORDER_DESC    = "DESC";

    protected $field;
    protected $order;

    public function __construct($field, $order=self::ORDER_DESC)
    {
        $this->field    = $field;
        $this->order    = $order;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getOrder()
    {
        return $this->order;
    }

    // extracting the condition as an array
    public function toArray()
    {
        return array(
            "field" => $this->getField(),
            "order" => $this->getOrder(),
        );
    }

    // extracting the condition as a string
    // receiving parameter useConjunction as bool
    public function toString($useComma)
    {
        $str = sprintf("%s %s", $this->getField(), $this->getOrder());
        if ($useComma === true) {
            $str = sprintf(", %s", $str);
        }

        return $str;
    }
}
