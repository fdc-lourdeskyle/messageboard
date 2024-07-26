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
        <div style="margin-bottom:10px;">
            <?php echo $this->Form->button('Back', array('type' => 'button', 'onclick' => "window.history.back();", 'class' => 'form-button')); ?>
            <?php echo $this->Html->link('New Message', array('controller' => 'conversations', 'action' => 'add'), array('class' => 'new-message-button')); ?>
        </div>
    </div>
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
    </div>
    <?php if (count($conversations) >= 10): ?>
        <button id="load-more" data-page="<?php echo $this->request->params['paging']['Conversation']['page'] + 1; ?>">Show More</button>
        <?php endif; ?>
</div>

<script>
    $(document).ready(function(){

        $('#load-more').on('click', function(){
            var button = $(this);
            var page = button.data('page');

            var url = '<?php echo $this->Html->url(array('action' => 'index')); ?>';

                $.ajax({
                    url: url,
                    data: { page: page },
                    type: 'GET',
                    dataType: 'html',
                    success: function(response) {
                    console.log('Response:', response);

            
                    var $response = $('<div>').html(response);
                    var $conversationList = $response.find('#conversation-list');
                    var newContent = $conversationList.html();
                    console.log('New content:', newContent);

                    if (newContent) {
                        $('#conversation-list').append(newContent);

                        var loadMoreButton = $response.find('#load-more');
                        if (loadMoreButton.length > 0) {
                            $('#load-more').replaceWith(loadMoreButton);
                        } else {
                            $('#load-more').remove();
                        }
                            handleTextOverflow();
                    } else {
                            $('#load-more').remove();
                        }
                        },
                            error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                            }
                        });

        });
        
        $(document).on('click', '.delete-conversation', function(e) {

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

        function isTextOverflowing(element) {
                return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
            }

 
            function handleTextOverflow() {
                $('.message-text').each(function() {
                    console.log($(this).height(), $(this).prop('scrollHeight'));
                    var $msgText = $(this);
                    var $showMore = $msgText.siblings('.show-more-msg');
                    var $showLess = $showMore.siblings('.show-less');
                    
                    if (isTextOverflowing(this)) {
                        $showMore.show();
                    } else {
                        $showMore.hide();
                    }

        
                    $showMore.off('click').on('click', function(e) {
                        e.preventDefault();
                        $msgText.addClass('expanded');
                        $showMore.hide();
                        $showLess.show();
                    });

        
                    $showLess.off('click').on('click', function(e) {
                        e.preventDefault();
                        $msgText.removeClass('expanded');
                        $showLess.hide();
                        $showMore.show();
                    });
                });
            }
    
            handleTextOverflow();

            $(document).on('click', '.show-more-msg', function(e) {

                e.preventDefault();
                var $msgText = $(this).siblings('.message-text');
                var $showMore = $(this);
                var $showLess = $showMore.siblings('.show-less');
                
                $msgText.addClass('expanded');
                $showMore.hide();
                $showLess.show();
            });

            $(document).on('click', '.show-less', function(e) {
                e.preventDefault();
                var $msgText = $(this).siblings('.message-text');
                var $showLess = $(this);
                var $showMore = $showLess.siblings('.show-more-msg');
                
                $msgText.removeClass('expanded');
                $showLess.hide();
                $showMore.show();
            });
    });


</script>