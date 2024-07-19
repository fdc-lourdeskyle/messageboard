<?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <div class="convo">
                    <div class="convo-content">
                        <div class="msg-mg">
                            <?php 
                                $userPhoto = $message['Sender']['photo'];
                                $userPhotoUrl = !empty($userPhoto)? $this->Html->url('/img/'.$userPhoto) : null;
                            ?>
                            <img id="photoPreview" src="<?php echo $userPhotoUrl; ?>" alt="Sender photo" style="<?php echo $userPhotoUrl ? '' : 'display:none;'; ?> max-width: 100px; max-height: 100px;" />
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
            <p> No messages found </p>
        <?php endif; ?>