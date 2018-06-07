<?php

namespace newsoftsnc\accessonscnfacc;

use yii\base\Module;

class Gestacc extends Module {

    public $applic = "";
    
	public function init() {
		parent::init();
	
		// Import
//		$this->setImport(array(
//			'gestacc.models.*',
//			'gestacc.components.*',
//		));
	}
	
	public function beforeControllerAction($controller, $action) {
		if(parent::beforeControllerAction($controller, $action)) {
			return true;
		} else {
			return false;
		}
	}
	
	//
	// Menù Manutenzione
	//
	public function getMenuManutenzione() 	{
		$itemsMenuManutenzione = array();
	
		return $itemsMenuManutenzione;
	}
	
	//
	// Menù Manutenzione
	//
	public function getApplic() 	{
	    return $this->applic;
	}
	
}
