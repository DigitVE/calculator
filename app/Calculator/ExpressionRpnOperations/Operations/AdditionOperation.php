<?php

namespace App\Calculator\ExpressionRpnOperations\Operations;

/**
 * Class AdditionOperation
 * @package App\Calculator\ExpressionRpnOperations\Operations
 */
class AdditionOperation implements OperationInterface
{
    /**
     * Произвести математическую операцию над числами
     *
     * @param float $firstNumber
     * @param float $secondNumber
     * @return float|int
     */
    public function operate(float $firstNumber, float $secondNumber)
    {
        return $firstNumber + $secondNumber;
    }
}