<?php if (count($photoalbum_list)): ?>
<div class="album_list">
		<?php $i = 1; ?>
		<?php foreach ($photoalbum_list as $photoalbum): ?>
			<div>
                <?php include_partial('photoalbum/show', array('photoalbum'=>$photoalbum) ); ?>
            </div>
		<?php endforeach; ?>
	</div>
<?php endif ?>
