
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
                <div class="panel-heading">News <a href="<?php echo site_url('news/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="30%">Title</th>
                        <th width="50%">Content</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($news)): foreach($news as $new): ?>
                        <tr>
                            <td><?php echo '#'.$new['id']; ?></td>
                            <td><?php echo $new['title']; ?></td>
                            <td><?php echo (strlen($new['content'])>150)?substr($new['content'],0,150).'...':$new['content']; ?></td>
                            <td>
                                <a href="<?php echo site_url('news/view/'.$new['id']); ?>" class="glyphicon glyphicon-eye-open"></a>
                                <a href="<?php echo site_url('news/edit/'.$new['id']); ?>" class="glyphicon glyphicon-edit"></a>
                                <a href="<?php echo site_url('news/delete/'.$new['id']); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">News not found......</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>