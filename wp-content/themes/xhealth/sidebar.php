<?php
$sidebar = get_field('sidebar_option', 'option');
if ($sidebar):
	?>
	<div id="sidebar">
		<?php foreach ($sidebar as $it): ?>
			<div class="side--item">
				<h5><?= $it['heading'] ?></h5>
				<?php if (!empty($it['sidebar_block_info'])): ?>
					<div class="side--item__info">
						<?= $it['sidebar_block_info']; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>