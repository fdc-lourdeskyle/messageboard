

    <div class="profile-container"> 
        <div class="users-header">
            <h1>User Profile</h1> 
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
                        <p class="prof-details-name"><?php echo $user['User']['name']; ?> , <?php echo $user['User']['age']; ?></p>
                        <p class="prof-details"> Gender: <?php echo $user['User']['gender']; ?></p>
                        <p class="prof-details"> Birthdate: <?php echo $user['User']['birthdate']; ?></p>
                        <p class="prof-details"> Joined: <?php echo $this->Time->format('F j, Y - gA', $user['User']['created_at']); ?></p>
                        <p class="prof-details"> Last Login: <?php echo $this->Time->format('F j, Y - gA', $user['User']['last_login_time']); ?></p>
                </div>
        </div>
        <div class="profile-lower-content">
            <p class="prof-details">Hobby:</p>
            <p class="prof-details-desc"><?php echo $user['User']['hobby']; ?></p>
        </div>

        <?php if($id === $currentUserId): ?>
        <div class="users-header">
                <h1>Account Settings</h1> 
        </div>
        <div class="user-action-container">

            <div class="user-action-button">
            <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit', $currentUserId)); ?>">
            <i class="fa-solid fa-user" style="color: #ee964b; font-size: 12px; margin-right: 10px;"></i> Update
            </a>
            </div>
            <div class="user-action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_password', $currentUserId)); ?>">
                <i class="fa-solid fa-lock" style="color: #ee964b; font-size: 12px; margin-right: 10px;"></i> Change Password </a>
            </div>
            <div class="user-action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'change_email', $currentUserId)); ?>">
                <i class="fa-solid fa-envelope" style="color: #ee964b; font-size: 12px; margin-right: 10px;"></i> Change Email </a>
            </div>
            <div class="user-action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index', $currentUserId)); ?>">
                Back </a>
            </div>
        </div>
        <?php else: ?>
        <div class="users-header">
                <h1>Account Settings</h1> 
        </div>
        <div class="user-action-container">
            <div class="user-action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'conversations', 'action' => 'index')); ?>">
                Back </a>
            </div>
        </div>
        <?php endif; ?>

    </div>
