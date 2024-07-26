<div class="convo-list" id="conversation-list">
        <?php if (!empty($conversations)): ?>
            <?php foreach ($conversations as $conversation): ?>
                <div class="convo" id="conversation-<?php echo $conversation['Conversation']['id']; ?>">
                    <div class="convo-content">
                        <div class="msg-img">
                            <?php
                            $senderPhoto = !empty($conversation['Sender']['photo']) ? $this->Html->url('/img/' . $conversation['Sender']['photo']) : null;
                            ?>
                            <img src="<?php echo $senderPhoto; ?>" alt="Sender photo" style="<?php echo $senderPhoto ? '' : 'display:none;'; ?> max-width: 100px; max-height: 100px;" />
                        </div>
                        <div class="msg-content">
                            <?php if (!empty($conversation['Message'])): ?>
                                <?php
                                $latestMessage = end($conversation['Message']);
                                ?>
                                    <div class="msg">
                                        <p class="message-text"><?php echo h($latestMessage['message']); ?></p>
                                        <span class="show-more-msg">Show More</span>
                                        <span class="show-less" style="display:none;">Show Less</span>
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
                        <?php echo $this->Html->link('Open', array('action' => 'view', $conversation['Conversation']['id'])); ?>
                        <?php echo $this->Html->link('Delete', array('action' => 'delete', $conversation['Conversation']['id']), array('class' => 'delete-conversation', 'data-id' => $conversation['Conversation']['id'], 'escape' => false, 'onclick' => 'return false;')); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No conversations found.</p>
        <?php endif; ?>

        <?php if (count($conversations) >= 10): ?>
     <button id="load-more" data-page="<?php echo $this->request->params['paging']['Conversation']['page'] + 1; ?>">Load More</button>
    <?php endif; ?>
</div>

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
    $(document).ready(function() {
    });
    });
</script>