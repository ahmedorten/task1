
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">News Details <a href="<?php echo site_url('news/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>Title:</label>
                    <p><?php echo !empty($news['title'])?$news['title']:''; ?></p>
                </div>
                <div class="form-group">
                    <label>Content:</label>
                    <p><?php echo !empty($news['content'])?$news['content']:''; ?></p>
                </div>
            </div>
        </div>
    </div>