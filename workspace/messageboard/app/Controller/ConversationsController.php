<?php

class ConversationsController extends AppController{

    public $uses = array('Conversation', 'Message');
    public $helpers = array('Html', 'Form', 'Url');
    public $components = array('Paginator');
    


    public function index() {
        $userId = $this->Auth->user('id');
        
        // Get page number from request, default to 1
        $page = $this->request->query('page');
        if (!$page) {
            $page = 1;
        }
    
        // Set up pagination settings
        $this->paginate = array(
            'Conversation' => array(
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
                'limit' => 10, // Number of conversations per page
                'page' => $page
            )
        );
    
        $conversations = $this->paginate('Conversation');
        $totalConversations = $this->Conversation->find('count', array(
            'conditions' => array(
                'OR' => array(
                    'Conversation.sender_id' => $userId,
                    'Conversation.receiver_id' => $userId
                )
            )
        ));
        $hasMoreConversations = $totalConversations > $this->paginate['Conversation']['limit'] * $page;
    
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax'; // Use ajax layout to avoid full page rendering
            $this->set('conversations', $conversations);
            $this->set('hasMoreConversations', $hasMoreConversations);
            $this->render('/Elements/conversations_list'); // Render the partial view for AJAX
        } else {
            $this->set(compact('conversations', 'hasMoreConversations'));
        }
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
    
        // Handle AJAX request for additional messages
        $page = $this->request->is('ajax') ? $this->request->query('page') : 1;
    
        $this->paginate = array(
            'Message' => array(
                'conditions' => array('Message.conversation_id' => $id),
                'order' => array('Message.created_at ASC'),
                'limit' => 10, // Show 10 messages per page
                'page' => $page
            )
        );
    
        $messages = $this->paginate('Message');
        $hasMoreMessages = count($messages) >= 10; // Check if there are more messages to load
    
        if ($this->request->is('ajax')) {
            $this->set(compact('messages', 'hasMoreMessages'));
            $this->render('messages'); // Render only the messages part of the view
        } else {
            $this->set(compact('conversation', 'messages', 'id', 'hasMoreMessages'));
        }
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

    // public function loadMore($conversationId) {
    //     if ($this->request->is('ajax')) {
    //         $page = $this->request->query('page') ?: 1;
    //         $limit = $this->request->query('limit') ?: 3;

    //         $this->Paginator->settings = array(
    //             'Message' => array(
    //                 'conditions' => array('Message.conversation_id' => $conversationId),
    //                 'order' => array('Message.created_at ASC'),
    //                 'limit' => $limit,
    //                 'page' => $page,
    //                 'contain' => array('Sender')
    //             )
    //         );

    //         try {
    //             $messages = $this->Paginator->paginate('Message');
    //             if (empty($messages)) {
    //                 echo ''; 
    //                 return;
    //             }
    //             $this->set('messages', $messages);
    //             $this->layout = 'ajax'; 
    //             $this->render('load_more'); 

    //         } catch (Exception $e) {
    //             echo 'Error: ' . $e->getMessage();
    //         }
    //     } else {
    //         throw new MethodNotAllowedException();
    //     }
    // }
    
}