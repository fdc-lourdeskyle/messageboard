<h1>Update Information</h1>

    <?php 
        echo $this->Form->create('User', array('url' => array('action' => 'change_email')));
        echo $this->Form->input('User.email', array('type'=>'email'));
        echo $this->Form->end('Update Email');
    ?>