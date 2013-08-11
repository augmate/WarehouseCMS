<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
	<div class="span-10">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
	<div class="span-2">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Operations',
			));
			
			$this->endWidget();
		?>
	</div>
</div>

<?php $this->endContent(); ?>