<?php

namespace backend\modules\apple\models;

use backend\modules\apple\services\AppleService;
use backend\modules\apple\states\AppleStateInterface;
use backend\modules\apple\states\OnGroundState;
use backend\modules\apple\states\OnTreeState;
use backend\modules\apple\states\RottenState;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $appeared_at
 * @property int|null $fell_at
 * @property int|null $eaten
 * @property int|null $status
 */
class Apple extends ActiveRecord
{
    /**
     * Статус "На дереве"
     */
    const STATUS_ON_TREE = 0;

    /**
     * Статус "На земле"
     */
    const STATUS_ON_GROUND = 10;

    /**
     * Статус "Гнилое"
     */
    const STATUS_ROTTEN = 20;

    public AppleStateInterface $state;

    public AppleService $service;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->state = $this->getStateFromStatus();
        $this->service = new AppleService();
    }

    private function getStateFromStatus() : AppleStateInterface
    {
        switch ($this->status) {
            case Apple::STATUS_ON_TREE:
                return new OnTreeState($this);
                break;
            case Apple::STATUS_ON_GROUND:
                return new OnGroundState($this);
                break;
            case Apple::STATUS_ROTTEN:
                return new RottenState($this);
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'appeared_at'], 'required'],
            [['appeared_at', 'fell_at', 'eaten', 'status'], 'integer'],
            [['color'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('apple', 'ID'),
            'color' => Yii::t('apple', 'Color'),
            'appeared_at' => Yii::t('apple', 'Appeared At'),
            'fell_at' => Yii::t('apple', 'Fell At'),
            'eaten' => Yii::t('apple', 'Eaten'),
            'status' => Yii::t('apple', 'Status'),
        ];
    }

    public function fields()
    {
        return [
            'id',
            'color',
            'appeared_at' => function () {
                return $this->service->getAppearedAt($this);
            },
            'fell_at' => function () {
                return $this->service->getFellAt($this);
            },
            'eaten',
            'status' => function () {
                return $this->service->getStatus($this);
            }
        ];
    }
}
