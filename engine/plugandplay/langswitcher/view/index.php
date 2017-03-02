
<div class="langswitcher">

	<?php foreach($data['languages'] as $key => $value) : ?>
		<a href="<?php echo Apace::fullBaseUrl(); ?>langswitcher_plugin_/switchlang/<?php echo $value; ?>" target="_self"><?php echo $key; ?></a> 
	<?php endforeach; ?>

</div>