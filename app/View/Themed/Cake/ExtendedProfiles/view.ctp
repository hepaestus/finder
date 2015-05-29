<div class="extendedProfiles view">
<h2><?php echo __('Extended Profile'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($extendedProfile['User']['id'], array('controller' => 'users', 'action' => 'view', $extendedProfile['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Postal Code'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['postal_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender Identity'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['gender_identity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Relationship Status'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['relationship_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
            <?php 
                if ( $extendedProfile['ExtendedProfile']['image']) {
                    echo("<img src=\"/finder/" . $extendedProfile['ExtendedProfile']['image'] . "\" alt=\"Profile Image\" />");
                }
            ?>
			&nbsp;
		</dd>
		<dt><?php echo __('External Links'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['external_links']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitude'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['latitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitude'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['longitude']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($extendedProfile['ExtendedProfile']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Extended Profile'), array('action' => 'edit', $extendedProfile['ExtendedProfile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Extended Profile'), array('action' => 'delete', $extendedProfile['ExtendedProfile']['id']), array(), __('Are you sure you want to delete # %s?', $extendedProfile['ExtendedProfile']['id'])); ?> </li>
		<!-- li><?php // echo $this->Html->link(__('List Extended Profiles'), array('action' => 'index')); ?> </li -->
		<!-- li><?php // echo $this->Html->link(__('New Extended Profile'), array('action' => 'add')); ?> </li -->
		<!-- li><?php // echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li -->
		<!-- li><?php // echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li -->
	</ul>
</div>
