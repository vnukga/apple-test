<?php


namespace backend\modules\apple\services;

use backend\modules\apple\models\Apple;

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