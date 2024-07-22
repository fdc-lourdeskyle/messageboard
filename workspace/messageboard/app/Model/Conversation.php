<?php
Class Conversation extends AppModel{

    public $belongsTo = array(
        'Sender' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id'
        ),
        'Receiver' => array(
            'className' => 'User',
            'foreignKey' => 'receiver_id'
        ),
    );

    public $hasMany = array(
        'Message' => array(
            'className' => 'Message',
            'foreignKey' => 'conversation_id',
            'dependent' => true
        )
    );


    var $name= 'Conversation';

    var $validate = array(
        'receiver_id' => array(
            'receiver_must_not_be_empty' => array(
                'rule' => 'notBlank',
                'message' => 'Please select message recepient'
            ),
        ),
    );


}