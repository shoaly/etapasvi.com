<td>
<ul class="sf_admin_td_actions">
  <li><?php echo link_to(image_tag('/sf_data_lsdfkr/sf_admin/images/edit_icon.png', array('alt' => __('edit'), 'title' => __('edit'))), 'revisionhistory/edit?id='.$revisionhistory->getId()) ?></li>

<?php if ($sf_user->hasGroup('admins') || $sf_user->hasGroup('managers')) : ?>
  <li><?php echo link_to(image_tag('/sf_data_lsdfkr/sf_admin/images/delete_icon.png', array('alt' => __('delete'), 'title' => __('delete'))), 'revisionhistory/delete?id='.$revisionhistory->getId(), array (
  'post' => true,
  'confirm' => __('Are you sure?'),
)) ?></li>
<?php endif ?>

</ul>
</td>
