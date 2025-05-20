<?php

namespace app\forms;

use yii\base\Model;
use app\dto\MessageDto;

class MessageForm extends Model
{
    public ?string $clientId = null;
    public ?string $messageId = null;
    public ?string $phone = null;
    public ?string $text = null;
    public ?string $sendAt = null;

    public function rules(): array
    {
        return [
            [['clientId', 'messageId', 'phone', 'text', 'sendAt'], 'filter', 'filter' => 'trim', 'skipOnEmpty' => true],

            [['clientId', 'messageId', 'phone', 'text', 'sendAt'], 'required'],
            [['clientId', 'messageId'], 'string', 'length' => 32],
            [['phone'], 'string', 'length' => 12],
            [['text'], 'string', 'min' => 1, 'max' => 4096],
            [['sendAt'], 'number', 'integerOnly' => true],
        ];
    }

    public function createDto(): MessageDto
    {
        return new MessageDto([
            'clientId' => $this->clientId,
            'messageId' => $this->messageId,
            'phone' => $this->phone,
            'text' => $this->text,
            'sendAt' => $this->sendAt,
        ]);
    }
}