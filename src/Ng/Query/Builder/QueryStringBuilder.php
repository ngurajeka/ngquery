<?php
namespace Ng\Query\Builder;


use Ng\Query\Adapters\SQL\Conditions\ArrayCondition;
use Ng\Query\Adapters\SQL\Conditions\SimpleCondition;
use Ng\Query\Adapters\SQL\Orders\SimpleOrder;
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
        $this->extractOrder();
        $this->extractPage();
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

    protected function extractOrder()
    {
        if (!array_key_exists("sort", $this->source)) {
            return;
        }

        if (is_array($this->source["sort"])) {
            return;
        }

        $unsorted = $this->source["sort"];
        $this->buildOrder($unsorted);
    }

    protected function buildOrder($unsorted)
    {
        $order = substr($unsorted, 0, 1);
        switch ($order) {
        case "+":
            $this->addOrder(substr($unsorted, 1), "ASC");
            break;
        case "-":
            $this->addOrder(substr($unsorted, 1), "DESC");
            break;
        default:
            $this->addOrder($unsorted, "ASC");
            break;
        }
    }

    protected function addOrder($field, $order)
    {
        $this->query->addOrder(new SimpleOrder($field, $order));
    }

    protected function extractPage()
    {
        if (array_key_exists("pageSize", $this->source)) {
            $this->addPageSize($this->source["pageSize"]);
        }
        if (array_key_exists("pageNumber", $this->source)) {
            $this->addPageNumber($this->source["pageNumber"]);
        }
    }

    protected function addPageSize($pageSize)
    {
        $this->query->setLimit((int) $pageSize);
    }

    protected function addPageNumber($pageNumber)
    {
        $this->query->setOffset((int) $pageNumber);
    }

    public function getQuery()
    {
        return $this->query;
    }
}
