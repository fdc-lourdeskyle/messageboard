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
                    <?php echo $this->Html->link('Edit', array('action'=>'edit', $user['User']['id'])); ?>
                    <?php echo $this->Html->link('Delete', array('action'=>'delete', $user['User']['id'])); ?>
                </td>
            </tr>    
    </table>
</html>