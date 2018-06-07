<?php

namespace newsoftsnc\accessonscnfacc\models;

use yii\db\ActiveRecord;

class Clienti extends ActiveRecord {

	public static function tableName() {
	    return 'clienti';
	}
			
	public function getUtenti() {
	    return $this->hasMany(Utenti::className(), ['CLCOD'=>'CLIENTICLCOD']);
	}

	public function getInsta() {
	    return $this->hasMany(Insta::className(), ['CLCOD'=>'CLIENTICLCOD']);
	}
}