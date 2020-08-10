<?php

namespace app\controllers;

use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class CustomersController extends Controller
{
    public function actionIndex()
    {
        $records = $this->findRecordsByQuery();
        return $this->render('index', compact('records'));
    }

    private function store(Customer $customer)
    {
        $bthdate = new \DateTime($customer->birth_date);
        $customer->birth_date = $bthdate->format('Y-m-d');

        $customer_record = new CustomerRecord();
        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date;
        $customer_record->notes = $customer->notes;
        /*      var_dump($customer_record);
                die;*/
        $customer_record->save();
/*        var_dump($customer_record->getErrors());
        die;*/

        foreach ($customer->phones as $phone) {
            $phone_record = new PhoneRecord();
            $phone_record->number = $phone->number;
            $phone_record->customer_id = $customer_record->id;
            $phone_record->save();
        }
    }

    private function makeCustomer(
        CustomerRecord $customer_record,
        PhoneRecord $phone_record
    )
    {

        $name = $customer_record->name;
        $customer = new Customer($name, $customer_record->birth_date);

        $customer->notes = $customer_record->notes;

        $phones = explode(',', $phone_record->number);
        foreach ($phones as $phone) {
            $customer->phones[] = new Phone($phone);
        }

        return $customer;
    }

    public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord;

        if ($this->load($customer, $phone, $_POST)) {
            $this->store($this->makeCustomer($customer, $phone));
            return $this->redirect('/customers');
        }

        //$customer и $phone прошли валидацию к этому моменту
        return $this->render('add', compact('customer', 'phone'));
    }

    private function load(CustomerRecord $customer, PhoneRecord $phone, array $post)
    {
        return $customer->load($post)
            and $phone->load($post)
            and $customer->validate()
            and $phone->validate(['number']);
    }


    private function findRecordsByQuery()
    {
        $number = Yii::$app->request->get('phone_number');
        $records = $this->getRecordsByPhoneNumber($number);
        $dataProvider = $this->wrapintoDataProvider($records);
        return $dataProvider;
    }

    private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider(
            [
                'allModels' => $data,
                'pagination' => false
            ]
        );
    }

    private function getRecordsByPhoneNumber($number)
    {
        $phone_record = PhoneRecord::findOne(['number' => $number]);
        if (!$phone_record)
            return [];

        $customer_record = CustomerRecord::findone($phone_record->customer_id);
        if (!$customer_record)
            return [];

        return [$this->makeCustomer($customer_record, $phone_record)];
    }

    public function actionQuery()
    {
        return $this->render('query');
    }
}