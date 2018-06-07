<?php

namespace newsoftsnc\accessofixeduser\models;

class Log extends CActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public function tableName() {
		return 'log';
	}

	public function behaviors() {
		return array(
			'italianDate'=>array(
				'class'=>'yiicommon.extensions.italianDateBehavior',
			),
		);
	}
	
	public function attributeLabels() {
		return array(
			'id' => 'Log',
			'id_cliente' => 'Cliente',
			'data' => 'Data',
			'ora' => 'Ora',
			'accesso' => 'Accesso',
		);
	}
}