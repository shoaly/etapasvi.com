<?php if (count($news_list)): ?>
	<table class="news_list">
		<?php foreach ($news_list as $i=>$newsitem): ?>
			<tr>
				<td <?php if ($latest && $i >= 1):?>class="minimized"<?php endif?> <?php if ($latest):?>onclick="toggleLatestNews('<?php echo $newsitem->getId(); ?>');"<?php endif ?> id="lnews_<?php echo $newsitem->getId() ?>" >
                    <?php include_partial('news/showShort', array('newsitem'=>$newsitem, 'latest'=>$latest, 'latest_first'=>($i == 0)) ); ?>
                </td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php endif ?>