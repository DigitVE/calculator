<?php

namespace App\Calculator;

use App\Calculator\ExpressionRpnOperations\Operations\AdditionOperation;
use App\Calculator\ExpressionRpnOperations\Operations\DivisionOperation;
use App\Calculator\ExpressionRpnOperations\Operations\MultiplyOperation;
use App\Calculator\ExpressionRpnOperations\Operations\PowerOperation;
use App\Calculator\ExpressionRpnOperations\Operations\SubstractOperation;
use App\Calculator\ExpressionRpnOperations\OperationsContext;
use App\Stack;

class ExpressionRpnFormatCalculation
{
    /**
     * Стек для чисел выражения и финального результата
     * @var Stack
     */
    protected $numbersStack;

    /**
     * Контекст типа выполнения операции над числами
     * @var OperationsContext
     */
    protected $operationsContext;

    /**
     * Соотношение возможных операций над числами и классов, где будут производиться операции над ними
     * @var string[]
     */
    protected $operatorsClasses = [
        '+' => AdditionOperation::class,
        '-' => SubstractOperation::class,
        '*' => MultiplyOperation::class,
        '/' => DivisionOperation::class,
        '^' => PowerOperation::class,
    ];

    /**
     * ExpressionRpnFormatCalculation constructor.
     */
    public function __construct()
    {
        $this->numbersStack = new Stack();
        $this->operationsContext = new OperationsContext();
    }

    /**
     * Вычисление результата RPN записи
     *
     * @param array $rpnExpression
     * @return mixed
     */
    public function calculate(array $rpnExpression)
    {
        foreach ($rpnExpression as $char) {
            if (is_numeric($char)) {
                $this->numbersStack->push($char);
            } else {
                $secondNumber = $this->numbersStack->pop();
                $firstNumber = $this->numbersStack->pop();

                $operatorTypeClass = $this->operatorsClasses[$char];

                $this->operationsContext->setOperation(new $operatorTypeClass());
                $result = $this->operationsContext->operate($secondNumber, $firstNumber);

                $this->numbersStack->push($result);
            }
        }

        return $this->numbersStack->pop();
    }
}