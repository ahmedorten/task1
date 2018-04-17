

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
        <div class="panel panel-default">
            <div class="panel-heading">User Details <a href="<?php echo site_url('users/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Username:</label>
                    <p><?php echo !empty($user['username'])?$user['username']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <p><?php echo !empty($user['email'])?$user['email']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Job:</label>
                    <p><?php echo !empty($user['job'])?$user['job']:''; ?></p>
                </div>
            </div>
        </div>
    </div>