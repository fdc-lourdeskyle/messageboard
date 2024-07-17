<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class UsersController extends AppController {

    var $name= 'Users';

    function index(){
        $this->set('users', $this->User->find('all'));
    }

    // function view($id = NULL){
    //     $this->set('user', $this->User->read(NULL,$id));
        
    // }
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user = $this->User->findById($id);
        $this->set('user', $user);
    }

    // public function edit($id = null){
    //     if(empty($this->data)){
    //         $this->data = $this->User->read(NULL, $id);
    //     }else{
    //         if($this->User->save($this->data)){
    //             $this->Session->setFlash('User has been Updated!');
    //             $this->redirect(array('action'=>'view',$id));
    //         }
    //     }
    // }

    public function edit($id = null){
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }
    
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        }
    
        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
    
            // Handle file upload
            if (!empty($this->request->data['User']['photo']['name'])) {
                $file = $this->request->data['User']['photo'];
                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //allowed extensions
    
                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/' . $file['name']);
    
                    //prepare the filename for database entry
                    $this->request->data['User']['photo'] = 'uploads/' . $file['name'];
                }
            } else {
                // Don't update the photo if it's not changed
                unset($this->request->data['User']['photo']);
            }
    
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('User has been updated.'));
                return $this->redirect(array('action' => 'view', $id));
            }
            $this->Session->setFlash(__('Unable to update user.'));
        }
    
        if (!$this->request->data) {
            $this->request->data = $user;
        }
        $this->set('user',$user);
    }

    function delete($id = NULL){
        $this->User->delete($id);
        $this->Session->setFlash('User has been deleted');
        $this->redirect(array('action'=>'index'));
    }
    
}
