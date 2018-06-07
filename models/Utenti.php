<?php 

namespace newsoftsnc\accessonscnfacc\models;

use yii\db\ActiveRecord;

class Utenti extends ActiveRecord {

    public static function tableName() {
        return 'utenti';
	}

	public function getClienti() {
	    return $this->hasOne(Clienti::className(), ['CLCOD' => 'CLIENTICLCOD']);
	}
	
	public function getEnable() {
	    return $this->hasMany(Enable::className(), ['CLIENTICLCOD'=>'CLIENTICLCOD', 'UTCOD'=>'UTENTUTCOD']);
	}
}