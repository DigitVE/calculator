<?php

namespace App\Calculator\ExpressionRpnOperations\Operations;

/**
 * Interface OperationInterface
 * @package App\Calculator\ExpressionRpnOperations\Operations
 */
interface OperationInterface
{
    /**
     * Произвести математическую операцию над числами
     *
     * @param float $firstNumber
     * @param float $secondNumber
     * @return mixed
     */
    public function operate(float $firstNumber, float $secondNumber);
}