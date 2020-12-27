<?php

namespace App\Calculator\ExpressionRpnOperations;

use App\Calculator\ExpressionRpnOperations\Operations\OperationInterface;

/**
 * Class OperationsContext
 * @package App\Calculator\ExpressionRpnOperations
 */
class OperationsContext
{
    /**
     * Тип математической операции
     * @var OperationInterface
     */
    protected $operation;

    /**
     * Назначить тип операции
     *
     * @param $operation
     */
    public function setOperation(OperationInterface $operation)
    {
        $this->operation = $operation;
    }

    /**
     * Произвести операцию над числами
     *
     * @param $secondNumber
     * @param $firstNumber
     * @return mixed
     */
    public function operate($secondNumber, $firstNumber)
    {
        return $this->operation->operate($firstNumber, $secondNumber);
    }
}