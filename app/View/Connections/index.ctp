<?php //pr($connections); ?>
<div class="connections index">
	<h2><?php echo __('Connections'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<!-- th><?php //echo __('id'); ?></th -->
			<th><?php echo __('Connection From'); ?></th -->
			<th><?php echo __('Connection To'); ?></th>
			<th><?php echo __('Connection Type'); ?></th>
			<!-- th><?php //echo __('verified'); ?></th -->
			<th><?php echo __('Message'); ?></th>
			<th><?php echo __('created'); ?></th>
			<th><?php echo __('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($connections as $connection): ?>
	<tr>
		<!-- td><?php //echo h($connection['Connection']['id']); ?>&nbsp;</td -->
		<td><?php echo h($connection['MyUser']['username']); ?>&nbsp;</td -->
		<!-- td><?php //echo h($connection['Connection']['connection_id']); ?>&nbsp;</td -->
		<td><?php echo h($connection['MyConnection']['username']); ?>&nbsp;</td>
		<td><?php echo h($connection['Connection']['connection_type']); ?>&nbsp;</td>
		<!-- td><?php //echo h($connection['Connection']['verified']); ?>&nbsp;</td -->
		<td><?php echo h($connection['Connection']['message']); ?>&nbsp;</td>
		<td><?php echo h($connection['Connection']['created']); ?>&nbsp;</td>
		<td><?php echo h($connection['Connection']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $connection['Connection']['id'])); ?>
            <?php 
              if ( $connection['Connection']['user_id'] == $connection['MyUser']['id'] ) {  
			      echo $this->Html->link(__('Verify'), array('action' => 'verify', $connection['Connection']['id'])); 
              }
            ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $connection['Connection']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $connection['Connection']['id']), array(), __('Are you sure you want to delete # %s?', $connection['Connection']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Connection'), array('action' => 'add')); ?></li>
	</ul>
</div>
