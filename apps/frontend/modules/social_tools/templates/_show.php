<?php /*
    <a href="http://www.etapasvi.com/forum/index.php?lang=<?php echo $sf_user->getCulture(); ?>" target="_blank"><img src="/i/social/forum_64.png" title="<?php echo __('Forum') ?>" alt="<?php echo __('Forum') ?>"/></a>*/?>

    <?php /*
      <a href="<?php echo url_for('@livestream', true); ?>" target="_blank" title="<?php echo __('LiveStream') ?>" class="social_livestream"><span><?php echo __('LiveStream') ?></span></a>
*/ ?>
    <?php /*
        <a href="http://etapasvi.blogspot.com/" target="_blank"><img src="/i/social/blogger_64.png" title="<?php echo __('Blogger') ?>" alt="<?php echo __('Blogger') ?>"/></a>
    <? */ ?>
    <?php /* <a href="<?php echo url_for('@chat', true); ?>" target="_blank" title="<?php echo __('Chat') ?>" class="social_zoho"><span><?php echo __('Chat') ?></span></a> */ ?>
    <?php /*<a href="http://kiwi6.com/users/show/etapasvi" target="_blank" title="<?php echo __('Kiwi6') ?>" class="social_kiwi6"><span><?php echo __('Kiwi6') ?></span></a>*/ ?>

    <?php if ($sf_user->getCulture() == 'ru'): ?>
         <?php /* <a href="http://vaikuntha.ru/blog/dharmas/" target="_blank" title="<?php echo __('Вайкунтха') ?>" class="social_vaikuntha"><span><?php echo __('Вайкунтха') ?></span></a> */ ?>
         <a href="http://vk.com/etapasvi" target="_blank" title="<?php echo __('Страница ВКонтакте') ?>" class="social_vkontakte" rel="nofollow"><span><?php echo __('Страница ВКонтакте') ?></span></a>
         <a href="http://vk.com/maha.sambodi.darma.sanga" target="_blank" title="<?php echo __('Группа ВКонтакте') ?>" class="social_vkontakte" rel="nofollow"><span><?php echo __('Группа ВКонтакте') ?></span></a>
        <a href="http://my.mail.ru/community/etapasvi/" target="_blank" title="<?php echo __('Мой Мир@Mail.Ru') ?>" class="social_moimir" rel="nofollow"><span><?php echo __('Мой Мир@Mail.Ru') ?></span></a>

         <br/>
    <?php /* <?php else: ?>
        <a href="http://etapasvi.livejournal.com/" target="_blank" title="<?php echo __('Live Journal') ?>" class="social_livejournal"><span><?php echo __('Live Journal') ?></span></a> */ ?>
    <?php endif ?>

    <a href="http://www.facebook.com/<?php echo UserPeer::getCultureFbGroup(); ?>/" target="_blank" title="<?php echo __('Facebook') ?>" class="social_facebook" rel="nofollow"><span><?php echo __('Facebook') ?></span></a>
    <?php if ($sf_user->getCulture() != 'ru'): ?>
        <a href="http://www.facebook.com/groups/maha.sambodhi.dharma.sangha/" target="_blank" title="<?php echo __('Facebook') ?>" class="social_facebook" rel="nofollow"><span><?php echo __('Facebook') ?></span></a>
    <?php endif ?>
    <?php if ($sf_user->getCulture() != 'ru'): ?><br/><?php endif ?>
    <a href="http://twitter.com/<?php echo UserPeer::getCultureTwitter(); ?>" target="_blank" title="<?php echo __('Twitter') ?>" class="social_twitter" rel="nofollow"><span><?php echo __('Twitter') ?></span></a>
    <?php if ($sf_user->getCulture() == 'ja'): ?>
        <a href="http://groups.google.com/group/dharmasangha-jp" target="_blank" title="<?php echo __('Google') ?>" class="social_google" rel="nofollow"><span><?php echo __('Google') ?></span></a>
    <?php elseif ($sf_user->getCulture() != 'ru'): ?>
        <a href="https://groups.google.com/forum/?fromgroups=#!forum/maha-sambodhi-dharma-sangha-" target="_blank" title="<?php echo __('Google') ?>" class="social_google" rel="nofollow"><span><?php echo __('Google') ?></span></a>
    <? endif ?>
    <?php if ($sf_user->getCulture() != 'ru'): ?>
        <a href="http://whos.amung.us/stats/ppc9yoe3440f/" target="_blank" title="<?php echo __('Visitor Map') ?>" class="social_visitor_map" rel="nofollow"><span><?php echo __('Visitor Map') ?></span></a>
    <? endif ?>
    <a href="http://www.youtube.com/user/etapasvi" target="_blank" title="<?php echo __('YouTube') ?>" class="social_youtube" rel="nofollow"><span><?php echo __('YouTube') ?></span></a>

    <?php if ($sf_user->getCulture() == 'ru'): ?>
        <br/>
        <a href="http://odnoklassniki.ru/group/52853546877166" target="_blank" title="<?php echo __('Одноклассники') ?>" class="social_odnoklassniki" rel="nofollow"><span><?php echo __('Одноклассники') ?></span></a>
    <? else: ?>
        <?php /* <a href="https://picasaweb.google.com/105320929368395530858" target="_blank" title="<?php echo __('Picasa') ?>" class="social_picasa" rel="nofollow"><span><?php echo __('Picasa') ?></span></a> */ ?>
    <? endif ?>
    <?php if ($sf_user->getCulture() != 'ru'): ?><br/><?php endif ?>
    <a href="https://github.com/etapasvi/etapasvi.com" target="_blank" title="<?php echo __('GitHub') ?>" class="social_github" rel="nofollow"><span><?php echo __('GitHub') ?></span></a>

    <a href="http://feeds.feedburner.com/<?php echo $sf_user->getCulture(); ?>/etapasvi" target="_blank" title="<?php echo __('RSS') ?>" class="social_rss" rel="nofollow"><span><?php echo __('RSS') ?></span></a>