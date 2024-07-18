<html>

    <h1>All Users</h1> 
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
            <tr>
                <td>
                    <?php echo $user['User']['name']; ?>
                </td>
                <td>
                    <?php echo $user['User']['email']; ?>
                </td>
                <td>
                    <?php echo $this->Html->link('Update Personal Information', array('action'=>'edit', $user['User']['id'])); ?>
                    <?php echo $this->Html->link('Change Email', array('action'=>'change_email', $user['User']['id'])); ?>
                    <?php echo $this->Html->link('Change Password', array('action'=>'change_password', $user['User']['id'])); ?>
                </td>
            </tr>    
    </table>
</html>