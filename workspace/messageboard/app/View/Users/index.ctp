<div id="user-con">
    <div class="action-container">
        <div class="action-button">
            <a href=""><?php echo $this->Html->link('My Profile', array('action'=>'view', $currentUserId)); ?></a>
        </div>
        <div class="action-button">
            <a href="" class=""><?php echo $this->Html->link('Messages', array('controller'=>'conversations','action'=>'index', $currentUserId)); ?></a>
        </div>
    </div>
</div>