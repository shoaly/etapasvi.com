<?php if ($newsitem && $newsitem->getBody() != ''): ?>

    <?php if ($latest): ?>
        <div class="t_latest"><?php echo $newsitem->getTitle(); ?></div>
    <?php endif ?>

    <?php if ($latest):?><div class="i_latest"><?php endif ?>

	<?php $href = $newsitem->getUrl(); ?>
    <h2 class="title">
        <a href="<?php echo $href; ?>" title="<?php echo __('News') ?>" class="t_txt">
            <?php echo $newsitem->getTitle(); ?>
        </a>
    </h2>

    <div class="date">
        <?php if ($newsitem->getExtradate()): ?><?php echo $newsitem->getExtradate(); ?> / <?php elseif ($newsitem->getDate()): ?><?php echo format_datetime( $newsitem->getDate(), 'd MMMM yyyy'); ?> / <?php endif ?>
        <span class="track_updated" data-track_updated_date="<?php echo strtotime($newsitem->getUpdatedAtMax()); ?>" data-track_updated_item="<?php echo ItemtypesPeer::ITEM_TYPE_NEWS; ?>" data-track_updated_id="<?php echo $newsitem->getId() ?>"><?php echo __('Updated on') ?> <?php echo format_datetime( $newsitem->getUpdatedAtMax(), 'd MMMM yyyy'); ?></span>
    </div>
    <?php include_component('itemcategory', 'showitemcategories', array(
                            'item_type'     => ItemtypesPeer::ITEM_TYPE_NEWS,
                            'item_id'       => $newsitem->getId(),
                            'module_action' => 'news/index'));
    ?>
    <div class="short_body p">
        <?php if ($newsitem->getImg() && $newsitem->getThumbUrl()): ?>
            <a href="<?php echo $href; ?>" title="<?php echo $newsitem->getTitle(); ?>">
                <img src="<?php echo $newsitem->getThumbUrl(); ?>"
            alt="<?php echo $newsitem->getTitle(); ?>" class="newsitem_img"/></a>
        <?php endif ?>

        <?php
            $shortbody_prepared = html_entity_decode($newsitem->geShortbodyPrepared());
            echo $shortbody_prepared;
            if (strlen($shortbody_prepared) > 200) {
                echo '...';
            }
        ?>
        <div class="spacer">&nbsp;</div>
        <p class="toolbar">
            <a href="<?php echo $href; ?>" title="<?php echo __('Read more') ?>" class="read_more">
                <i class="read_more_icon"></i>&nbsp;<?php echo __('Read more') ?>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <i class="comments_icon"></i>&nbsp;<?php echo __('Comments') ?>:
            <a href="<?php echo $href; ?>#disqus_thread" data-disqus-identifier="<?php echo $newsitem->getCommentsIdentifier(); ?>">0<?php //echo $newsitem->getCommentsCount(); ?></a>
        </p>
    </div>

    <?php if ($latest):?></div><?php endif ?>

    <?php if (!get_slot('track_updated_news')): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                track_updated();
            });
        </script>
    <?php endif ?>
    <?php slot('track_updated_news'); ?>1<?php end_slot() ?>
<?php endif ?>