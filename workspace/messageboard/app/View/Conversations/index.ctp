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
<div class="convo-container">
    <div class="convo-header">
        <!-- <div class="msg-header">
            <h4>Your Messages</h4>
        </div> -->
        <div style="margin-bottom:10px;">
             <?php echo $this->Form->button('Back', array('type' => 'button', 'onclick' => "location.href='" . $this->Html->url(array('controller' => 'users', 'action' => 'index')) . "'", 'class' => 'form-button')); ?>
            <?php echo $this->Html->link('New Message', array('controller' => 'conversations', 'action' => 'add'),array('class' => 'new-message-button')); ?>
        </div>
    </div>
    <div class="convo-list" id="messages-container">
        <?php if (!empty($conversations)): ?>
            <?php foreach ($conversations as $conversation): ?>
                <div class="convo" id="conversation-<?php echo $conversation['Conversation']['id']; ?>">
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
                        <?php echo $this->Html->link('Open', array('action'=>'view', $conversation['Conversation']['id'])); ?>
                        <?php echo $this->Html->link('Delete ', array('action'=>'delete', $conversation['Conversation']['id']), array('class'=>'delete-conversation','data-id'=>$conversation['Conversation']['id'], 'escape'=>false, 'onclick'=>'return false;')); ?>
                    </div> 
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No conversations found.</p>
        <?php endif; ?>
    </div>
    <?php if ($totalConversations >= 10): ?> 
        <div class="paging">
            <?php
                echo $this->Paginator->next(('Show More'), array(), null, array('class' => 'disabled'));
            ?>
        </div>
    <?php else: ?>
        <div class="paging">
            <?php
                echo $this->Paginator->next(('Show More'), array(), null, array('class' => 'hidden'));
            ?>
        </div>
    <?php endif; ?>
</div>


<script>
        $(document).ready(function(){
            $('.delete-conversation').click(function(e){

                e.preventDefault();
                var $this = $(this);
                var conversationId = $this.data('id');
                var conversationElement = $('#conversation-' + conversationId);
                console.log(conversationElement);

                $.ajax({
                    url:'/conversations/delete/' + conversationId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 'success'){
                            conversationElement.fadeOut(500, function(){
                                $(this).remove();
                            });
                        }else{
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error){
                        console.log('Error:', error);
                        console.log('Status', status);
                        console.dir(xhr);
                        alert('Error deleting conversation');
                    }
                });
            });
            
        });

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

        $(document).ready(function(){
            $('#show-more-conversations').on('click', function(e){
                e.preventDefault();
                var button = $(this);
                var page = button.data('page');

                $.ajax({
                    url: '/conversations/index',
                    data: {page: page},
                    dataType: 'html',
                    success: function(response){
                        var newConversations = $(response).find('.convo-list').html();
                        $('#messages-container').append($(response).find('.convo-list').html());

                        var hasMoreConversations = $(response).find('#has-more-conversations').val() === 'true';
                        if(!hasMoreConversations){
                            button.hide();
                        }else{
                            button.data('page', page + 1);
                        }
                    },
                    error: function(){
                        alert('An error occured while loading more conversations.');
                    }
                });
            });
        });
</script>