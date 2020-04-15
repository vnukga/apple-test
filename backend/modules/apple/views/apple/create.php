<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\apple\models\Apple */

$this->title = Yii::t('apple', 'Create Apple');
$this->params['breadcrumbs'][] = ['label' => Yii::t('apple', 'Apples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
