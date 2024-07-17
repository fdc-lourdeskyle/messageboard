<html>

    <h1>All Users</h1> 
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach($users as $user):?>
            <tr>
                <td>
                    <?php echo $user['User']['name']; ?>
                </td>
                <td>
                    <?php echo $user['User']['email']; ?>
                </td>
                <td>
                    <?php echo $this->Html->link('Edit', array('action'=>'edit', $user['User']['id'])); ?>
                    <?php echo $this->Html->link('Delete', array('action'=>'delete', $user['User']['id']), NULL, 'Are you sure you want to delete user?'); ?>
                </td>
            </tr>
        <?php endforeach ?>       
    </table>
</html>