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
                'rule' => 'notEmpty',
                'message' => 'Name cannot be empty'
            ),
        ),
        'email' => array(
                'name_must_not_be_blank' => array(
                'rule' => 'isUnique',
                'message' => 'Email Address already exists'
            ),
        ),
        'password' => array(
            'password_must_not_be_blank' => array(
                'rule' => 'notEmpty',
                'message' => 'Password cannot be empty'
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

}
