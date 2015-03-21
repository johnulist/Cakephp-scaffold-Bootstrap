<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<h2 class="page-header"><?php printf("<?php echo __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?>
	<?php
		echo "\t\t<?php echo \$this->Html->link('<i class=\"fa fa-angle-left\"></i> Back', array('plugin' => '', 'controller' => 'apppkgs', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-sm btn-danger')); ?>\n";
	?>

	<span class="pull-right">

			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="ActionsDropdown" data-toggle="dropdown" aria-expanded="true">
					<i class="fa fa-cog"></i> Actions
					<span class="caret"></span>
				</button>

				<ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="ActionsDropdown">
					<li role="presentation"><?php echo "<?php echo \$this->Html->link(__('New " . $singularHumanName . "'), array('action' => 'add'), array('escape' => false, 'class' => '', 'role' => 'menuitem', 'tabindex' => '-1')); ?>"; ?></li>
					<?php
					$done = array();
					foreach ($associations as $type => $data) {
						foreach ($data as $alias => $details) {
							if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
								echo "\t\t<li role=\"presentation\"><?php echo \$this->Html->link(__('List " . Inflector::humanize($details['controller']) . "'), array('controller' => '{$details['controller']}', 'action' => 'index'), array('escape' => false, 'class' => '', 'role' => 'menuitem', 'tabindex' => '-1')); ?> </li>\n";
								echo "\t\t<li role=\"presentation\"><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), array('controller' => '{$details['controller']}', 'action' => 'add'), array('escape' => false, 'class' => '', 'role' => 'menuitem', 'tabindex' => '-1')); ?> </li>\n";
								$done[] = $details['controller'];
							}
						}
					}
					?>
				</ul>
			</div>
		</span>

</h2>
<div class="row">
	<div class="col-md-4">
		<div class="<?php echo $pluralVar; ?> form">
			<?php echo "<?php echo \$this->Form->create('{$modelClass}'); ?>\n"; ?>


				<?php

				foreach ($fields as $field) {
					if (strpos($action, 'add') !== false && $field === $primaryKey) {
						continue;
					} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
						echo "\t<div class=\"form-group\">\n";
						echo "\t\t<?php echo \$this->Form->input('{$field}',array('class' => 'form-control')); ?>\n";
						echo "\t</div>\n";
					}
				}
				if (!empty($associations['hasAndBelongsToMany'])) {
					foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
						echo "\t<div class=\"form-group\">\n";
						echo "\t\t<?php echo \$this->Form->input('{$assocName}',array('class' => 'form-control')); ?>\n";
						echo "\t</div>\n";
					}
				}
				echo "\n";
				?>

			<?php
			echo "<?php echo \$this->Form->button(__('Submit'), array('type' => 'submit', 'class' => 'btn btn-hg btn-block btn-primary'));?>\n";
			echo "<?php echo \$this->Form->end(); ?>\n";
			?>
		</div>
	</div>
</div>
