<?php
use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/**
 * Add Customer UI.
 *
 * @var View $this
 * @var CustomerRecord $customer
 * @var PhoneRecord $phone
 */

$form = ActiveForm::begin([
    'id' => 'add-customer-form',
]);

echo $form->errorSummary([$customer, $phone]);
echo $form->field($customer, 'name');

//echo $form->field($customer, 'birth_date');
//echo $form->field($customer, 'birth_date')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'yy-mm-dd']]) ;
echo  $form->field($customer, 'birth_date')->widget(MaskedInput::class, [
    //'mask' => '99.99.9999',
    'clientOptions' => ['alias' =>  'dd.mm.yyyy'],
    ]);

echo $form->field($customer, 'notes');

echo $form->field($phone, 'number');

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);
ActiveForm::end();