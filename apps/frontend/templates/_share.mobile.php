<?php $uri = sfContext::getInstance()->getRequest()->getUri(); ?>
<div id="share">
<div class="share_item">
    <a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="etapasvi" >Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> 
</div>
<?php if ($sf_user->getCulture() == 'ru'): ?>    

    <div class="share_item">
        <script type="text/javascript" src="http://vkontakte.ru/js/api/share.js?10" charset="windows-1251"></script>
        <script type="text/javascript">document.write(VK.Share.button(false,{type: "round", text: "ВК"}));</script>   
    </div>
    <?php // В кнопке мобильной версии возникает ошибка  ?>
    <?php /*if ($sf_context->getModuleName() == 'photo' && $sf_context->getActionName() == 'show'): ?>        
    <?php else: ?>    
        <div class="share_item">
            <?php /* <link href="http://stg.odnoklassniki.ru/share/odkl_share.css" rel="stylesheet">/ ?>
            <script src="http://stg.odnoklassniki.ru/share/odkl_share.js" type="text/javascript" ></script>         
            <a class="odkl-klass-stat" href="<?php echo $uri; ?>" onclick="ODKL.Share(this);return false;" ><span></span></a>        
            <?php /* <script type="text/javascript">ODKL.init();</script> / ?>
        </div>
    <?php endif*/ ?>
    <div class="share_item">
        <a target="_blank" class="mrc__plugin_like_button" href="http://connect.mail.ru/share" rel="{'type' : 'button', 'width' : '108'}">Нравится</a>
    <script src="http://cdn.connect.mail.ru/js/loader.js" type="text/javascript" charset="UTF-8"></script>
    </div>
<?php else: ?>
    <div class="share_item">     
        <script src="http://www.stumbleupon.com/hostedbadge.php?s=1" type="text/javascript"></script>
    </div>  
    <div class="share_item">
        <script type="text/javascript">
        (function() {
        var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://widgets.digg.com/buttons.js';
        s1.parentNode.insertBefore(s, s1);
        })();
        </script>
        <a class="DiggThisButton DiggCompact"></a>
    </div>
    <div class="share_item">    
        <a title="Post on Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo $uri; ?>"></a><script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
    </div>
<?php endif ?>
<div class="share_item">        
    <a rel="nofollow" name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php">Facebook</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>   
</div>
</div>