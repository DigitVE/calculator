<?php

namespace App;

/**
 * Class Stack
 * @package App
 */
class Stack
{
    /**
     * Информация в стеке
     * @var array
     */
    public $stackData = [];

    /**
     * Внести элемент в стек
     *
     * @param $element
     */
    public function push($element) {
        $this->stackData[] = $element;
    }

    /**
     * Вынести последний добавленный элемент из стека
     *
     * @return mixed
     */
    public function pop() {
        return array_pop($this->stackData);
    }

    /**
     * Получить последний добавленный элемент из стека без его удаления
     *
     * @return mixed
     */
    public function poke() {
        return end($this->stackData);
    }
}