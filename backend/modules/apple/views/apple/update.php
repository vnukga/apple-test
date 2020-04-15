<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\apple\models\Apple */

$this->title = Yii::t('apple', 'Update Apple: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('apple', 'Apples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('apple', 'Update');
?>
<div class="apple-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
