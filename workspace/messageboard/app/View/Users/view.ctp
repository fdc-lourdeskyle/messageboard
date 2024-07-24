

    <div class="profile-container"> 
        <div class="users-header">
            <h1>My Profile</h1> 
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
                        <p class="prof-details-name"><?php echo $user['User']['name']; ?></p>
                        <p class="prof-details"> Gender: <?php echo $user['User']['gender']; ?></p>
                        <p class="prof-details"> Birthdate: <?php echo $user['User']['birthdate']; ?></p>
                        <p class="prof-details"> Joined: <?php echo $user['User']['last_time_login']; ?></p>
                        <p class="prof-details"> Last Login: <?php echo $user['User']['last_time_login']; ?></p>
                </div>
        </div>
        <div class="profile-lower-content">
            <p class="prof-details">Hobby:</p>
            <p class="prof-details-desc"><?php echo $user['User']['hobby']; ?></p>
        </div>

        <div class="users-header">
                <h1>Account Settings</h1> 
        </div>
        <div class="user-action-container">

            <div class="user-action-button">
            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $currentUserId)); ?>">
            <i class="fa-solid fa-user" style="color: #ee964b; font-size: 8px; margin-right: 10px;"></i> Update
            </a>
            </div>
            <div class="user-action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_password', $currentUserId)); ?>">
                <i class="fa-solid fa-message" style="color: #ee964b; font-size: 8px; margin-right: 10px;"></i> Change Password </a>
            </div>
            <div class="user-action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_email', $currentUserId)); ?>">
                <i class="fa-solid fa-message" style="color: #ee964b; font-size: 8px; margin-right: 10px;"></i> Change Email </a>
            </div>
        </div>

    </div>
