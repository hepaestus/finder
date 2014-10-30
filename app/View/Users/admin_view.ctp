<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['profile_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Extended Profile Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['extended_profile_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recovery Hash'); ?></dt>
		<dd>
			<?php echo h($user['User']['recovery_hash']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Loggedin'); ?></dt>
		<dd>
			<?php echo h($user['User']['loggedin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lastlogin'); ?></dt>
		<dd>
			<?php echo h($user['User']['lastlogin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Extended Profiles'), array('controller' => 'extended_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extended Profile'), array('controller' => 'extended_profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Interests'), array('controller' => 'interests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reputations'), array('controller' => 'reputations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reputation'), array('controller' => 'reputations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Connections'), array('controller' => 'connections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Profiles'); ?></h3>
	<?php if (!empty($user['Profile'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['Profile']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['Profile']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Scene Name'); ?></dt>
		<dd>
	<?php echo $user['Profile']['scene_name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Birth Date'); ?></dt>
		<dd>
	<?php echo $user['Profile']['birth_date']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $user['Profile']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $user['Profile']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Profile'), array('controller' => 'profiles', 'action' => 'edit', $user['Profile']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php echo __('Related Extended Profiles'); ?></h3>
	<?php if (!empty($user['ExtendedProfile'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['user_id']; ?>
&nbsp;</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['first_name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['last_name']; ?>
&nbsp;</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['postal_code']; ?>
&nbsp;</dd>
		<dt><?php echo __('Birth Date'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['birth_date']; ?>
&nbsp;</dd>
		<dt><?php echo __('Gender Identity'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['gender_identity']; ?>
&nbsp;</dd>
		<dt><?php echo __('Relationship Status'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['relationship_status']; ?>
&nbsp;</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['image']; ?>
&nbsp;</dd>
		<dt><?php echo __('External Links'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['external_links']; ?>
&nbsp;</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['latitude']; ?>
&nbsp;</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['longitude']; ?>
&nbsp;</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['created']; ?>
&nbsp;</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
	<?php echo $user['ExtendedProfile']['modified']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Extended Profile'), array('controller' => 'extended_profiles', 'action' => 'edit', $user['ExtendedProfile']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Interests'); ?></h3>
	<?php if (!empty($user['Interest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Activity Id'); ?></th>
		<th><?php echo __('Giving'); ?></th>
		<th><?php echo __('Recieving'); ?></th>
		<th><?php echo __('Importance'); ?></th>
		<th><?php echo __('Experience'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Interest'] as $interest): ?>
		<tr>
			<td><?php echo $interest['id']; ?></td>
			<td><?php echo $interest['user_id']; ?></td>
			<td><?php echo $interest['activity_id']; ?></td>
			<td><?php echo $interest['giving']; ?></td>
			<td><?php echo $interest['recieving']; ?></td>
			<td><?php echo $interest['importance']; ?></td>
			<td><?php echo $interest['experience']; ?></td>
			<td><?php echo $interest['created']; ?></td>
			<td><?php echo $interest['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'interests', 'action' => 'view', $interest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'interests', 'action' => 'edit', $interest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'interests', 'action' => 'delete', $interest['id']), array(), __('Are you sure you want to delete # %s?', $interest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Reputations'); ?></h3>
	<?php if (!empty($user['Reputation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Reviewer Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Endoresments Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Reputation'] as $reputation): ?>
		<tr>
			<td><?php echo $reputation['id']; ?></td>
			<td><?php echo $reputation['user_id']; ?></td>
			<td><?php echo $reputation['reviewer_id']; ?></td>
			<td><?php echo $reputation['comment']; ?></td>
			<td><?php echo $reputation['endoresments_id']; ?></td>
			<td><?php echo $reputation['created']; ?></td>
			<td><?php echo $reputation['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'reputations', 'action' => 'view', $reputation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'reputations', 'action' => 'edit', $reputation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'reputations', 'action' => 'delete', $reputation['id']), array(), __('Are you sure you want to delete # %s?', $reputation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Reputation'), array('controller' => 'reputations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Connections'); ?></h3>
	<?php if (!empty($user['Connection'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Connection Id'); ?></th>
		<th><?php echo __('Connection Type'); ?></th>
		<th><?php echo __('Verified'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Connection'] as $connection): ?>
		<tr>
			<td><?php echo $connection['id']; ?></td>
			<td><?php echo $connection['user_id']; ?></td>
			<td><?php echo $connection['connection_id']; ?></td>
			<td><?php echo $connection['connection_type']; ?></td>
			<td><?php echo $connection['verified']; ?></td>
			<td><?php echo $connection['message']; ?></td>
			<td><?php echo $connection['created']; ?></td>
			<td><?php echo $connection['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'connections', 'action' => 'view', $connection['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'connections', 'action' => 'edit', $connection['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'connections', 'action' => 'delete', $connection['id']), array(), __('Are you sure you want to delete # %s?', $connection['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
