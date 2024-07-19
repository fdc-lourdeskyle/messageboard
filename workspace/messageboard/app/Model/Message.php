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

}