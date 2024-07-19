<div class="convo-container">
    <div class="convo-header">
        <div class="msg-header">
            <h4>Your Messages</h4>
        </div>
        <div>
            <?php echo $this->Html->link('New Message', array('controller' => 'conversations', 'action' => 'add'),array('class' => 'new-message-button')); ?>
        </div>
    </div>
    <div class="convo-list" id="messages-container">
        <?php if (!empty($conversations)): ?>
            <?php foreach ($conversations as $conversation): ?>
                <div class="convo">
                    <div class="convo-content">
                        <div class="msg-img">
                            <?php
                            $senderPhoto = !empty($conversation['Sender']['photo']) ? $this->Html->url('/img/' . $conversation['Sender']['photo']) : null;
                            ?>
                            <img id="photoPreview" src="<?php echo $senderPhoto; ?>" alt="Sender photo" style="<?php echo $senderPhoto ? '' : 'display:none;'; ?> max-width: 100px; max-height: 100px;" />
                        </div>
                        <div class="msg-content">
                            <?php if (!empty($conversation['Message'])): ?>
                                <?php
                                $latestMessage = end($conversation['Message']);
                                ?>
                                <div class="msg">
                                    <?php echo h($latestMessage['message']); ?>
                                </div>
                                <div class="timestamp">
                                    <?php echo h($latestMessage['created_at']); ?>
                                </div>
                            <?php else: ?>
                                <div class="msg">
                                    No messages yet.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="msg-action-btns">
                                        <?php echo $this->Html->link('Open Message', array('action'=>'view', $conversation['Conversation']['id'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No conversations found.</p>
        <?php endif; ?>
    </div>
</div>

