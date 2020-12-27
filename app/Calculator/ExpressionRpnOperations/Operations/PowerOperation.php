<?php

namespace App\Calculator\ExpressionRpnOperations\Operations;

/**
 * Class PowerOperation
 * @package App\Calculator\ExpressionRpnOperations\Operations
 */
class PowerOperation implements OperationInterface
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
        return pow($firstNumber, $secondNumber);
    }
}