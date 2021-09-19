<?php


namespace App\Shared\Infrastructure\Persistence\Doctrine;


use App\Shared\Domain\Criteria\Criteria;
use App\Shared\Domain\Criteria\Filter;
use App\Shared\Domain\Criteria\FilterOperator;
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;

final class DoctrineCriteriaConverter
{
    public static function convert(Criteria $criteria, string $model = 'WriteModel'): DoctrineCriteria
    {
        return new DoctrineCriteria(
            DoctrineCriteriaConverter::createCompositeExpression($criteria->filters(), $model),
            DoctrineCriteriaConverter::createOrder($criteria->order(), $model),
            $criteria->offset()->value(),
            $criteria->limit()->value()
        );
    }

    private static function createCompositeExpression(array $filters, string $model): ?CompositeExpression
    {
        if (count($filters) === 0) {
            return null;
        }

        $comparisonCollection = [];

        /** @var Filter $filter */
        foreach ($filters as $filter) {
            $field = ($model === 'WriteModel') ? $filter->field()->value().'.value' : $filter->field()->value();
            $operator = self::doctrineOperator($filter->operator()->value());
            $value = $filter->value()->value();
            $comparisonCollection[] = new Comparison($field, $operator, $value);
        }

        return new CompositeExpression(CompositeExpression::TYPE_AND, $comparisonCollection);
    }
    //TODO: refactoring
    private static function doctrineOperator(string $operator)
    {
        return match ($operator) {
            FilterOperator::OPERATOR_EQ => '=',
            FilterOperator::OPERATOR_NEQ => '<>',
            FilterOperator::OPERATOR_LT => '<',
            FilterOperator::OPERATOR_LTE => '<=',
            FilterOperator::OPERATOR_GT => '>',
            FilterOperator::OPERATOR_GTE => '>=',
            FilterOperator::OPERATOR_IN => 'IN',
            FilterOperator::OPERATOR_CONTAINS => 'CONTAINS',
            default => '',
        };
    }

    public static function createOrder(array $order, string $model): ?array
    {
        if (count($order) === 0) {
            return null;
        }

        $orderCollection = array();

        foreach ($order as $o) {
            $field = ($model === 'WriteModel') ? $o->field()->value().'.value' : $o->field()->value();
            $orderCollection[$field] = $o->direction()->value();
        }

        return $orderCollection;
    }
}