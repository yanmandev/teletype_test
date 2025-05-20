<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\components\ActiveRecord;

/**
 * @property int $id
 * @property string $client_id
 * @property string $dialog_id
 * @property string $external_id
 * @property string $text
 * @property string $send_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Client $client
 * @property Dialog $dialog
 */
class Message extends ActiveRecord
{
    public function getClient(): ActiveQuery
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    public function getDialog(): ActiveQuery
    {
        return $this->hasOne(Dialog::class, ['id' => 'dialog_id']);
    }

    public static function find(): MessageQuery
    {
        return new MessageQuery(get_called_class());
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
        return '{{%messages}}';
    }
}