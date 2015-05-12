<?php //pr($user) ?>
<div>
  <h2>Connection Type</h2>
  <h3><?php echo $connection_type; ?></h3>
</div>
<div class="related">
    <h2><?php echo __('User'); ?></h2>
    <dl>
        <dt><?php echo __('Username'); ?></dt>
        <dd> <?php echo h($user['User']['username']); ?> &nbsp; </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd> <?php echo h($user['User']['email']); ?> &nbsp; </dd>
        <dt><?php echo __('Loggedin'); ?></dt>
        <dd> <?php echo h($user['User']['loggedin']); ?> &nbsp; </dd>
        <dt><?php echo __('Lastlogin'); ?></dt>
        <dd> <?php echo h($user['User']['lastlogin']); ?> &nbsp; </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd> <?php echo h($user['User']['created']); ?> &nbsp; </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd> <?php echo h($user['User']['modified']); ?> &nbsp; </dd>
    </dl>
</div>

<div class="related">
    <?php if (!empty($user['Profile'])): ?>
    <h3><?php echo __('Profiles'); ?></h3>
    <dl>
        <dt><?php echo __('Scene Name'); ?></dt>
        <dd> <?php echo $user['Profile']['scene_name']; ?> &nbsp;</dd>
        <dt><?php echo __('Birth Date'); ?></dt>
        <dd> <?php echo $user['Profile']['birth_date']; ?> &nbsp;</dd>
    </dl>
    <?php endif; ?>
</div>

<div class="related">
    <?php if (!empty($user['ExtendedProfile'])): ?>
    <h3><?php echo __('Extended Profile'); ?></h3>
    <dl>
        <dt><?php echo __('First Name'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['first_name']; ?> &nbsp;</dd>
        <dt><?php echo __('Last Name'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['last_name']; ?> &nbsp;</dd>
        <dt><?php echo __('Postal Code'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['postal_code']; ?> &nbsp;</dd>
        <dt><?php echo __('Gender Identity'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['gender_identity']; ?> &nbsp;</dd>
        <dt><?php echo __('Relationship Status'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['relationship_status']; ?> &nbsp;</dd>
        <dt><?php echo __('Image'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['image']; ?> &nbsp;</dd>
        <dt><?php echo __('External Links'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['external_links']; ?> &nbsp;</dd>
        <dt><?php echo __('Location'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['latitude']; ?>,<?php echo $user['ExtendedProfile']['longitude']; ?> &nbsp;</dd>
    </dl>
    <?php endif; ?>
</div>
    
<div class="related">
    <?php if (!empty($user['Interest'])): ?>
    <h3><?php echo __('Related Interests'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Activity'); ?></th>
        <th><?php echo __('Giving'); ?></th>
        <th><?php echo __('Receiving'); ?></th>
        <th><?php echo __('Importance'); ?></th>
        <th><?php echo __('Experience'); ?></th>
    </tr>
    <?php foreach ($interests as $interest): ?>
        <tr>
            <td><?php echo $this->Html->link($interest['activities']['name'], array('controller' => 'activities', 'action' => 'view', $interest['interests']['activity_id'])); ?>
            <td><?php echo $interest['interests']['giving']; ?></td>
            <td><?php echo $interest['interests']['receiving']; ?></td>
            <td><?php echo $interest['interests']['importance']; ?></td>
            <td><?php echo $interest['interests']['experience']; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>
