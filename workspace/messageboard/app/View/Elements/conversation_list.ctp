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
                <div class="msg-action-btns">
                    <?php echo $this->Html->link('Open Conversation', array('action' => 'view', $conversation['Conversation']['id'])); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No conversations found.</p>
<?php endif; ?>

<input type="hidden" id="has-more-conversations" value="<?php echo $hasMoreConversations ? 'true' : 'false'; ?>" />
