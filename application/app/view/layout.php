<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Apace</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'  />

	<link href="<?=Apace::getDataUrl('css/minified');?>layout.css" rel="stylesheet"/>

</head>

<body>

	<section class="container">

		<header><h2><?=__('lng.welcome', 'default')?></h2></header>
			<?=$data['content']?>
		<footer><p>Language</p> {{ langswitcher }}</footer>
		
	</section>