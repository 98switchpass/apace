<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
		<div class="nav-tabs-navigation">
			<div class="nav-tabs-wrapper">
				<ul class="nav nav-tabs" data-tabs="tabs">
					<li class="active">
						<a href="#systemconfig" data-toggle="tab">
							<i class="material-icons">dashboard</i>
							Server settings
						<div class="ripple-container"></div></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="card-content">

		<div class="tab-content">

			<div class="tab-pane active" id="systemconfig">
				<form class="defaultform" action="<?php echo Apace::baseUrl(); ?>index/savesystemconfig" method="POST">

					<div class="col-lg-6">
						<h5>General</h5>
						<p>Provide your general settings below</p>

						<?php foreach ($data['serverdata'] as $key => $value) : ?>
							<div class="form-group">
								<label class="text-muted"><?=IndexController::switchconfigparamtoicon($key); ?><?=__('lng.'.$key, $key)?></label>
								<input type="text" name="serverdata[<?=$key;?>]" value="<?=$value;?>" class="form-control" />
							</div>
						<?php endforeach; ?>

					</div>

					<div class="col-lg-6">
						<h5>Database Connection</h5>
						<p class="text-muted">Provide your database connection credentials below (Not required)</p>
						<?php foreach ($data['databasedata'] as $key => $value) : ?>
							<div class="form-group">
								<label><?=$key;?></label>
								<input type="text" name="databasedata[<?=$key;?>]" value="<?=$value;?>" class="form-control" />
							</div>
						<?php endforeach; ?>

					</div>

					<div class="col-lg-12">
						<button type="submit" class="btn btn-default">Save settings</button>
					</div>

					<div class="clearfix"></div>
					
				</form>
			</div>

		</div>

	</div>

</div>