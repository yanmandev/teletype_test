<?php

namespace app\models;

use yii\db\ActiveQuery;

class ClientQuery extends ActiveQuery
{
    public function byExternalId(string $id): self
    {
        return $this->andWhere(['external_id' => $id]);
    }

    /**
     * @param $db
     * @return array|Client|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}