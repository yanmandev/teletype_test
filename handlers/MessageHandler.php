<?php

namespace app\handlers;

use app\dto\MessageDto;
use app\helpers\DbHelper;
use app\models\Client;
use app\models\Dialog;
use app\models\Message;

class MessageHandler
{
    public function handle(MessageDto $dto): bool
    {
        DbHelper::ensureTransaction();

        $message = $this->findMessage($dto->messageId);

        if ($message !== null) {
            return false;
        }

        $client = $this->findClient($dto->clientId);
        $dialog = null;

        if ($client === null) {
            $client = new Client();
            $client->external_id = $dto->clientId;
            $client->phone = $dto->phone;
            $client->trySave(false);

            $dialog = new Dialog();
            $dialog->client_id = $client->id;
            $dialog->trySave();
        }

        $message = new Message();
        $message->client_id = $client->id;
        $message->dialog_id = $dialog ? $dialog->id : $client->dialog->id;
        $message->external_id = $dto->messageId;
        $message->send_at = $dto->sendAt;
        $message->text = $dto->text;

        return $message->trySave(false);
    }

    private function findClient(string $externalId): ?Client
    {
        return Client::find()->byExternalId($externalId)->one();
    }

    private function findMessage(string $externalId): ?Message
    {
        return Message::find()->byExternalId($externalId)->one();
    }
}