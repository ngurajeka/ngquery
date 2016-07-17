<?php
/**
 * SimpleCondition Module
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


use Ng\Query\Interfaces\Condition;

/**
 * SimpleCondition Module
 *
 * @category Library
 * @package  Library
 * @author   Ady Rahmat MA <adyrahmatma@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/ngurajeka/ngquery
 */
class SimpleCondition implements Condition
{
    protected $field;
    protected $operator;
    protected $value;
    protected $conjunction;

    public function __construct(
        $field, $operator, $value, $conjunction=Condition::CON_AND
    ) {
        $this->field        = $field;
        $this->operator     = $operator;
        $this->value        = $value;
        $this->conjunction  = $conjunction;
    }

    public function setField($field)
    {
        $this->field        = $field;
        return $this;
    }

    public function getField()
    {
        return $this->field;
    }

    public function setOperator($operator)
    {
        $this->operator     = $operator;
        return $this;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setValue($value)
    {
        $this->value        = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setConjunction($conjunction)
    {
        $this->conjunction  = $conjunction;
        return $this;
    }

    public function getConjunction()
    {
        return $this->conjunction;
    }

    public function toArray()
    {
        return array(
            "field"         => $this->getField(),
            "operator"      => $this->getOperator(),
            "value"         => $this->getValue(),
            "conjunction"   => $this->getConjunction(),
        );
    }

    public function toString($useConjunction)
    {
        $str = sprintf(
            "(%s %s %s)", $this->getField(), $this->getOperator(), $this->getValue()
        );

        if ($useConjunction === true) {
            $str = sprintf(" %s %s", $this->getConjunction(), $str);
        }

        return $str;
    }
}
