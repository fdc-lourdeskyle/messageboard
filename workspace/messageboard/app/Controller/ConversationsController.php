<?php

class ConversationsController extends AppController{

    public $uses = array('Conversation', 'Message');
    public $helpers = array('Html', 'Form', 'Url');
    public $components = array('Paginator');
    


    public function index(){
        $userId = $this->Auth->user('id');
        $conversations = $this->Conversation->find('all', array(
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
            )
        ));
            $this->set(compact('conversations'));
    }

    public function add(){
        if($this->request->is('post')){

            // debug($this->request->data);

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
            
            if($this->Conversation->save($conversationData)){

                $conversationId = $this->Conversation->id;

                $this->Message->create();
                $messageData = array(
                    'Message' => array(
                        'conversation_id' => $conversationId,
                        'sender_id' => $senderId,
                        'message' => $messageText
                    )
                );

                if($this->Message->save($messageData)){
                    $this->Session->setFlash('The message has been sent');
                    return $this->redirect(array('action'=>'index'));
                }else{
                    $this->Session->setFlash('Message cannot be sent');
                }
            }else{
                $this->Session->setFlash('Conversation cannot be created');
            }
         }
    }

    public function view($id = null){
        if(!$id){
            throw new NotFoundException(_('No conversation found'));
        }

        $conversations = $this->Conversation->find('first', array(
            'conditions' => array('Conversation.id' => $id),
            'contain' => array(
                'Message' => array(
                    'order' => array('Message.created_at ASC')
                ),
                'Sender',
                'Receiver'
            )
        ));

        if(!$conversations){
            throw new NotFoundException(_('No conversation found'));
        }

        $userId = $this->Auth->user('id');
        if($conversations['Conversation']['sender_id'] != $userId && $conversations['Conversation']['receiver_id'] != $userId){
            throw new ForbiddenException(_('You are not authorized to view this conversation'));
        }

        $this->paginate = array(
            'Message' => array(
                'conditions' => array('Message.conversation_id' => $id),
                'order' => array('Message.created_at ASC'),
                'limit' => 3
            )
        );

        $messages = $this->paginate('Message');

        $this->set(compact('conversations','messages'));
    
    }

    public function reply($conversationId){

        if($this->request->is('post')){
            $this->Message->create();

            $data = array(
                'conversation_id' => $conversationId,
                'sender_id' => $this->Auth->user('id'),
                'message' => $this->request->data['Message']['message']
            );

            if($this->Message->save($data)){
                $this->Session->setFlash('The message has been sent');
            }else{
                $  $this->Session->setFlash('The message has not been sent');
            }

            return $this->redirect(array('action' => 'view', $conversationId));
        }
        throw new MethodNotAllowedException();
    }

    public function loadMore($conversationId) {
        if ($this->request->is('ajax')) {
            $page = $this->request->query('page') ?: 1;
            $limit = $this->request->query('limit') ?: 3;

            $this->Paginator->settings = array(
                'Message' => array(
                    'conditions' => array('Message.conversation_id' => $conversationId),
                    'order' => array('Message.created_at ASC'),
                    'limit' => $limit,
                    'page' => $page,
                    'contain' => array('Sender')
                )
            );

            try {
                $messages = $this->Paginator->paginate('Message');
                if (empty($messages)) {
                    echo ''; 
                    return;
                }
                $this->set('messages', $messages);
                $this->layout = 'ajax'; 
                $this->render('load_more'); 

            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        } else {
            throw new MethodNotAllowedException();
        }
    }
    
    
    
}