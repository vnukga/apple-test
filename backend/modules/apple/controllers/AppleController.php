<?php

namespace backend\modules\apple\controllers;

use backend\modules\apple\services\AppleService;
use Yii;
use backend\modules\apple\models\Apple;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppleController implements the CRUD actions for Apple model.
 */
class AppleController extends Controller
{
    /**
     * Лимит генерации яблок
     */
    const GENERATION_LIMIT = 100;

    /**
     * Служба для работы с яблоками
     *
     * @var AppleService
     */
    private AppleService $service;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = new AppleService();
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Отображает все яблоки
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $apples = Apple::find()->all();
        return $this->render('index', [
           'apples' => $apples
        ]);
    }

    /**
     * Генерирует произвольное количество яблок
     *
     * @return \yii\web\Response
     */
    public function actionGenerate()
    {
        $quantity = rand(1, self::GENERATION_LIMIT);
        for ($i = 0; $i <= $quantity; $i++){
            $this->service->generate();
        }
        Yii::$app->session->setFlash('success', Yii::t('apple', 'Apples have been generated: ') . $i);
        return $this->redirect('index');
    }
}
