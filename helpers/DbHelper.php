<?php

namespace app\helpers;

use Yii;
use yii\db\ActiveQuery;

class DbHelper
{
    /**
     * Ensure that operation processing in transaction
     * @throws \LogicException
     */
    public static function ensureTransaction()
    {
        if (!Yii::$app->db->getTransaction() instanceof \yii\db\Transaction) {
            throw new \LogicException("DB Transaction required");
        }
    }

    public static function wrapQuery(ActiveQuery $query): ActiveQuery
    {
        $newQuery = new ActiveQuery($query->modelClass);
        $newQuery->from(['originalQuery' => $query]);

        return $newQuery;
    }
}