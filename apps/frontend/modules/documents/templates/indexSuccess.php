<?php slot('body_id') ?>body_documents<?php end_slot() ?>
<h1><?php echo __('Documents') ?></h1>

<?php 
include_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'documents/index') ); 
$documents_list = $pager->getResults();
?>

<?php include_partial( 'documents/list', array('documents_list' => $documents_list)); ?>

<?php include_partial('global/navigation', array('pager'=>$pager, 'module_action'=>'documents/index') ); ?>