<?php


namespace backend\modules\apple\states;


use backend\modules\apple\models\Apple;

/**
 * Интерфейс для состояний яблока
 *
 * @package backend\modules\apple\states
 */
interface AppleStateInterface
{
    public function __construct(Apple $apple);

    /**
     * Метод "Упасть"
     */
    public function fall() : void;

    /**
     * Метод "Съесть". Принимает на вход количество процентов
     *
     * @param int $percents
     */
    public function eat(int $percents) : void;
}