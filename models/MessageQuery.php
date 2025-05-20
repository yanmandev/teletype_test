<?php

namespace app\models;

use yii\db\ActiveQuery;

class MessageQuery extends ActiveQuery
{
    public function byClientId(string $id): self
    {
        return $this->andWhere(['client_id' => $id]);
    }

    public function byExternalId(string $id): self
    {
        return $this->andWhere(['external_id' => $id]);
    }

    /**
     * @param $db
     * @return array|Message|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}