<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class User extends Model {

    var $name = 'User';

    var $validate = array(
        'name' => array(
            'name_must_not_be_blank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter your name'
            ),
        ),
        'email' => array(
            'valid_email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address'
            ),
            'email_already_taken' =>array(
                'rule' => 'isUnique',
                'message' => 'Email Address already exists'
            ),
            'email_must_not_be_blank' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter email address'
            ),
        ),
        'password' => array(
            'password_must_not_be_blank' => array(
                'rule' => 'notBlank',
                'message' => 'Password cannot be empty'
            ),
            'match_password' => array(
                'rule' => 'matchPasswords',
                'message' => "Passwords do not match"
            )
        ),
        'password_confirmation' => array(
            'password_must_not_be_blank' => array(
                'rule' => 'notBlank',
                'message' => 'Please confirm password'
            ),
        ),   
        'birthdate' => array(

        ),
        'gender' => array(

        ),
        'hobby' => array(

        ),
        'last_time_login' => array(

        ),
    );

    public function matchPasswords($data){
        if ($data['password'] == $this->data['User']['password_confirmation']){
            return true;
        }
        $this->invalidate('password_confirmation', 'Passwords do not match');
        return false;
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        if(empty($this->data[$this->alias]['id'])){
            $this->data[$this->alias]['created_at']=date('Y-m-d H:i:s');
        }

        if(empty($this->data[$this->alias]['photo'])){
            $this->data[$this->alias]['photo'] = 'uploads/default.jpg';
        }
            return true;
    }

        public function calculateAge($birthdate){
            $birthdate = new DateTime ($birthdate);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthdate)->y;
            return $age;
    }

}
