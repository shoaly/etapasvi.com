<?php if ( !empty($video_list) ): ?>
    <?php foreach ($video_list as $video_index=>$video): ?>
        <?php include_partial('video/teaser', array('video'=>$video) ); ?>
        <?php if ($video_index != count($video_list) - 1): ?>
            <br/>
        <?php endif ?>
    <?php endforeach; ?>
<?php endif; ?>