<?php

namespace backend\modules\apple\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $appeared_at
 * @property int|null $falled_at
 * @property int|null $eaten
 * @property int|null $status
 */
class Apple extends \yii\db\ActiveRecord
{
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
            [['appeared_at', 'falled_at', 'eaten', 'status'], 'integer'],
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
            'falled_at' => Yii::t('apple', 'Falled At'),
            'eaten' => Yii::t('apple', 'Eaten'),
            'status' => Yii::t('apple', 'Status'),
        ];
    }
}
