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
namespace Ng\Query\Condition;


use Ng\Query\ConditionInterface;

/**
 * Query Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class SimpleCondition implements ConditionInterface
{
    const CON_AND   = "AND";
    const CON_OR    = "OR";

    protected $field;
    protected $operator;
    protected $value;
    protected $conjunction;

    public function __construct($field, $operator, $value, $conjunction=self::CON_AND)
    {
        $this->field        = $field;
        $this->operator     = $operator;
        $this->value        = $value;
        $this->conjunction  = $conjunction;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function getValue()
    {
        return $this->value;
    }

    // get the conjunction of the condition
    // like (AND) / (OR)
    public function getConjunction()
    {
        return $this->conjunction;
    }

    // extracting the condition as an array
    public function toArray()
    {
        return array(
            "field"         => $this->getField(),
            "operator"      => $this->getOperator(),
            "value"         => $this->getValue(),
            "conjunction"   => $this->getConjunction(),
        );
    }

    // extracting the condition as a string
    // receiving parameter useConjunction as bool
    public function toString($useConjunction)
    {
        $str = sprintf(
            "(%s %s '%s')", $this->getField(), $this->getOperator(), $this->getValue()
        );

        if ($useConjunction === true) {
            $str = sprintf("%s %s", $this->getConjunction(), $str);
        }

        return $str;
    }
}
