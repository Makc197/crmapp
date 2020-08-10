<?php
namespace Step\Acceptance;

$I = new CRMOperatorSteps ($scenario) ;
$I->wantTo('add two different customers to database') ;

$I->amInAddCustomerUi();
$first_customer = $I->imagineCustomer();
$I->fillCustomerDataForm($first_customer);
$I->submitCustomerDataForm();
$I->seeIAmInListCustomersUi();

$I->amInAddCustomerUi();
$second_customer = $I->imagineCustomer();
$I->fillCustomerDataForm($second_customer);
$I->submitCustomerDataForm();
$I->amInListCustomersUi();
$I->seeIAmInListCustomersUi();


$I = new CRMUserSteps($scenario);
$I->wantTo('query the customer info using his phone number');

$I->amInQueryCustomersUi();
$I->fillInPhoneFieldWithDataFrom($first_customer);
$I->clickSearchButton();
$I->seeIAmInListCustomersUi();
$I->seeCustomerlnList($first_customer);
$I->dontSeeCustomerlnList($second_customer);