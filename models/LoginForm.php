<?php

namespace newsoftsnc\accessonscnfacc\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model {
    public $clientname;
    public $username;
    public $password;
    public $database;
    public $tableprefix;
    
    public $rememberMe = true;
    
    public $setdatabase = false;
    
    private $_user = false;
    
    
    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['clientname', 'username', 'password'], 'required'],
            [['database', 'tableprefix', 'setdatabase'], 'safe'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    
    public function attributeLabels() {
        return array(
            'id'=>'Id',
            'clientname'=>'Codice Cliente',
            'username'=>'Codice Utente',
            'password'=>'Password',
            'rememberMe'=>'Ricordami',
            'database'=>'Database',
        );
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Utente o password non validi.');
            }
        }
    }
    
    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            
            $d = date("d-m-Y");
            $o = date("H:i");
            
            // Check Singolo Database Abilitato
            if (empty($this->database)) {
                $databases = Enable::elencoDatabase(Yii::$app->getModule('gestacc')->getApplic(), $this->clientname, $this->username);
            
                if (count($databases) == 1) {
                    reset($databases);
                    $this->database = key($databases);
                }
            }
             
            if (!empty($this->database)) {
                // Check eventuale LOG
                $this->logUser();
                
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            }
            $this->setdatabase = true;
            return false;
            
        } else {
            $this->setdatabase = false;
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
//        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->clientname, $this->username, $this->database);
//        }
        return $this->_user;
    }
 
    /**
     * Log dell'accesso dell'utente
     *
     * @return null
     */
    public function logUser() {
        if (Yii::$app->getModule('gestacc')->getLog()) {
            $d = date("d-m-Y");
            $o = date("H:i");
            $a = date("Y-m-d")." ".date("H:i");
            
            
            
        }
        return null;
    }
    
}
