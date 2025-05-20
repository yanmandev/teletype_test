<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\components\ActiveRecord;

/**
 * @property int $id
 * @property string $external_id
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Dialog $dialog
 */
class Client extends ActiveRecord
{
    public function getDialog(): ActiveQuery
    {
        return $this->hasOne(Dialog::class, ['client_id' => 'id']);
    }

    public static function find(): ClientQuery
    {
        return new ClientQuery(get_called_class());
    }

    public function behaviors(): array
    {
        return [
            'ts' => [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()')
            ],
        ];
    }

    public static function tableName(): string
    {
        return '{{%clients}}';
    }
}