<?php
namespace Ng\Query\Builder;


use Ng\Query\Adapters\SQL\Conditions\ArrayCondition;
use Ng\Query\Adapters\SQL\Conditions\SimpleCondition;
use Ng\Query\Adapters\SQL\Query;
use Ng\Query\Helpers\Operator;

class QueryStringBuilder
{
    protected $operators    = array(">", ">=", "<", "<=", "!=", "in");

    /** @type Query $query */
    protected $query;
    protected $source = array();

    public function __construct(array $source)
    {
        $this->query    = new Query();
        $this->source   = $source;
    }

    public function addOperators(array $operators)
    {
        foreach ($operators as $operator) {
            if (!in_array($operator, $this->operators)) {
                $this->operators[] = $operator;
                continue;
            }
        }
    }

    public function build()
    {
        $this->extractFilter();
    }

    protected function addSimpleCondition($field, $operator, $value)
    {
        $this->query->addCondition(
            new SimpleCondition($field, $operator, $value)
        );
    }

    protected function addArrayCondition($field, $operator, array $value)
    {
        $this->query->addCondition(
            new ArrayCondition($field, $operator, $value)
        );
    }

    protected function extractFilter()
    {
        $filters = array();

        if (array_key_exists("filter", $this->source)) {
            if (is_array($this->source["filter"])) {
                $filters = $this->source["filter"];
            }
        }

        $this->buildFilter($filters);
    }

    protected function buildFilter(array $filters)
    {
        foreach ($filters as $field => $value) {

            if (is_integer($field)) {
                continue;
            }

            if (is_array($value)) {
                $this->extractArray($field, $value);
                continue;
            }

            $this->addSimpleCondition($field, Operator::OP_EQUALS, $value);
        }
    }

    protected function extractArray($field, array $value)
    {
        foreach ($value as $key => $val) {

            $key = strtoupper($key);

            switch ($key) {
            case Operator::OP_IN:
                if (!is_array($val)) {
                    $val = $this->stringToArray($val);
                }

                $this->addArrayCondition($field, $key, $val);
                break;
            default:
                if (in_array($key, Operator::getOperators())) {
                    $this->addSimpleCondition($field, $key, $val);
                    continue;
                }

                $this->addSimpleCondition($field, Operator::OP_EQUALS, $val);
                break;
            }

        }
    }

    protected function stringToArray($str, $delimiter=",")
    {
        return explode($delimiter, $str);
    }

    public function getQuery()
    {
        return $this->query;
    }

}
