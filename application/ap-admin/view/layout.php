<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="<?=Apace::getDataUrl('img');?>apple-icon.png" />
	<link rel="icon" type="image/png" href="<?=Apace::getDataUrl('img');?>favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Apace admin</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="<?=Apace::getDataUrl('css/lib');?>bootstrap.min.css" rel="stylesheet" />
    <link href="<?=Apace::getDataUrl('css/minified');?>template.css" rel="stylesheet"/>
    <link href="<?=Apace::getDataUrl('css/minified');?>layout.css" rel="stylesheet"/>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>
	<div class="wrapper">

	    <div class="sidebar" data-color="blue" data-image="<?=Apace::getDataUrl('img');?>sidebar1.jpg">

			<div class="logo">
				<a href="<?=Apace::fullBaseUrl();?>" class="simple-text">
					APACE V 1.0.0
				</a>
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="active">
	                    <a href="<?=Apace::fullBaseUrl();?>">
	                        <i class="material-icons">dashboard</i>
	                        <p>Settings</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
	    <nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
				</div>
			</nav>
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<?=$data['content']?>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<!--   Core JS Files   -->
	<script src="<?=Apace::getDataUrl('js/lib');?>jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="<?=Apace::getDataUrl('js/lib');?>bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=Apace::getDataUrl('js/lib');?>material.min.js" type="text/javascript"></script>
	<script src="<?=Apace::getDataUrl('js/lib');?>bootstrapnotify.js"></script>
	<script src="<?=Apace::getDataUrl('js/lib');?>dashboard.js"></script>