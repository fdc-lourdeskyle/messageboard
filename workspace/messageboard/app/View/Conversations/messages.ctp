<div id="messages-list">
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $message): ?>
            <div class="convo" id="message-<?php echo $message['Message']['id']; ?>">
                <div class="convo-content">
                    <div class="msg-img">
                        <?php
                        $userPhoto = !empty($message['Sender']['photo']) ? $this->Html->url('/img/' . $message['Sender']['photo']) : null;
                        ?>
                        <img id="photoPreview" src="<?php echo $userPhoto; ?>" alt="Sender photo" style="<?php echo $userPhoto ? '' : 'display:none;'; ?> max-width: 100px; max-height: 100px;" />
                    </div>
                    <div class="msg-content">
                        <div class="msg">
                            <?php echo h($message['Message']['message']); ?>
                        </div>
                        <div class="timestamp">
                            <?php echo h($message['Message']['created_at']); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages found.</p>
    <?php endif; ?>
</div>
<input type="hidden" id="has-more-messages" value="<?php echo $hasMoreMessages ? 'true' : 'false'; ?>" />
