<?php


namespace backend\modules\apple\assets;


use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $sourcePath = '@backend/modules/apple/assets';
    public $js = [
        'scripts/scripts.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}