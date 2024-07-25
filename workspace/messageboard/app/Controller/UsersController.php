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
    var $layout = 'default';
    public $uses = array('User');

    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('thankyou');
    }

    public function index($id = null){
        $this->set('user', $this->User->read(NULL,$id));
    }

    public function isAuthorized($user) {
      
        if (in_array($this->action, array('view', 'edit', 'delete', 'change_email'))) {
          
            $userId = $this->request->params['pass'][0];
            if ($userId == $user['id']) {
                return true;
            } else {
                $this->Session->setFlash(__('You are not authorized to access that page.'), 'default', array('class'=>'flash-error'));
                $this->redirect(array('action' => 'index'));
                return false;
            }
        }
        return parent::isAuthorized($user);
    }

    public function login(){     
        if($this->request->is('post')){
        
            if($this->Auth->login()){
                $user = $this->Auth->user();
                $this->User->id = $user['id'];
                $this->User->saveField('last_login_time', date('Y-m-d H:i:s'));
                $this->redirect($this->Auth->redirect());
            }else{
                $this->Session->setFlash(__('Email or password is incorrect'), 'default', array('class'=>'flash-error'));
            }
        }
    }

    public function register(){
        if ($this->request->is('post')) {
       
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Registration Complete'), 'default', array('class'=>'flash-success'));
                $this->redirect(array('action' => 'thankyou'));
            } else {
                $errors = $this->User->validationErrors;

                $errorMessage = 'Registration failed. Please fix the following errors:<br>';
                foreach($errors as $field => $messages){
                    foreach($messages as $message){
                        $errorMessage .= $message . '<br>';
                    }
                }
                $this->Session->setFlash(__($errorMessage), 'default', array('class'=>'flash-error'));
            }
        }
    }

    public function logout(){
        $this->redirect($this->Auth->logout());
    }

    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user = $this->User->findById($id);
        $user['User']['age'] = $this->User->calculateAge($user['User']['birthdate']);
        $this->set('user', $user);
    }

    public function edit($id = null) {
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        }
    
        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;
            $file = $this->request->data['User']['photo'];
    
            if (!empty($file['name'])) {
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $allowedExtensions = array('jpg', 'gif', 'png');
    
                if (in_array($ext, $allowedExtensions)) {
                
                    $uploadPath = WWW_ROOT . 'img/uploads/';
                    if (!is_dir($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
    
               
                    if (move_uploaded_file($file['tmp_name'], $uploadPath . $file['name'])) {
                        $this->request->data['User']['photo'] = 'uploads/' . $file['name'];
                    } else {
                        $this->Session->setFlash(__('Failed to upload file. Please try again.'), 'default', array('class' => 'flash-error'));
                        return;
                    }
                } else {
                    $this->Session->setFlash(__('Invalid file type. Only jpg, gif, and png files are allowed.'), 'default', array('class' => 'flash-error'));
                    return;
                }
            } else {
          
                unset($this->request->data['User']['photo']);
            }
    
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('User has been updated'), 'default', array('class' => 'flash-success'));
                return $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__('Unable to update user'), 'default', array('class' => 'flash-error'));
            }
        }
    
        if (!$this->request->data) {
            $this->request->data = $user;
        }
        
        $this->set('user', $user);
    }

    function delete($id = NULL){
        $this->User->delete($id);
        $this->Session->setFlash(__('User has been deleted'), 'default', array('class'=>'flash-success'));
        $this->redirect(array('action'=>'index'));
    }

    function thankyou(){

    }

    public function change_email() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $this->Auth->user('id'); 

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your email has been updated'), 'default', array('class'=>'flash-success'));
                $this->redirect(array('action' => 'view', $this->User->id));
            } else {
                $this->Session->setFlash(__('Unable to update your email. Please try again.'), 'default', array('class'=>'flash-error'));
            }
        }
        $this->request->data = $this->User->findById($this->Auth->user('id'));
    }

    public function change_password() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->loadModel('User');
            $user = $this->User->findById($this->Auth->user('id'));
            
            if (!empty($user)) {
 
                if ($this->Auth->password($this->request->data['User']['old_password']) === $user['User']['password']) {
                    $this->User->set($this->request->data);


                    if ($this->User->validates()) {
                        $this->User->id = $user['User']['id'];
                        
                        if ($this->User->saveField('password', $this->request->data['User']['new_password'])) {
                            $this->Session->setFlash(__('Password Changed Successfully'), 'default', array('class'=>'flash-success'));
                            $this->redirect(array('action' => 'index'));
                        } else {
                            $this->Session->setFlash(__('Failed to change password'), 'default', array('class'=>'flash-error'));
                        }
                    } else {
                        $this->Session->setFlash('Validation error: ' . implode(', ', $this->User->validationErrors));
                    }
                } else {
                    $this->Session->setFlash(__('Old password is incorrect'), 'default', array('class'=>'flash-error'));
                }
            } else {
                $this->Session->setFlash(__('User not found'), 'default', array('class'=>'flash-error'));
            }
        }
    }
    
    public function search(){
        $this->autoRender = false;
        $term = $this->request->query('q');

        $users = $this->User->find('all', array(
            'conditions' => array(
                'OR' => array(
                    'User.name LIKE' => '%' . $term . '%',
                )
            ),
                'fields' => array('User.id','User.name'),
                'limit' => 10
        ));

        $results = array();
        foreach($users as $user){
            $results[] = array(
                'id' => $user['User']['id'],
                'text' => $user['User']['name']
            );
        }
        echo json_encode($results);
    } 

    
}
