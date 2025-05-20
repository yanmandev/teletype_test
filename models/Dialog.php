<?php

namespace app\models;

use app\components\ActiveRecord;

/**
 * @property int $id
 * @property string $client_id
 */
class Dialog extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%dialogs}}';
    }
}