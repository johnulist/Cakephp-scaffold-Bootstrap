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
<div class="<?php echo $pluralVar; ?> index">
	<h2 class="page-header"><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>

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

	<?php echo "\t\t<?php echo \$this->element('parts/adminNavigation', array('modelName' => '{$pluralHumanName}', 'actionName' => 'Add new {$singularHumanName}'))?>\n"?>
	<table class="table">
	<thead>
	<tr>
	<?php foreach ($fields as $field): ?>
		<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
	<?php endforeach; ?>
		<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t<tr>\n";
		foreach ($fields as $field) {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('View'), array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t\t<?php echo \$this->Html->link(__('Edit'), array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t\t<?php echo \$this->Form->postLink(__('Delete'), array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array(), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
	?>
	</tbody>
	</table>

	<?php echo "\t\t<?php echo \$this->element('pagination'); ?>\n"?>

</div>
