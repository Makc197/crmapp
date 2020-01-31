<?php

use yii\helpers\Url;

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('/site/index');
        $I->see('My Company');
        
        $I->seeLink('About');
        $I->click('About');
        $I->pause(2); // wait for page to be opened
        
        $I->see('This is the About page.');
    }
}
