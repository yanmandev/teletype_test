<?php

namespace app\components;

use yii\helpers\VarDumper;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     * @throws \yii\db\Exception
     */
    public function trySave($runValidation = true, $attributeNames = null)
    {
        if (false === $this->save($runValidation, $attributeNames)) {
            throw new \LogicException("Saving error: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function tryUpdate($runValidation = true, $attributeNames = null)
    {
        if (false === $this->update($runValidation, $attributeNames)) {
            throw new \LogicException("Saving error: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     * @throws \Throwable
     */
    public function tryInsert($runValidation = true, $attributeNames = null)
    {
        if (false === $this->insert($runValidation, $attributeNames)) {
            throw new \LogicException("Saving error: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }
}