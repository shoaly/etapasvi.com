<script type="text/javascript">
    // исходный текст учения
    function showOriginal()
    {
        var el = document.getElementById("elOriginal");
        if ( el.style.display == "block" ) {
            el.style.display = "none";
        } else {
            el.style.display = "block";
        }
    }
</script>

<?php /*include_component('news', 'showwrapper', array('id'=>$id, 'title'=>$title));*/ ?>
<?php include_partial('news/showwrapper', array('newsitem'=>$newsitem)); ?>
<?php /*include_partial('comments/tools', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_NEWS), 'id'=>$id));*/  ?>
<?php include_component('comments', 'show', array('for'=>strtolower(ItemtypesPeer::ITEM_TYPE_NAME_NEWS), 'id'=>$id, 'culture'=>$sf_user->getCulture())) ?>

<?php include_partial('global/go_to_top'); ?>