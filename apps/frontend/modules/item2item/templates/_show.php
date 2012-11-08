<?php if ( (!empty($news_list) && count($news_list)) || 
            (!empty($photoalbum_list) && count($photoalbum_list)) || 
            (!empty($video_list) && count($video_list)) ||
            (!empty($audio_list) && count($audio_list)) ||
            (!empty($documents_list) && count($documents_list))): ?>
<br/>
<hr class="light" />
<?php endif ?>
<?php if (!empty($news_list) && count($news_list)): ?>
    <h3><?php echo __('Associated News'); ?>:</h3>
    <?php foreach($news_list as $news_index=>$news_item): ?>
       <a href="<?php echo $news_item->getUrl(); ?>"><?php echo $news_item->getTitle(); ?></a><br/><br/>
    <?php endforeach ?>				
<?php endif ?>

<?php if (!empty($photoalbum_list) && count($photoalbum_list)): ?>	
    <h3><?php echo __('Associated Photo'); ?>:</h3>
    <div class="related">
    <?php foreach($photoalbum_list as $photoalbum_index=>$photoalbum_item): ?>
        <div>
            <?php include_partial('photoalbum/show', array('photoalbum'=>$photoalbum_item) ); ?>
        </div>
    <?php endforeach ?>				
    </div>
<?php endif ?>                   

<?php if (!empty($video_list) && count($video_list)): ?>	
    <h3><?php echo __('Associated Video'); ?>:</h3>
    <div class="related">
        <?php include_partial( 'video/list', array('video_list' => $video_list)); ?>
    </div>
    <?php /* <div class="related video_list">
    <?php foreach($video_list as $video_index=>$video_item): ?>
        <div>
            <?php include_partial('video/show', array('video'=>$video_item, 'short'=>true) ); ?>
        </div>
    <?php endforeach ?>				
    </div>
    */ ?>
<?php endif ?>

<?php if (!empty($audio_list) && count($audio_list)): ?>
    <h3><?php echo __('Associated Audio'); ?>:</h3>
    <div>
    <?php foreach($audio_list as $audio_item): ?>
        <div>
            <?php include_partial('audio/showShort', array('audio'=>$audio_item) ); ?>
            <hr class="dashed audio_divider"/>
        </div>
    <?php endforeach ?>				
    </div>
<?php endif ?>

<?php if (!empty($documents_list) && count($documents_list)): ?>
    <h3><?php echo __('Associated Documents'); ?>:</h3>
    <div>
        <?php include_partial('documents/list', array('documents_list'=>$documents_list)); ?>			
    </div>
<?php endif ?>