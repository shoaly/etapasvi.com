<?php if ($element['object']): ?>
    <?php $title       = $element['object']->getTitle($sf_user->getCulture(), true); ?>

    <?php if ($element['object']->getLat() && $element['object']->getLng()): ?>
        <script type="text/javascript">
            $(document).ready(function() {
                location_markers[<?php echo $element['object']->getId(); ?>] = {
                    lat: <?php echo $element['object']->getLat(); ?>,
                    lng: <?php echo $element['object']->getLng(); ?>,
                    title: '<?php echo $title; ?>',
                    location_id: '<?php echo $element['object']->getId(); ?>'
                };
            });
        </script>
    <?php endif ?>

    <?php if ($first): ?>
    <table class="documents_tbl location_tbl">
        <tr>
            <th><div><?php echo __('Location'); ?></div></th>
            <th><div><?php echo __('Contact Details'); ?></div></th>
        </tr>
    <?php endif ?>
    <tr>
        <td width="200" class="wrap">
            <?php if ($element['level']>1): ?><div style="margin-left: <?php echo ($element['level']-2)*10 ?>px">└<?php endif ?>
                <strong id="location_<?php echo $element['object']->getId(); ?>">
                    <?php if ($element['object']->getLat() && $element['object']->getLng()): ?>
                        <a href="javascript: locationMapFocus(<?php echo $element['object']->getId(); ?>, <?php echo $element['level']; ?>, '<?php echo $title; ?>'); void(0);"><?php echo $title; ?></a>
                    <?php else: ?>
                        <?php echo $title; ?>
                    <?php endif ?>
                </strong>
            <?php if ($element['level']>1): ?></div><?php endif ?>
        </td>
        <td class="wrap">
            <?php foreach ($element['links'] as $locationlink): ?>
                <a href="<?php echo $locationlink->getLink(); ?>" class="external nowrap"><?php if($locationlink->getTitle()): ?><?php echo $locationlink->getTitle(); ?><?php else: ?><?php echo $locationlink->getLinkPrepared(); ?><?php endif ?></a>&nbsp;&nbsp;
            <?php endforeach ?>
        </td>
    </tr>
    <?php if ($last): ?>
    </table>
    <?php endif ?>
    <?php foreach($element['children'] as $children): ?>
        <?php include_partial('locationlink/tree_element', array('element'=>$children) ); ?>
    <?php endforeach ?>
<?endif ?>