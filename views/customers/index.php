<?php
echo \yii\widgets\ListView::widget(
    [
        'options' => [
            'class' => 'list-view',
            'id' => 'search results'
        ],
        'itemView' => '_customer',
        'dataProvider' => $records
    ]
);