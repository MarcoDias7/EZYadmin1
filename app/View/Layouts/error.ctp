<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			EZYcount : Page not found
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
			echo $this->Html->meta('icon');
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
			echo $this->Html->css('bootstrap.min');
			echo $this->Html->css('bootstrap-theme');
			echo $this->Html->script('jquery');
			echo $this->Html->script('bootstrap.min');

		?>
		<style type="text/css">
			.abs-center {
				margin: auto;
				position: absolute;
				top: 0; left: 0; bottom: 0; right: 0;
				height: 200px;
				width: 400px;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="abs-center">
			<div>
				<?php echo $this->fetch('content'); ?>
			</div>
			<?php echo $this->element('sql_dump'); ?>
		</div>
	</body>
</html>
