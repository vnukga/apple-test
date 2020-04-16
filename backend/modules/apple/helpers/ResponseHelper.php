<?php


namespace backend\modules\apple\helpers;

use Yii;

class ResponseHelper
{
    public function responseSuccess($data = []) : array
    {
        return [
            'success' => true,
            'data' => $data
        ];
    }

    public function responseError($data = [], int $statusCode = 500) : array
    {
        Yii::$app->response->setStatusCode($statusCode);
        return [
            'error' => true,
            'data' => $data
        ];
    }
}