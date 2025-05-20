<?php

namespace app\dto;

use Spatie\DataTransferObject\DataTransferObject;

class MessageDto extends DataTransferObject
{
    public string $clientId;
    public string $messageId;
    public string $phone;
    public string $text;
    public string $sendAt;
}