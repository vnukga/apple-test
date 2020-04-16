<?php


namespace backend\modules\apple\services;

use backend\modules\apple\models\Apple;
use Yii;

/**
 * Служба для работы с яблоками
 *
 * @package backend\modules\apple\services
 */
class AppleService
{
    /**
     * Генерация яблока
     */
    public function generate()
    {
        $apple = new Apple();
        $apple->color = $this->generateRandomColor();
        $apple->appeared_at = $this->generateRandomTimestamp();
        $apple->fell_at = null;
        $apple->status = Apple::STATUS_ON_TREE;
        $apple->eaten = 0;
        $apple->save();
    }

    public function fall(Apple $apple)
    {
        $apple->state->fall();
        $apple->save();
    }

    public function eat(Apple $apple, int $percents)
    {
        $apple->state->eat($percents);
        $apple->save();
    }

    public function getAppearedAt(Apple $apple) : string
    {
        return date('Y-m-d H:i:s', $apple->appeared_at);
    }

    public function getFellAt(Apple $apple) : string
    {
        return $apple->fell_at ? date('Y-m-d H:i:s', $apple->fell_at) : '';
    }

    /**
     * Получение текстового статуса яблока
     *
     * @param Apple $apple
     * @return string
     */
    public function getStatus(Apple $apple) : string
    {
        switch ($apple->status) {
            case Apple::STATUS_ON_TREE:
                return Yii::t('apple', 'On tree');
                break;
            case Apple::STATUS_ON_GROUND:
                return Yii::t('apple', 'On ground');
                break;
            case Apple::STATUS_ROTTEN:
                return Yii::t('apple', 'Rotten');
                break;
        }
    }

    /**
     * Генерация случайного цвета
     *
     * @return string
     */
    private function generateRandomColor() : string
    {
        $color = '#';
        for ($i = 0; $i < 3; $i++) {
            $color .= dechex(rand(0,255));
        }
        return $color;
    }

    /**
     * Генерация случайной метки времени
     *
     * @return string
     */
    private function generateRandomTimestamp() : string
    {
        return rand(1,time());
    }
}