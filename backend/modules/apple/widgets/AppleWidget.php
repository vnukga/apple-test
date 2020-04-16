<?php


namespace backend\modules\apple\widgets;

use backend\modules\apple\models\Apple;
use backend\modules\apple\services\AppleService;
use Yii;
use yii\base\Widget;

/**
 * Class AppleWidget
 * Виджет для формирования элемента яблока на странице
 *
 * @package backend\modules\apple\widgets
 */
class AppleWidget extends Widget
{
    /**
     * Объект яблока
     *
     * @var Apple
     */
    public Apple $apple;

    public AppleService $service;

    public function init()
    {
        parent::init();
        $this->service = new AppleService();
    }

    /**
     * Запуск виджета
     *
     * @return string
     */
    public function run()
    {
        return
        '<div class="well col-xs-4" id="apple-item-' . $this->apple->id .'">' .
            $this->getPropertiesTable() .
            $this->getButtons() .
        '</div>';
    }

    /**
     * Таблица со свойствами
     *
     * @return string
     */
    private function getPropertiesTable() : string
    {
        $appeared_at = $this->service->getAppearedAt($this->apple);
        $fell_at = $this->service->getFellAt($this->apple);
        $status = $this->service->getStatus($this->apple);
        return '
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>' . $this->apple->id . '</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">' . Yii::t('apple', 'Color') .'</th>
                        <td><span style="color:' . $this->apple->color .'">' . $this->apple->color .'</span></td>
                    </tr>
                    <tr>
                        <th scope="row">' . Yii::t('apple', 'Appeared At') .'</th>
                        <td>' . $appeared_at  .'</td>
                    </tr>
                    <tr>
                        <th scope="row">' . Yii::t('apple', 'Fell At') .'</th>
                        <td class="apple-fell-at">' .  $fell_at .'</td>
                    </tr>
                    <tr>
                        <th scope="row">' . Yii::t('apple', 'Status') .'</th>
                        <td class="apple-status">' . $status .'</td>
                    </tr>
                    <tr>
                        <th scope="row">' . Yii::t('apple', 'Eaten') .'</th>
                        <td class="apple-eaten">' . $this->apple->eaten .'</td>
                    </tr>
                </tbody>
            </table>';
    }

    /**
     * Кнопки взаимодействия с яблоком
     *
     * @return string
     */
    private function getButtons() : string
    {
        return '
            <div class="row" style="height: 75px">
                <button class="btn btn-info col-xs-3 apple-fall" data-id="' . $this->apple->id . '">' . Yii::t('apple', 'Drop') .'</button>
                    <div class="col-xs-1"></div>
                    <div class="col-xs-8">
                <div class="input-group">
                    <span class="glyphicon form-control-feedback"></span> 
                    <span class="input-group-btn">
                      <button class="btn btn-default apple-eat" type="button" data-id="' . $this->apple->id . '">' . Yii::t('apple', 'Eat (%)') .'</button>
                    </span>
                    <input type="text" class="form-control is-invalid">
                </div>
              </div>
            </div>
        ';
    }


}