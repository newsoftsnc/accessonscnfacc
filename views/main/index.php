<?php

use yii\helpers\Html;

echo Html::encode("Home Page");
echo "<br>";

print_r(Yii::$app->user->identity);

