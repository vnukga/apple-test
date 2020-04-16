<?php

namespace backend\modules\apple\models;

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
}
