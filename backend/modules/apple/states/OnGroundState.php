<?php


namespace backend\modules\apple\states;


use backend\modules\apple\models\Apple;
use backend\modules\apple\states\exceptions\NotEatableException;
use backend\modules\apple\states\exceptions\NotFallableException;
use Yii;
use yii\db\StaleObjectException;

/**
 * Состояние яблока "На земле"
 *
 * @package backend\modules\apple\states
 */
class OnGroundState implements AppleStateInterface
{
    /**
     * Процентов в яблоке
     */
    const APPLE_PERCENTS = 100;

    /**
     * Период свежести яблока в секундах
     */
    const EXPIRATION_PERIOD = 18000;
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
        throw new NotFallableException(Yii::t('app\error', 'You can\'t drop apple that is already fallen'));
    }

    /**
     * Откусить яблоко
     *
     * @param int $percents
     * @return bool
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function eat(int $percents): bool
    {
        if(!$this->checkIsRotten()) {
            $this->apple->eaten += $percents;
            if ($this->apple->eaten >= self::APPLE_PERCENTS) {
                $this->apple->delete();
                return false;
            }
            return true;
        } else {
            return $this->apple->state->eat($percents);
        }
    }

    /**
     * Проверка, не протухло ли яблоко
     */
    private function checkIsRotten()
    {
        if($this->apple->fell_at + self::EXPIRATION_PERIOD < time()) {
            $this->apple->status = Apple::STATUS_ROTTEN;
            $this->apple->state = new RottenState($this->apple);
        }
    }
}