<?php

App::uses('CakeLog', 'Log');

class ConversationsController extends AppController{

    public $uses = array('Conversation', 'Message');
    public $helpers = array('Html', 'Form', 'Url');
    public $components = array('Paginator','RequestHandler');
    
    public function beforeFilter() {
        parent::beforeFilter();
        if ($this->request->is('ajax')) {
            $this->response->type('json');
            $this->viewClass = 'Json';
        }
    }
    


    public function index() {
        $userId = $this->Auth->user('id');
    
        $this->paginate = array(
            'conditions' => array(
                'OR' => array(
                    'Conversation.sender_id' => $userId,
                    'Conversation.receiver_id' => $userId
                )
            ),
            'order' => array('Conversation.created_at DESC'),
            'contain' => array(
                'Message' => array(
                    'order' => array('Message.created_at DESC')
                )
            ),
            'limit' => 10, 
            'page' => $this->request->query('page')
        );
    
        $conversations = $this->paginate('Conversation');

        if ($this->request->is('ajax')) {
            $this->layout = 'ajax'; 
            $this->set('conversations', $conversations);
            $this->render('/Elements/conversations'); 
        } else {
          
            $this->set(compact('conversations','userId'));
        }
    }
    

    public function add() {
        if ($this->request->is('post')) {
            $this->Conversation->create();
    
            $senderId = $this->Auth->user('id');
            $receiverId = $this->request->data['Conversation']['receiver_id'];
            $messageText = $this->request->data['Message']['message'];
    
            $conversationData = array(
                'Conversation' => array(
                    'sender_id' => $senderId,
                    'receiver_id' => $receiverId
                )
            );
    
            if ($this->Conversation->save($conversationData)) {
                $conversationId = $this->Conversation->id;
    
                $this->Message->create();
                $messageData = array(
                    'Message' => array(
                        'conversation_id' => $conversationId,
                        'sender_id' => $senderId,
                        'message' => $messageText
                    )
                );
    
                if ($this->Message->save($messageData)) {
                    if ($this->request->is('ajax')) {
                        $response = array('status' => 'success', 'message' => 'The Conversation has been sent');
                        $this->set(array(
                            'response' => $response,
                            '_serialize' => array('response')
                        ));
                    } else {
                        $this->Session->setFlash(__('The Conversation has been sent'), 'default', array('class' => 'flash-success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    if ($this->request->is('ajax')) {
                        $response = array('status' => 'error', 'message' => 'The Conversation cannot be sent');
                        $this->set(array(
                            'response' => $response,
                            '_serialize' => array('response')
                        ));
                    } else {
                        $this->Session->setFlash(__('The Conversation cannot be sent'), 'default', array('class' => 'flash-error'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            } else {
                if ($this->request->is('ajax')) {
                    $response = array('status' => 'error', 'message' => 'Conversation cannot be created');
                    $this->set(array(
                        'response' => $response,
                        '_serialize' => array('response')
                    ));
                } else {
                    $this->Session->setFlash(__('Conversation cannot be created'), 'default', array('class' => 'flash-error'));
                }
            }
        }
    }
    
    

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(_('No conversation found'));
        }
    
        $conversation = $this->Conversation->find('first', array(
            'conditions' => array('Conversation.id' => $id),
            'contain' => array(
                'Message' => array(
                    'order' => array('Message.created_at ASC')
                ),
                'Sender',
                'Receiver'
            )
        ));
    
        if (!$conversation) {
            throw new NotFoundException(_('No conversation found'));
        }
    
        $userId = $this->Auth->user('id');
        if ($conversation['Conversation']['sender_id'] != $userId && $conversation['Conversation']['receiver_id'] != $userId) {
            throw new ForbiddenException(_('You are not authorized to view this conversation'));
        }
    
       
        $page = $this->request->is('ajax') ? $this->request->query('page') : 1;
    
        $this->paginate = array(
            'Message' => array(
                'conditions' => array('Message.conversation_id' => $id),
                'order' => array('Message.created_at ASC'),
                'limit' => 10, 
                'page' => $page
            )
        );
    
        $messages = $this->paginate('Message');
        $totalMessages = $this->Message->find('count', array('conditions' => array('Message.conversation_id' => $id)));
        $hasMoreMessages = $totalMessages > $this->paginate['Message']['limit'] * ($this->request->query('page') ? $this->request->query('page') : 1);
    
        if ($this->request->is('ajax')) {
            $this->set(compact('messages', 'hasMoreMessages'));
            $this->render('/Conversations/messages');
            $this->response->type('html');
        } else {
            $this->set(compact('conversation', 'messages', 'id', 'hasMoreMessages'));
        }

    }

    public function reply($conversationId) {
        if ($this->request->is('post')) {
            $this->Message->create();
    
            $data = array(
                'conversation_id' => $conversationId,
                'sender_id' => $this->Auth->user('id'),
                'message' => $this->request->data['Message']['message']
            );
    
            if ($this->Message->save($data)) {
                if ($this->request->is('ajax')) {
                    $response = array('status' => 'success', 'message' => 'The message has been sent');
                    $this->set(array(
                        'response' => $response,
                        '_serialize' => array('response')
                    ));
                    return;
                } else {
                    $this->Session->setFlash(__('The message has been sent'), 'default', array('class' => 'flash-success'));
                    return $this->redirect(array('action' => 'index'));
                }
            } else {
                if ($this->request->is('ajax')) {
                    $response = array('status' => 'error', 'message' => 'The message has not been sent');
                    $this->set(array(
                        'response' => $response,
                        '_serialize' => array('response')
                    ));
                    return;
                } else {
                    $this->Session->setFlash(__('The message has not been sent'), 'default', array('class' => 'flash-error'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }
        throw new MethodNotAllowedException();
    }

    public function delete($id=null){
        $this->autoRender=false;
        $this->Conversation->id = $id;

        if(!$this->Conversation->exists()){
            throw new NotFoundException(_('Invalid Conversation'));
        }

        if($this->Conversation->delete()){
            $this->Session->setFlash(__('Conversation deleted'), 'default', array('class'=>'flash-success'));
            $response = array('status' =>'success', 'message' => 'Conversation deleted');
        }else{
            $this->Session->setFlash(__('Conversation cannot be deleted'), 'default', array('class'=>'flash-error'));
            $response = array('status' =>'error', 'message' => 'Conversation can not be deleted');
        }

        echo json_encode($response);
    }

    public function deleteMsg($id=null){
        $this->autoRender=false;
        $this->Message->id = $id;

        if(!$this->Message->exists()){
            throw new NotFoundException(__('Invalid Message'));
        }

        $message = $this->Message->findById($id);
        $conversationId = $message['Message']['conversation_id'];

        if($this->Message->delete()){
            $remainingMessages = $this->Message->find('count', array(
                'conditions' => array('Message.conversation_id' => $conversationId)
            ));

            if($remainingMessages == 0){
                $this->Conversation->delete($conversationId);
            }
            $this->Session->setFlash(__('Message deleted'), 'default', array('class'=>'flash-success'));
            $response = array('status' =>'success', 'message' => 'Message deleted');
        }else{
            $this->Session->setFlash(__('Message cannot be deleted'), 'default', array('class'=>'flash-error'));
            $response = array('status' =>'error', 'message' => 'Message cannot be deleted');
        }

        echo json_encode($response);
    }
    

}