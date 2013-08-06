<?php slot('body_id') ?>body_search<?php end_slot() ?>
<?php slot('page_header') ?><?php echo __('Search') ?><?php end_slot() ?>

<script>
  (function() {
    var cx = '006414956786193237693:ixwluctz1yu';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>