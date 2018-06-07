<?php

namespace newsoftsnc\accessonscnfacc\models;

use yii\db\ActiveRecord;

class Enable extends ActiveRecord {

    public static function tableName() {
        return 'enable';
	}

	public function getInsta() {
	    return $this->hasOne(Insta::className(), ['CLIENTICLCOD'=>'CLIENTICLCOD','APPLICAPCOD'=>'APPLICAPCOD','INDBN'=>'INSTAINDBN']);
	}

	public function getUtenti() {
	    return $this->hasOne(Utenti::className(), ['CLIENTICLCOD'=>'CLIENTICLCOD','UTCOD'=>'UTENTUTCOD']);
	}
	
	public function elencoDatabase($applicativo, $cliente, $utente) {
		$abilitazioni = Enable::find()->where([
		    'UTENTUTCOD'=>$utente,
		    'CLIENTICLCOD'=>$cliente,
		    'APPLICAPCOD'=>$applicativo
		    ])->all();
		
		
		$databases = array();
		foreach ($abilitazioni as $abilitazione) {
			$databases[$abilitazione->INSTAINDBN] = $abilitazione->INSTAINDBN;
		}
		
		return $databases;
	}
}