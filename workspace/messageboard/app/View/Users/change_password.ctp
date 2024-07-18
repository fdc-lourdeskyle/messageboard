<div id="con">
        <div class="login-container">
        <h1 class="title-text">Change Password</h1>
            <?php 
                    echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'change_password')));
            ?>
            <div class="form-group">
                <?php echo $this->Form->input('old_password', array('type'=>'password','id'=>'UserOldPassword', 'label'=>'Old Password', 'class' => "form-input")); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('new_password', array('type'=>'password','id'=>'UserNewPassword', 'label'=>'New Password', 'class' => "form-input")); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password_confirmation', array('type'=>'password','id'=>'UserPasswordConfirmation', 'label'=>'Confirm Password' , 'class' => "form-input")); ?>
            </div>
            <div>
                <?php echo $this->Form->submit('Change Password', array('class'=>"form-button")); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>