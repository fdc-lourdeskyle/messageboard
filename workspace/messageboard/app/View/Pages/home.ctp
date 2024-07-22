<div id="con">
    <div class="action-container">
        <div class="action-button">
        <a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'view', $currentUserId)); ?>">
        <i class="fa-solid fa-user" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> My Profile
        </a>
        </div>
        <div class="action-button">
            <a href="<?php echo $this->Html->url(array('controller' => 'conversations', 'action' => 'index', $currentUserId)); ?>">
            <i class="fa-solid fa-message" style="color: #ee964b; font-size: 15px; margin-right: 10px;"></i> Messages </a>
        </div>
    </div>
</div>