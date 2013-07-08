<?php if (count($photoalbum_list)): ?>
<table class="album_list">
    <?php $i = 1; ?>
    <?php foreach ($photoalbum_list as $photoalbum): ?>
        <?php if ($i == 1): ?>
            <tr>
        <?php endif ?>
        <td><?php include_partial('photoalbum/show', array('photoalbum'=>$photoalbum) ); ?></td>
        <?php if ($i == 3): ?>
            </tr>
        <?php endif ?>
        <?php if ($i < 3): ?>
            <?php $i++; ?>
        <?php else: ?>
            <?php $i = 1; ?>
        <?php endif ?>
    <?php endforeach; ?>
</table>
<?php endif ?>
