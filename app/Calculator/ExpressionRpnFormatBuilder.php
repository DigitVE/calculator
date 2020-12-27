<?php

namespace App\Calculator;

use App\Stack;
use RuntimeException;

class ExpressionRpnFormatBuilder
{
    /**
     * Приоритет операторов
     * @var int[]
     */
    protected $priorityList = [
        '+' => 4,
        '-' => 4,
        '*' => 5,
        '/' => 5,
        '^' => 6,
        '(' => 10,
        ')' => 10,
    ];
    
    /**
     * Дополнительный приоритет, выставляемый при парсинге скобок
     * @var int 
     */
    protected $additionalPriority = 0;

    /**
     * Массив из выражений и чисел в формате обратной польской записи
     * @var array 
     */
    protected $rpnExpression = [];

    /**
     * Стек операторов
     * @var Stack 
     */
    protected $operators;
    
    public function __construct()
    {
        $this->operators = new Stack();
    }

    /**
     * Собрать выражение в формате обратной польской записи
     *
     * @param $expression
     * @return array
     */
    public function build($expression)
    {
        $expressionChars = $this->tokenize($expression);

        foreach ($expressionChars as $char) {
            if (is_numeric($char)) {
                $this->rpnExpression[] = $char;
            } elseif ($char == '+' || $char == '-' || $char == '*' || $char == '/' || $char == '^') {
                $this->checkOperatorsPriorityAndMoveToRpn($char);

                $this->operators->push([
                    'operator' => $char,
                    'priority' => $this->getPriorityByChar($char),
                ]);
            } elseif ($char == '(') {
                $this->additionalPriority += $this->priorityList[$char];
            } elseif ($char == ')') {
                $this->additionalPriority -= $this->priorityList[$char];
            } else {
                throw new RuntimeException("Unknown character: {$char}");
            }
        }

        while ($operator = $this->operators->pop()) {
            $this->rpnExpression[] = $operator['operator'];
        }

        return $this->rpnExpression;
    }

    /**
     * Вычисление приоритета операторов и их размещение в стеке и RPN записи
     *
     * @param string $char
     */
    protected function checkOperatorsPriorityAndMoveToRpn(string $char)
    {
        while ($lastOperator = $this->operators->poke()) {
            if ($lastOperator && $this->getPriorityByChar($char) <= $lastOperator['priority']) {
                $lastOperator = $this->operators->pop();

                $this->rpnExpression[] = $lastOperator['operator'];
            } else {
                break;
            }
        }
    }

    /**
     * Формирование массива для обхода при составлении RPN записи
     *
     * @param $string
     * @return array
     */
    protected function tokenize($string) {
        return preg_split('((\d+|\+|-|\(|\)|\*|/)|\s+)', $string, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    }

    /**
     * Получить приоритет оператора
     *
     * @param string $char
     * @return int
     */
    protected function getPriorityByChar(string $char)
    {
        return $this->priorityList[$char] + $this->additionalPriority;
    }
}