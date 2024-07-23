<div id="con">
        <div class="login-container">
            <h1 class="title-text" style="margin-left: 70px;">LOGIN</h1>
            <div style="width:250px;">
                <?php 
                    echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
                ?>
                <div class="form-group">
                    <?php echo $this->Form->input('email', array('id'=>'UserEmail', 'label'=>'Email', 'class' => "form-input")); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('password', array('id'=>'UserPassword', 'label'=>'Password', 'class' => "form-input")); ?>
                </div>
                <div>
                    <?php echo $this->Form->button('Login', array('type' => 'submit', 'class' => 'login-form-button')); ?>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
           
        </div>
</div>