<style>
    .message-text{
        max-height: 100px;
        width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        transition: max-height 0.3s ease;
    }

    .message-text.expanded{
        max-height: none;
        white-space: normal;
        overflow: visible;
    }

    .show-more-msg, .show-less{
        display: inline-block;
        margin-top: 10px;
        color: #007bff;
        text-decoration: none;
        cursor: pointer;
    }

    .show-less {
        display: none;
    }
</style>
<div id="message-list">
    <?php if (!empty($messages)): ?>
        <?php foreach ($messages as $message): ?>
            <div class="convo" id="message-<?php echo $message['Message']['id']; ?>">
                <div class="convo-content">
                    <div class="msg-mg">
                        <?php 
                            $userPhoto = $message['Sender']['photo'];
                            $userPhotoUrl = !empty($userPhoto)? $this->Html->url('/img/'.$userPhoto) : null;
                            $profileUrl = $this->Html->url(array('controller' => 'users', 'action' => 'view', $message['Sender']['id']));
                        ?>
                        <a href="<?php echo $profileUrl; ?>"><img id="photoPreview" src="<?php echo $userPhotoUrl; ?>" alt="Sender photo" style="<?php echo $userPhotoUrl ? '' : 'display:none;'; ?> max-width: 50px; max-height: 50px;" /> </a>
                    </div>
                    <div class="msg-content">
                        <div class="msg">
                                <p class="message-text"><?php echo h($message['Message']['message']); ?></p>
                            
                            <span class="show-more-msg">Show More</span>
                            <span class="show-less" style="display:none;">Show Less</span>
                        </div>
                        <div class="timestamp">
                            <?php echo h($message['Message']['created_at']); ?>
                        </div>
                    </div>
                </div>
                <div class="msg-action-btns">
                        <?php echo $this->Html->link('Delete Message', array('action'=>'deleteMsg', $message['Message']['id']), array('class'=>'delete-message','data-id'=>$message['Message']['id'], 'escape'=>false, 'onclick'=>'return false;')); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No messages found</p>
    <?php endif; ?>
</div>

<?php if ($hasMoreMessages): ?>
    <input type="hidden" id="has-more-messages" value="true" />
<?php else: ?>
    <input type="hidden" id="has-more-messages" value="false" />
<?php endif; ?>

<script>
$(document).ready(function() {
    function isTextOverflowing(element) {
        return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
    }

        $('.message-text').each(function() {
            var $msgText = $(this);
            var $showMore = $msgText.siblings('.show-more-msg');
            var $showLess = $showMore.siblings('.show-less');
            
            if (isTextOverflowing(this)) {
                $showMore.show();
            } else {
                $showMore.hide();
            }

            $showMore.on('click', function(e) {
                e.preventDefault();
                $msgText.addClass('expanded');
                $showMore.hide();
                $showLess.show();
            });

            $showLess.on('click', function(e) {
                e.preventDefault();
                $msgText.removeClass('expanded');
                $showLess.hide();
                $showMore.show();
            });
        });
});
</script>
