<?php


namespace backend\modules\apple\states;

use backend\modules\apple\models\Apple;
use backend\modules\apple\states\exceptions\NotEatableException;
use Yii;

/**
 * Состояние яблока "На дереве"
 *
 * @package backend\modules\apple\states
 */
class OnTreeState implements AppleStateInterface
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
     */
    public function fall(): void
    {
        $this->apple->status = Apple::STATUS_ON_GROUND;
        $this->apple->fell_at = time();
        $this->apple->state = new OnGroundState($this->apple);
    }

    /**
     * Откусить яблоко
     * @param int $percents
     * @return bool|null
     * @throws NotEatableException
     */
    public function eat(int $percents) : ?bool
    {
        throw new NotEatableException(Yii::t('apple/error', 'You can\'t eat apple, that is not on the ground!'));
    }
}