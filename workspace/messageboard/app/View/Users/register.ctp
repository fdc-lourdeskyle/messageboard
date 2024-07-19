
    <div id="con">
        <div class="registration-container">
        <h1 class="title-text">Register</h1>
            <?php 
                    echo $this->Form->create('User', array('type' => 'add', 'id'=>'registrationForm'));
            ?>
            <div class="form-group">
                <?php echo $this->Form->input('name', array('id'=>'UserName', 'label'=>'Name', 'class' => "form-input")); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('email', array('id'=>'UserEmail', 'label'=>'Email', 'class' => "form-input")); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password', array('id'=>'UserPassword', 'label'=>'Password', 'class' => "form-input")); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password_confirmation', array('id'=>'UserPasswordConfirmation', 'label'=>'Confirm Password' , 'class' => "form-input", "type"=>"password")); ?>
            </div>
            <div>
                <?php echo $this->Form->submit('Submit', array('class'=>"form-button")); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>





<script>
    $(document).ready(function(){

        $('#registrationForm').submit(function(event){

            var isValid = true;
            var errorMessages = [];

            var name = $('#UserName').val().trim();
            if(name === ''){
                isValid = false;
                errorMessages.push('Please enter your name');
            }

            var email = $('#UserEmail').val().trim();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if(email === ''){
                isValid = false;
                errorMessages.push('Please enter your email');
            }else if (!emailPattern.test(email)){
                isValid = false;
                errorMessages.push('Please enter a valid email address');
            }

            var password = $('#UserPassword').val().trim();
            if(password === ''){
                isValid = false;
                errorMessages.push('Please enter a password');
            }

            var passwordConfirmation = $('#UserPasswordConfirmation').val().trim();
            if(passwordConfirmation === ''){
                isValid = false;
                errorMessages.push('Please confirm your password');
            }else if(password !== passwordConfirmation){
                isValid = false;
                errorMessages.push('Passwords do not match');
            }

            if(!isValid){
                event.preventDefault();
                alert(errorMessages.join('\n'));
            }

        });
    });
</script>