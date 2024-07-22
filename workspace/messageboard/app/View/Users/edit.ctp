<?php echo $this->Form->create('User', array('type' => 'post', 'enctype' => 'multipart/form-data')); ?>
    <div class="profile-container"> 
        <div class="users-header">
            <h1>Edit Profile</h1> 
        </div>
        <div class="profile-upper-content">
            <div class="profile-img">
                <?php 
                    $userPhoto = $user['User']['photo'];
                    $userPhotoUrl = !empty($userPhoto)? $this->Html->url('/img/'.$userPhoto) : null;
                ?>
                <img id="photoPreview" src="<?php echo $userPhotoUrl; ?>" alt="User Photo" style="<?php echo $userPhotoUrl ? '' : 'display:none;'; ?>" />
            </div>
            <div class="profile-details">
                <div class="edit-input-container">
                    <label for="name" class="form__label">Name</label>
                    <?php echo $this->Form->input('name', array('label' => false, 'class' => 'edit-input')); ?>
                </div>

                <div class="edit-input-container">
                    <?php
                    $genderOptions = array(
                        'Male' => 'Male',
                        'Female' => 'Female',
                    );
                    echo $this->Form->input('gender', array('type' => 'radio','label' => false,'options' => $genderOptions,));
                ?>
                </div>
                <div class="edit-input-container">
                    <label for="name" class="form__label">Birthdate</label>
                    <?php  echo $this->Form->input('birthdate', array('id' => 'birthdate', 'label' => false, 'type' => 'text','class' => 'form__input datepicker', 'div' => false)); ?>
                </div>
                <div class="edit-input-container">
                    <label for="name" class="form__label">Upload Profile Picture</label>
                    <div class="file-upload-button">
                        <?php echo $this->Form->file('photo', array('label' => 'Upload New Photo', 'id' => 'photo')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-lower-content">

            <div class="edit-input-container">
                    <label for="hobby" class="form__label">Hobby</label>
                    <?php echo $this->Form->input('hobby', array('label' => false, 'type' => 'textarea', 'class' => 'edit-input')); ?>
            </div>

        </div>
        <div class="form-actions">
            <?php echo $this->Form->button('Save Changes'); ?>
            <?php echo $this->Html->link('Cancel', array('action' => 'view', $user['User']['id']), array('class' => 'button')); ?>
        </div>
    </div>
<?php echo $this->Form->end(); ?>


<script type="text/javascript">
        $(document).ready(function(){
            $('#birthdate').datepicker({
                dateFormat: 'yy-mm-dd',
                showOn: "button",
                buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });

            $('#photo').on('change', function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var img = document.getElementById('photoPreview');
                    img.src = reader.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        });
        </script>
