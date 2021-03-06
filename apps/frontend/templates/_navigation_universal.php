<?php
if (strstr($module_action, '?')) {
    $splitter_and_parameters = '&';
} else {
    $splitter_and_parameters = '?';
}
if (count($parameters)) {
    foreach($parameters as $parameter=>$value) {
        if ('' != $value) {
            $splitter_and_parameters .= $parameter.'='.$value.'&';
        }
    }
}
?>
<?php if ($have_to_paginate && $last_page != 1): ?>
<div class="navigation">

	<?php $show_prev = $first_page != $page && ($page - $plus_digits >= 2); ?>
	<?php $show_next = $last_page != $page && ($page + $plus_digits <= $last_page - 1); ?>

	<?php if ($page > 1 && $last_page > 2): ?>
		<a href="<?php echo url_for($module_action.(($page-1)!=1 ? $splitter_and_parameters.'page='.($page-1) : substr($splitter_and_parameters, 0, strlen($splitter_and_parameters)-1))) ?>" class="arrow_prev">&lt;</a>&nbsp;
	<?php endif ?>
    
	<?php if ($show_prev): ?>
		<a href="<?php echo url_for($module_action.substr($splitter_and_parameters, 0, strlen($splitter_and_parameters)-1)) ?>" class="arrow_prev">1</a>&nbsp;
		<a href="<?php echo url_for($module_action.$splitter_and_parameters.'page='.($page - $plus_digits)) ?>" class="arrow_prev">..</a>&nbsp;
	<?php endif ?>
	
	<?php foreach ($page_numbers_list as $page_number): ?>	
		<?php if ( ($show_prev && $page_number < $page - $plus_digits + 1) || ($show_next && $page_number > $page + $plus_digits - 1) ) continue; ?>
		<?php if ($page_number == $page): ?>
			<span class="nav_selected"><?php echo $page_number; ?></span>&nbsp;
		<?php else: ?>
			<?php echo ( ($page_number==1) ? link_to($page_number, $module_action.substr($splitter_and_parameters, 0, strlen($splitter_and_parameters)-1)) : link_to($page_number, $module_action.$splitter_and_parameters.'page='.$page_number) ); ?>&nbsp;
		<?php endif ?>
	<?php endforeach ?>

	<?php if ($show_next): ?>
		<a href="<?php echo url_for($module_action.$splitter_and_parameters.'page='.($page + $plus_digits)/*.$orderby*/) ?>" class="arrow_next">..</a>&nbsp;
		<a href="<?php echo url_for($module_action.$splitter_and_parameters.'page='.$last_page/*.$orderby*/) ?>" class="arrow_next"><?php echo $last_page; ?></a>&nbsp;
	<?php endif ?>
    
	<?php if ($page < $last_page): ?>
		<a href="<?php echo url_for($module_action.$splitter_and_parameters.'page='.($page+1)) ?>" class="arrow_prev">&gt;</a>&nbsp;
	<?php endif ?>
    
</div>
<?php endif ?>