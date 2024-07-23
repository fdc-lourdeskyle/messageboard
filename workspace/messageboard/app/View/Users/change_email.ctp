
<div id="con">
        <div class="login-container">
            <h1 class="title-text">Change Email</h1>
            <?php 
                   echo $this->Form->create('User', array('url' => array('action' => 'change_email')));
            ?>
            <div class="form-group">
                <?php echo $this->Form->input('User.email', array('type'=>'email','class' => "form-input")); ?>
            </div>
            <div>
                <?php echo $this->Form->submit('Change Email', array('class'=>"form-button")); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
</div>