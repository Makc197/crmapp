<?php

use yii\helpers\Html;

echo Html::beginform(['/customers'], 'get');
echo Html::label('Phone number to search: ', 'phone _ number');
echo Html::textInput('phone_number');
echo Html::submitButton('Search');
echo Html::endForm();