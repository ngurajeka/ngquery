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
namespace Ng\Query\Adapters\SQL\Conditions;


use Ng\Query\Exceptions\Exception;
use Ng\Query\Interfaces\Condition;

/**
 * Query Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class ArrayCondition extends SimpleCondition
{
    const INVALID_VALUE = "Invalid Value. Value Should be an Array";

    public function __construct(
        $field, $operator, array $value, $conjunction=Condition::CON_AND
    ) {
        if (!is_array($value)) {
            throw new Exception(self::INVALID_VALUE);
        }

        parent::__construct($field, $operator, $value, $conjunction);
    }

    public function toString($useConjunction)
    {
        $value  = join(",", $this->getValue());
        $str    = sprintf(
            "(%s %s (%s))", $this->getField(), $this->getOperator(), $value
        );

        if ($useConjunction === true) {
            $str = sprintf(" %s %s", $this->getConjunction(), $str);
        }

        return $str;
    }
}
