<?php

use backend\modules\apple\widgets\AppleWidget;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\apple\models\AppleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('apple', 'Apples');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('apple', 'Create Apple'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <?php foreach ($apples as $apple): ?>
            <?= AppleWidget::widget(['apple' => $apple]); ?>
        <?php endforeach; ?>
    </div>


</div>
