<?php

class MessagesController extends AppController{

    public $uses = array('Conversation', 'Message');

    public function index(){

    }

    public function add(){
        if(!empty($this->data)){
            if($this->Message->save($this->data)){
                $this->Session->setFlash('Message has been sent');
                $this->redirect(array('action'=>'index'));
            }else{
                $this->Session->setFlash('The message cannot be sent.');
            }
        }
    }



}