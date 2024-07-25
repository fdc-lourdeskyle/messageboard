<?php echo $this->Form->create('User', array('type' => 'post', 'enctype' => 'multipart/form-data')); ?>
<div class="profile-container"> 
    <div class="users-header">
        <h1>Edit Profile</h1> 
    </div>
    <div class="profile-upper-content">
        <div class="profile-img">
            <?php 
                $userPhoto = isset($user['User']['photo']) ? $user['User']['photo'] : null;
                $userPhotoUrl = !empty($userPhoto) ? $this->Html->url('/img/'.$userPhoto) : null;
                $fileExtension = strtolower(pathinfo($userPhoto, PATHINFO_EXTENSION));
                $imageExtensions = array('jpg', 'jpeg', 'gif', 'png');
            ?>
            <?php if (in_array($fileExtension, $imageExtensions)): ?>
                <img id="photoPreview" src="<?php echo $userPhotoUrl; ?>" alt="User Photo" style="<?php echo $userPhotoUrl ? '' : 'display:none;'; ?>" />
            <?php else: ?>
                <p id="photoPreview" style="display: none;">Preview not available for this file type.</p>
            <?php endif; ?>
        </div>
        <div class="profile-details">
            <div class="edit-input-container" style="width:180px;">
                <label for="name" class="form__label">Name:</label>
                <?php echo $this->Form->input('name', array('label' => false, 'class' => 'edit-input')); ?>
            </div>
            <div class="edit-input-container" style="width:180px;">
                <?php
                $genderOptions = array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                );
                echo $this->Form->input('gender', array('type' => 'radio', 'label' => false, 'options' => $genderOptions));
                ?>
            </div>
            <div class="edit-input-container">
                <label for="birthdate" class="form__label" style="margin-bottom: 20px;">Birthdate (M-D-Y):</label>
                <?php echo $this->Form->input('birthdate', array('id' => 'birthdate', 'label' => false, 'type' => 'text', 'class' => 'form__input datepicker', 'div' => false)); ?>
            </div>
            <div class="edit-input-container">
                <label for="photo" class="custom-file-upload">Upload Profile Picture</label>
                <?php echo $this->Form->file('photo', array('label' => false, 'id' => 'photo', 'style' => 'display:none;')); ?>
            </div>
        </div>
    </div>
    <div class="profile-lower-content">
        <div class="edit-input-container">
            <label for="hobby" class="form__label" style="margin-bottom: 10px;">Hobby:</label>
            <?php echo $this->Form->input('hobby', array('label' => false, 'type' => 'textarea', 'class' => 'text-edit-input')); ?>
        </div>
    </div>
    <div class="form-actions" style="margin-top: 10px;">
        <?php echo $this->Form->button('Save Changes', array('class' => 'custom-button')); ?>
        <?php echo $this->Form->button('Cancel', array('type' => 'button', 'onclick' => "location.href='" . $this->Html->url(array('action' => 'view', $user['User']['id'])) . "'", 'class' => 'custom-button')); ?>
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
            var file = event.target.files[0];
            var allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
            var fileExtension = file.name.split('.').pop().toLowerCase();

            if (allowedExtensions.includes(fileExtension)) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById('photoPreview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                alert('Invalid file type. Only jpg, gif, and png files are allowed.');
                event.target.value = ''; 
                document.getElementById('photoPreview').style.display = 'none'; 
            }
        });
    });
</script>
