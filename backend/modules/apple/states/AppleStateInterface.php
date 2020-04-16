<?php


namespace backend\modules\apple\states;


use backend\modules\apple\models\Apple;
use backend\modules\apple\states\exceptions\NotEatableException;
use backend\modules\apple\states\exceptions\NotFallableException;

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
     * @throws NotFallableException
     */
    public function fall() : void;

    /**
     * Метод "Съесть". Принимает на вход количество процентов
     *
     * @param int $percents
     * @return bool|null
     * @throws NotEatableException
     */
    public function eat(int $percents) : ?bool ;
}