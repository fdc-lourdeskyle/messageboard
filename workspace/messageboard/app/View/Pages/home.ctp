<div id="con">
    <div class="action-container">
        <!-- <div class="action-button">
        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $currentUserId)); ?>">
        <i class="fa-solid fa-user" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> My Profile
        </a>
        </div>
        <div class="action-button">
            <a href="<?php echo $this->Html->url(array('controller' => 'conversations', 'action' => 'index', $currentUserId)); ?>">
            <i class="fa-solid fa-message" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> Messages </a>
        </div> -->
        <?php if ($this->Session->read('Auth.User')): ?>
				 <div class="action-button">
                <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $currentUserId)); ?>">
                <i class="fa-solid fa-user" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> My Profile
                </a>
                </div>
                <div class="action-button">
                    <a href="<?php echo $this->Html->url(array('controller' => 'conversations', 'action' => 'index', $currentUserId)); ?>">
                    <i class="fa-solid fa-message" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> Messages </a>
                </div>
			    <?php else: ?>
                <div class="action-button">
                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'login')); ?>">
                    <i class="fa-solid fa-user" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> LOGIN </a>
                </div>
                <div class="action-button">
                    <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'register')); ?>">
                    <i class="fa-solid fa-user" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> REGISTER </a>
                </div>
			<?php endif; ?>
    </div>
</div>
