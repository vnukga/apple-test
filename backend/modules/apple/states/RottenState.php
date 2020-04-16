<?php


namespace backend\modules\apple\states;


use backend\modules\apple\models\Apple;

class RottenState implements AppleStateInterface
{

    public function __construct(Apple $apple)
    {
    }

    /**
     * @inheritDoc
     */
    public function fall(): void
    {
        // TODO: Implement fall() method.
    }

    /**
     * @inheritDoc
     */
    public function eat(int $percent): void
    {
        // TODO: Implement eat() method.
    }
}