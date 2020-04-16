<?php


namespace backend\modules\apple\states\exceptions;


use yii\base\Exception;

/**
 * Исключение для повторных попыток уронить яблоко
 *
 * @package backend\modules\apple\states\exceptions
 */
class NotFallableException extends Exception
{

}