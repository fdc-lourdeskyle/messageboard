<?php

class Message extends AppModel {

    public $belongsTo = array(
        'Conversation' => array(
            'className' => 'Conversation',
            'foreignKey' => 'conversation_id'
        ),
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id'
        )
        );

    var $name= 'Message';


    var $validate = array(
        'message' => array(
            'message_must_not_be_empty' => array(
                'rule' => 'notBlank',
                'message' => 'Message cannot be empty'
            ),
        ),
    );

}