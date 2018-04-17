
<!-- /#page-wrapper -->
<?php if(!empty($success_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
<?php }elseif(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
<?php } ?>
<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-default ">
            <div class="panel-heading">Users <a href="<?php echo site_url('users/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="30%">Usersname</th>
                    <th width="30%">Email</th>
                    <th width="20%">Job</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody id="userData">
                <?php if(!empty($users)): foreach($users as $user): ?>
                    <tr>
                        <td><?php echo '#'.$user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['job']; ?></td>
                        <td>
                            <a href="<?php echo site_url('users/view/'.$user['id']); ?>" class="glyphicon glyphicon-eye-open"></a>
                            <a href="<?php echo site_url('users/edit/'.$user['id']); ?>" class="glyphicon glyphicon-edit"></a>
                            <a href="<?php echo site_url('users/delete/'.$user['id']); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="4">User(s) not found...</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>