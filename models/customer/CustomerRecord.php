<?php

namespace app\models;

use yii\db\ActiveRecord;

class CustomerRecord extends ActiveRecord

public static function tableName()
{
    return 'customer';
}
