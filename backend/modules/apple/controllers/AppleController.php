<?php

namespace backend\modules\apple\controllers;

use backend\modules\apple\helpers\ResponseHelper;
use backend\modules\apple\services\AppleService;
use backend\modules\apple\states\exceptions\NotEatableException;
use backend\modules\apple\states\exceptions\NotFallableException;
use Yii;
use backend\modules\apple\models\Apple;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

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

    private ResponseHelper $helper;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = new AppleService();
        $this->helper = new ResponseHelper();
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
     * @return Response
     */
    public function actionGenerate()
    {
        $quantity = rand(1, self::GENERATION_LIMIT);
        for ($i = 0; $i <= $quantity; $i++){
            $this->service->generate();
        }
        Yii::$app->session->setFlash('success', Yii::t('apple', 'Apples have been generated: ') . $i);
        return $this->redirect(Url::home() . 'apple');
    }

    /**
     * Уронить яблоко
     *
     * @return array|Response
     */
    public function actionFall()
    {
        if(!Yii::$app->request->isAjax) {
            return $this->redirect(Url::home() . 'apple');
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $apple = Apple::findOne(['id' => $id]);
        try {
            $this->service->fall($apple);
        } catch (NotFallableException $exception) {
            return $this->helper->responseError(['exception' => $exception->getMessage()]);
        }
        return $this->helper->responseSuccess($apple);
    }

    /**
     * Откусить яблоко
     *
     * @return array|Response
     */
    public function actionEat()
    {
        if(!Yii::$app->request->isAjax) {
            return $this->redirect(Url::home() . 'apple');
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $percents = Yii::$app->request->post('percents');
        $apple = Apple::findOne(['id' => $id]);
        try {
            if(!$this->service->eat($apple, $percents)) {
                return $this->helper->responseError(['eaten' => Yii::t('app/error', 'Apple was completely eaten!')]);
            }
        } catch (NotEatableException $exception) {
            return $this->helper->responseError(['exception' => $exception->getMessage()]);
        }
        return $this->helper->responseSuccess($apple);
    }
}
