<?php

namespace App\Calculator;

class Expression
{
    /**
     * Выражение в инфиксной нотации
     * @var string
     */
    protected $expression;

    /**
     * Конечный результат вычислений
     * @var integer
     */
    protected $result;

    /**
     * Объект для сборки в формат для дальнейшего вычисления выражения
     * @var ExpressionRpnFormatBuilder
     */
    protected $builder;

    /**
     * Объект для вычисления выражения в определённом формате
     * @var ExpressionRpnFormatCalculation
     */
    protected $calculation;

    /**
     * Expression constructor.
     * @return void
     */
    public function __construct()
    {
        $this->builder = new ExpressionRpnFormatBuilder();
        $this->calculation = new ExpressionRpnFormatCalculation();
    }

    /**
     * Подготовка и вычисление выражения
     *
     * @return void
     */
    public function perform()
    {
        $rpn = $this->builder->build($this->expression);
        $result = $this->calculation->calculate($rpn);

        $this->setResult($result);
    }

    /**
     * Установить выражение для дальнейших операций над ним
     *
     * @param $expression
     * @return void
     */
    public function setExpression(string $expression)
    {
        $this->expression = $expression;
    }

    /**
     * Установить конечный результат вычислений
     *
     * @param $number
     * @return void
     */
    protected function setResult($number)
    {
        $this->result = $number;
    }

    /**
     * Получить конечный результат вычислений
     *
     * @return int
     */
    public function getResult()
    {
        return $this->result;
    }
}