<?php


namespace backend\modules\apple\services;


use backend\modules\apple\models\Apple;

class AppleService
{
    public function generate()
    {
        $apple = new Apple();
        $apple->color = $this->generateRandomColor();
        $apple->appeared_at = $this->generateRandomTimestamp();
        $apple->fell_at = null;
        $apple->status = 0;
        $apple->eaten = 0;
        $apple->save();
    }

    private function generateRandomColor() : string
    {
        $color = '#';
        for ($i = 0; $i < 3; $i++) {
            $color .= dechex(rand(0,255));
        }
        return $color;
    }

    private function generateRandomTimestamp() : string
    {
        return rand(1,time());
    }
}