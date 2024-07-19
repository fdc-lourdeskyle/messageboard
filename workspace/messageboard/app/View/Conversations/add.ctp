<div class="msg-container">
        <div class="msg-header">
                <div>
                    <h4>New Message</h4>
                    <?php echo $this->Form->create('Conversation', array('url' => array('action' => 'add'))); ?>
                </div>
                <div>
                    <?php echo $this->Form->input('receiver_id', array('id'=>'receiver_id', 'label'=>'Send Message To', 'type' => 'select', 'class' => "form-input")); ?>
                </div>
        </div>
        <div class="msg-table">
            <div class="msg">
                <?php echo $this->Form->input('Message.message', array('label'=>'Message', 'type' => 'textarea', 'class' => "form-input")); ?>
            </div>
            <div>
                <?php echo $this->Form->submit('Submit', array('class'=>"form-button")); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#receiver_id').select2({
            placeholder: 'Select a receiver',
            minimumInputLength: 1,
            ajax: {
                url: '<?php echo $this->Html->url(array("controller" => "users", "action" => "search")); ?>',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term 
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateResult: function (data) {
                return data.text;
            },
            templateSelection: function (data) {
                $('#receiver_id').val(data.id);
                return data.text;
            }
            })
        });
</script>

</script>