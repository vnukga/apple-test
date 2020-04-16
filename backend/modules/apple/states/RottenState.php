<?php


namespace backend\modules\apple\states;

use backend\modules\apple\models\Apple;
use backend\modules\apple\states\exceptions\NotEatableException;
use backend\modules\apple\states\exceptions\NotFallableException;
use Yii;

/**
 * Состояние яблока "Гнилое"
 *
 * @package backend\modules\apple\states
 */
class RottenState implements AppleStateInterface
{
    /**
     * Объект яблока
     *
     * @var Apple
     */
    private Apple $apple;

    public function __construct(Apple $apple)
    {
        $this->apple = $apple;
    }

    /**
     * Уронить яблоко
     * @throws NotFallableException
     */
    public function fall(): void
    {
        throw new NotFallableException(Yii::t('app\error', 'You can\'t drop rotten apple!'));
    }

    /**
     * Откусить яблоко
     * @param int $percents
     * @return bool|null
     * @throws NotEatableException
     */
    public function eat(int $percents): ?bool
    {
        throw new NotEatableException(Yii::t('app\error', 'You can\'t eat rotten apple!'));
    }
}