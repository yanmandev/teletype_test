<?php

namespace app\controllers;

use Yii;
use yii\helpers\Json;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use app\forms\MessageForm;
use app\handlers\MessageHandler;

class WebhookController extends Controller
{
    private MessageHandler $handler;

    public function __construct($id, $module, MessageHandler $handler, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->handler = $handler;
    }

    public function actionIndex(): bool
    {
        $data = Json::decode($this->request->getRawBody());

        $form = new MessageForm();
        $form->load($this->prepareData($data), '');

        if (!$form->validate()) {
            throw new BadRequestHttpException("Invalid request data.");
        }

        $dbTransaction = ActiveRecord::getDb()->beginTransaction(Transaction::READ_COMMITTED);
        try {
            $this->handler->handle($form->createDto());

            $dbTransaction->commit();

            return true;
        } catch (\Throwable $err) {
            $dbTransaction->rollBack();

            Yii::error($err, __METHOD__);
        }

        return false;
    }

    private function prepareData(array $data): array
    {
        $params = [
            'external_client_id' => 'clientId',
            'external_message_id' => 'messageId',
            'client_phone' => 'phone',
            'message_text' => 'text',
            'send_at' => 'sendAt',
        ];

        $result = [];

        foreach ($data as $param => $val) {
            if (isset($params[$param])) {
                $result[$params[$param]] = $val;
            }
        }

        return $result;
    }
}
