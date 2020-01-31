<?php

namespace Step\Acceptance;

class CRMUserSteps extends \AcceptanceTester
{
    function amInQueryCustomersUi()
    {
        $I = $this;
        $I->amOnPage('/customers/query');
    }

    function flllInPhoneFieldWithDataFrom($customer_data)
    {
        $I = $this;
        $I->fillField(
            'PhoneRecord[number]',
            $customer_data['PhoneRecord[number]']);
    }

    function clickSearchButton()
    {
        $I = $this;
        $I->click('Search');
    }

    function seeCustomerlnList($customer_data)
    {
        $I = $this;
        $I->see($customer_data['CustomerRecord[name] '], '#search results');
    }

    function dontSeeCustomerlnList($customer_data)
    {
        $I = $this;
        $I->dontSee($customer_data['CustomerRecord[name]'],'#search_results');
    }


}