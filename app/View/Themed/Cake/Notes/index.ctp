<div class="notes index">
	<h2><?php echo __('Notes Received'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('From'); ?></th>
			<th><?php echo __('Subject'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($notesIncoming as $note): ?>
	<tr>
		<td><?php echo $this->Html->link($note['Note']['id'], array('controller' => 'users', 'action' => 'view', $note['Note']['id'])); ?>&nbsp;</td>
        <td><?php echo $this->Html->link($note['ToUser']['username'], array('controller' => 'users', 'action' => 'view', $note['ToUser']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->html->link($note['Note']['subject'], array('controller' => 'notes', 'action' => 'view', $note['Note']['id'] )); ?>&nbsp;</td>
		<td><?php echo h($note['Note']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $note['Note']['id'])); ?>
			<?php echo $this->Html->link(__('Reply'), array('action' => 'reply', $note['Note']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $note['Note']['id']), array(), __('Are you sure you want to delete \'%s\'?', $note['Note']['subject'])); ?>
		</td>
	</tr>
    <?php endforeach; ?>
	</tbody>
	</table>
</div>

<div class="notes index">
	<h2><?php echo __('Notes Sent'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('To'); ?></th>
			<th><?php echo __('Subject'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($notesOutgoing as $note): ?>
	<tr>
		<td><?php echo $this->Html->link($note['Note']['id'], array('controller' => 'users', 'action' => 'view', $note['Note']['id'])); ?>&nbsp;</td>
        <td><?php echo $this->Html->link($note['ToUser']['username'], array('controller' => 'users', 'action' => 'view', $note['ToUser']['id'])); ?>&nbsp;</td>
		<td><?php echo $this->html->link($note['Note']['subject'], array('controller' => 'notes', 'action' => 'view', $note['Note']['id'] )); ?>&nbsp;</td>
		<td><?php echo h($note['Note']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $note['Note']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $note['Note']['id']), array(), __('Are you sure you want to delete \'%s\'?', $note['Note']['subject'])); ?>
		</td>
	</tr>
    <?php endforeach; ?>
	</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Note'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
	</ul>
</div>
