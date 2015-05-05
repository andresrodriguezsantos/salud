<?php
echo \yii\widgets\MaskedInput::widget([
    'name' => 'ok',
    'mask' => 'g°',
    'definitions' => ['g' => [
        'validator' => '[0-9\(\)\.\+/ ]',
        'cardinality' => 3,
        'prevalidator' => [
            ['validator' => '[01]', 'cardinality' => 1],
            ['validator' => '(1[0-8]|0[0-9])', 'cardinality' => 2],
            ['validator' => '(8[0]|>8[0-9])', 'cardinality' => 3],
        ]
    ]]
]);
