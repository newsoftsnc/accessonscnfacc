<?php

namespace newsoftsnc\accessonscnfacc\models;

use yii\db\ActiveRecord;

class Insta extends ActiveRecord {

    public static function tableName() {
        return 'insta';
	}

	public function getClienti() {
	    return $this->hasOne(Clienti::className(), ['CLCOD'=>'CLIENTICLCOD']);
	}
	
	public function getEnable() {
	    return $this->hasMany(Enable::className(), ['CLIENTICLCOD'=>'CLIENTICLCOD','APPLICAPCOD'=>'APPLICAPCOD','INDBN'=>'INSTAINDBN']);
	}
}