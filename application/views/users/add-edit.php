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
        <div class="panel panel-default">
            <div class="panel-heading"><?php echo $action; ?> User <a href="<?php echo site_url('users/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
            <div class="panel-body">
                <form method="post" action="" class="form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php echo !empty($user['username'])?$user['username']:''; ?>">
                        <?php echo form_error('username','<p class="help-block text-danger">','</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php echo !empty($user['email'])?$user['email']:''; ?>">
                        <?php echo form_error('email','<p class="help-block text-danger">','</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password" >
                        <?php echo form_error('password','<p class="help-block text-danger">','</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="password2">Password</label>
                        <input type="password" class="form-control" name="password2" placeholder="Enter Password Confirmation" >
                        <?php echo form_error('password2','<p class="help-block text-danger">','</p>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="job">Job Title</label>
                        <input type="text" class="form-control" name="job" placeholder="Enter Job title" value="<?php echo !empty($user['job'])?$user['job']:''; ?>">
                        <?php echo form_error('job','<p class="help-block text-danger">','</p>'); ?>
                    </div>

                    <input type="submit" name="userSubmit" class="btn btn-primary" value="Submit"/>
                </form>
            </div>
        </div>
    </div>
</div>