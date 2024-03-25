<?php

namespace app\models;

use yii\db\ActiveRecord;

// Модель для взаимодействия с таблицей рандомных чисел
class RandNumbers extends ActiveRecord
{
    public static function tableName()
    {
        return 'rand_numbers';
    }
}