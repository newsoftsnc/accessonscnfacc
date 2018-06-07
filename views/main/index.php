<?php

use yii\helpers\Html;
use newsoftsnc\accessonscnfacc\models\User;

echo Html::encode("Home Page");
echo "<br>";

print_r(Yii::$app->user->identity);

