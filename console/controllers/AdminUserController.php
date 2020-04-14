<?php


namespace console\controllers;

use common\models\SignupForm;
use yii\base\Exception;
use yii\console\Controller;

/**
 * Класс, отвечающий за создание администратора
 *
 * @package console\controllers
 */
class AdminUserController extends Controller
{
    /**
     * `yii admin-user/create` - создание записи администратора в БД.
     *
     * @return string|true
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new SignupForm();
        $model->username = $this->prompt('Введите имя пользователя:', ['required' => true]);
        $model->email = $this->prompt('Введите e-mail:', ['required' => true]);
        $model->password = $this->prompt('Введите пароль:', ['required' => true]);
        if ($user = $model->signup()) {
            return print_r('Пользователь ' . $model->username . ' добавлен');
        } else {
            var_dump($model->errors);
        }
    }
}