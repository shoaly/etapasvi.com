var quote_list = new Array(
<?php 
foreach($quote_list as $i=>$quote): 
    echo '"' . addslashes(html_entity_decode($quote->getTitle())) . '"';
    if ($i != count($quote_list) - 1) {
        echo ', ';
    }
endforeach
?>
);
var carousel_photo_list = new Array(
<?php 
foreach($carousel_photo_list as $i=>$carousel_photo): 
    echo '[';
    echo '"' . $carousel_photo->getFullUrl( array('max_width'=>PhotoPeer::CAROUSEL_PHOTO_WIDTH, 'min_height'=>PhotoPeer::CAROUSEL_PHOTO_HEIGHT) ) . '",';
    if ($carousel_photo->getWidth() > $carousel_photo->getHeight()) {
        echo '"h"';
    } else {
        echo '"v"';
    }
    echo ']';
    if ($i != count($carousel_photo_list) - 1) {
        echo ', ';
    }
endforeach
?>
);
<?php /*
var audio_list = new Array(
<?php 
foreach($audio_list as $i=>$audio): 
    echo '"' . addslashes(html_entity_decode($audio->getRemote())) . '"';
    if ($i != count($audio_list) - 1) {
        echo ', ';
    }
endforeach 
?>
);
var audio_title_list = new Array(
<?php 
foreach($audio_list as $i=>$audio): 
    echo '"' . addslashes(html_entity_decode($audio->getAuthor() . ' - ' . $audio->getTitle())) . '"';
    if ($i != count($audio_list) - 1) {
        echo ', ';
    }
endforeach 
?>
);
*/ ?>
var footer_text = "<?php echo str_replace('"', '\"', str_replace("\n", "", get_partial('global/footer_text'))); ?>";