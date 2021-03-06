<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit User/Change Password'), array('action' => 'edit', $user['User']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Show Matches'), array('controller' => 'searches', 'action' => 'matches')); ?> </li>
        <!-- li><?php //echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li -->
        <!-- li><?php //echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li -->
        <!-- li><?php //echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li -->
        <?php if ( empty($user['Profile']['id']) ): ?>
            <li><?php echo $this->Html->link(__('Create Your Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
        <?php endif; ?>
        <!-- li><?php //echo $this->Html->link(__('List Extended Profiles'), array('controller' => 'extended_profiles', 'action' => 'index')); ?> </li -->
        <?php if ( empty($user['ExtendedProfile']['id']) ): ?>
            <li><?php echo $this->Html->link(__('Create Your Extended Profile'), array('controller' => 'extended_profiles', 'action' => 'add')); ?> </li>
        <?php endif; ?>
        <?php if ( count($user['Interest']) > 0 ): ?>
            <li><?php echo $this->Html->link(__('List Interests'), array('controller' => 'interests', 'action' => 'index')); ?> </li>
        <?php endif; ?>
        <li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
        <?php if (! empty($reputationsIncoming) || ! empty($reputationsOutgoing) ): ?>
            <li><?php echo $this->Html->link(__('List Reputations'), array('controller' => 'reputations', 'action' => 'index')); ?> </li>
        <?php endif; ?>
        <li><?php echo $this->Html->link(__('New Reputation'), array('controller' => 'reputations', 'action' => 'add')); ?> </li>
        <?php if (! empty($connectionsIncoming) || ! empty($connectionsOutgoing) ): ?>
            <li><?php echo $this->Html->link(__('List Connections'), array('controller' => 'connections', 'action' => 'index')); ?> </li>
        <?php endif; ?>
        <li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete User Account'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete your account for %s?', $user['User']['username'])); ?> </li>
    </ul>
</div>
<div class="view">
    <h2><?php echo __('Your User Information'); ?></h2>
    <dl>
        <!-- dt><?php //echo __('Id'); ?></dt>
        <dd> <?php //echo h($user['User']['id']); ?> &nbsp; </dd -->
        <!-- dt><?php //echo __('Profile Id'); ?></dt>
        <dd> <?php //echo h($user['User']['profile_id']); ?> &nbsp; </dd -->
        <!-- dt><?php //echo __('Extended Profile Id'); ?></dt>
        <dd> <?php //echo h($user['User']['extended_profile_id']); ?> &nbsp; </dd -->
        <dt><?php echo __('Username'); ?></dt>
        <dd> <?php echo h($user['User']['username']); ?> &nbsp; </dd>
        <!-- dt><?php //echo __('Password'); ?></dt>
        <dd> <?php //echo h($user['User']['password']); ?> &nbsp; </dd -->
        <!-- dt><?php //echo __('Recovery Hash'); ?></dt>
        <dd> <?php //echo h($user['User']['recovery_hash']); ?> &nbsp; </dd -->
        <dt><?php echo __('Role'); ?></dt>
        <dd> <?php echo h($user['User']['role']); ?> &nbsp; </dd>
        <dt><?php echo __('Email'); ?></dt>
        <dd> <?php echo h($user['User']['email']); ?> &nbsp; </dd>
        <!-- dt><?php //echo __('Loggedin'); ?></dt>
        <dd> <?php //echo h($user['User']['loggedin']); ?> &nbsp; </dd -->
        <dt><?php echo __('Lastlogin'); ?></dt>
        <dd> <?php echo h($user['User']['lastlogin']); ?> &nbsp; </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd> <?php echo h($user['User']['created']); ?> &nbsp; </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd> <?php echo h($user['User']['modified']); ?> &nbsp; </dd>
    </dl>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Edit User'), array('controller' => 'users', 'action' => 'edit', $user['User']['id'])); ?></li>
        </ul>
    </div>
    <br style="clear:both;"/>
    <?php if (!empty($user['Profile']['id'])): ?>
    <h3><?php echo __('Your Profile'); ?></h3>
    <dl>
        <!-- dt><?php //echo __('Id'); ?></dt>
        <dd> <?php //echo $user['Profile']['id']; ?> &nbsp;</dd -->
        <!-- dt><?php //echo __('User Id'); ?></dt>
        <dd> <?php //echo $user['Profile']['user_id']; ?> &nbsp;</dd -->
        <dt><?php echo __('Scene Name'); ?></dt>
        <dd> <?php echo $user['Profile']['scene_name']; ?> &nbsp;</dd>
        <dt><?php echo __('Birth Date'); ?></dt>
        <dd> <?php echo $user['Profile']['birth_date']; ?> &nbsp;</dd>
        <dt><?php echo __('About'); ?></dt>
        <dd> <?php echo $user['Profile']['about']; ?> &nbsp;</dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd> <?php echo $user['Profile']['created']; ?> &nbsp;</dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd> <?php echo $user['Profile']['modified']; ?> &nbsp;</dd>
    </dl>
    <?php endif; ?>
    <div class="actions">
        <ul>
            <?php if ( empty($user['Profile']['id']) ): ?>
                <li><?php echo $this->Html->link(__('Create Your Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
            <?php else: ?>
                <li><?php echo $this->Html->link(__('Edit Profile'), array('controller' => 'profiles', 'action' => 'edit', $user['Profile']['id'])); ?></li>
            <?php endif; ?>
        </ul>
    </div>
    <br style="clear:both;"/>

    <?php if (!empty($user['ExtendedProfile']['id'])): ?>
    <h3><?php echo __('Your Extended Profile'); ?></h3>
    <dl>
        <!-- dt><?php //echo __('Id'); ?></dt>
        <dd> <?php //echo $user['ExtendedProfile']['id']; ?> &nbsp;</dd -->
        <!-- dt><?php //echo __('User Id'); ?></dt>
        <dd> <?php //echo $user['ExtendedProfile']['user_id']; ?> &nbsp;</dd -->
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
        <dd> <?php if ( $user['ExtendedProfile']['image'] ) { 
                       echo $this->Html->image($user['ExtendedProfile']['image'], array( 'alt' => 'Profile Image'));;
                   } else {
                       echo "none"; 
                   }
             ?>&nbsp;
        </dd>
        <dt><?php echo __('External Links'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['external_links']; ?> &nbsp;</dd>
        <dt><?php echo __('Location'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['latitude'] . "," . $user['ExtendedProfile']['longitude']; ?> &nbsp;</dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['created']; ?> &nbsp;</dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd> <?php echo $user['ExtendedProfile']['modified']; ?> &nbsp;</dd>
    </dl>
    <?php endif; ?>
    <div class="actions">
        <ul>
            <?php if ( empty($user['ExtendedProfile']['id']) ): ?>
                <li><?php echo $this->Html->link(__('Create Your Extended Profile'), array('controller' => 'extended_profiles', 'action' => 'add')); ?> </li>
            <?php else: ?>
                <li><?php echo $this->Html->link(__('Edit Extended Profile'), array('controller' => 'extended_profiles', 'action' => 'edit', $user['ExtendedProfile']['id'])); ?></li>
            <?php endif; ?>
        </ul>
    </div>
    <br style="clear:both;"/>
</div>
    
<div class="related">
    <h3><?php echo __('Matches'); ?></h3>
    <?php
    $matches_array = json_decode($matches,1);
    if (!empty( $matches_array['response'])):
    ?>
    <div style="float:right;width:50%" class=""><?php pr($matches); ?></div>
    <?php echo $this->element('matches_list'); ?>
    <?php else: ?>
        <h4>You Currently have no matches. Try creating your profile and adding some interests.</h4>
        <br style="clear:both;"/>
    <?php endif; ?>
</div>

<div class="related">
    <h3><?php echo __('Your Interests'); ?></h3>
    <?php if (!empty($user['Interest'])): ?>
    <?php //pr($user['Interest']); ?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <!-- th><?php //echo __('Id'); ?></th -->
        <!-- th><?php //echo __('User Id'); ?></th -->
        <th><?php echo __('Activity Id'); ?></th>
        <th><?php echo __('Giving'); ?></th>
        <th><?php echo __('Receiving'); ?></th>
        <th><?php echo __('Importance'); ?></th>
        <th><?php echo __('Experience'); ?></th>
        <!-- th><?php // echo __('Created'); ?></th -->
        <!-- th><?php // echo __('Modified'); ?></th -->
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($user['Interest'] as $interest): ?>
        <tr>
            <!-- td><?php //echo $interest['id']; ?></td -->
            <!-- td><?php //echo $interest['user_id']; ?></td -->
            <!-- td><?php // echo $interest['activity_id']; ?></td -->
            <!-- td><?php //echo $interest['Activity']['name']; ?></td -->
            <td><?php echo $this->Html->link($interest['Activity']['name'], array('controller' => 'activities', 'action' => 'view', $interest['activity_id'])); ?>
            <td><?php echo $interest['giving']; ?></td>
            <td><?php echo $interest['receiving']; ?></td>
            <td><?php echo $interest['importance']; ?></td>
            <td><?php echo $interest['experience']; ?></td>
            <!-- td><?php // echo $interest['created']; ?></td -->
            <!-- td><?php // echo $interest['modified']; ?></td -->
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
    <h2><?php echo __('Reputations'); ?></h2>
    <?php echo $this->element('reputation_summary', array('reputationSummary' => $reputationSummary)); ?>
    <?php if (!empty($reputationsOutgoing)): ?>
    <h4><?php echo __('Outgoing Reputations'); ?></h4>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('User Id'); ?></th>
        <th><?php echo __('Reviewer Id'); ?></th>
        <th><?php echo __('Comment'); ?></th>
        <th><?php echo __('Rating'); ?></th>
        <!-- th><?php //echo __('Endoresments Id'); ?></th -->
        <th><?php echo __('Created'); ?></th>
        <th><?php echo __('Modified'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($reputationsOutgoing as $reputation): ?>
        <tr>
            <td><?php echo $reputation['Reputation']['id']; ?></td>
            <td><?php echo $reputation['User']['username']; ?></td>
            <td><?php echo $reputation['Reviewer']['username']; ?></td>
            <td><?php echo $reputation['Reputation']['comment']; ?></td>
            <td><?php echo $reputation['Reputation']['rating']; ?></td>
            <!-- td><?php //echo $reputation['Reputation']['endoresments_id']; ?></td -->
            <td><?php echo $reputation['Reputation']['created']; ?></td>
            <td><?php echo $reputation['Reputation']['modified']; ?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'reputations', 'action' => 'view', $reputation['Reputation']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'reputations', 'action' => 'edit', $reputation['Reputation']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'reputations', 'action' => 'delete', $reputation['Reputation']['id']), array(), __('Are you sure you want to delete # %s?', $reputation['Reputation']['comment'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <?php if (!empty($reputationsIncoming)): ?>
    <h4><?php echo __('Incoming Reputations'); ?></h4>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('User Id'); ?></th>
        <th><?php echo __('Reviewer Id'); ?></th>
        <th><?php echo __('Comment'); ?></th>
        <th><?php echo __('Rating'); ?></th>
        <!-- th><?php //echo __('Endoresments Id'); ?></th -->
        <th><?php echo __('Created'); ?></th>
        <th><?php echo __('Modified'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($reputationsIncoming as $reputation): ?>
        <tr>
            <td><?php echo $reputation['Reputation']['id']; ?></td>
            <td><?php echo $reputation['User']['username']; ?></td>
            <td><?php echo $reputation['Reviewer']['username']; ?></td>
            <td><?php echo $reputation['Reputation']['comment']; ?></td>
            <td><?php echo $reputation['Reputation']['rating']; ?></td>
            <!-- td><?php //echo $reputation['Reputation']['endoresments_id']; ?></td -->
            <td><?php echo $reputation['Reputation']['created']; ?></td>
            <td><?php echo $reputation['Reputation']['modified']; ?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'reputations', 'action' => 'view', $reputation['Reputation']['id'])); ?>
                <?php // echo $this->Html->link(__('Edit'), array('controller' => 'reputations', 'action' => 'edit', $reputation['Reputation']['id'])); ?>
                <?php // echo $this->Form->postLink(__('Delete'), array('controller' => 'reputations', 'action' => 'delete', $reputation['Reputation']['id']), array(), __('Are you sure you want to delete # %s?', $reputation['Reputation']['id'])); ?>
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
    <h2><?php echo __('Connections'); ?></h2>
    <h4><?php echo __('Outgoing Connection Requests You Have Made'); ?></h4>
    <?php if (!empty($connectionsOutgoing)): ?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('Connection Owner'); ?></th>
        <th><?php echo __('Connection Recipient'); ?></th>
        <th><?php echo __('Connection Type'); ?></th>
        <!-- th><?php //echo __('Verified'); ?></th -->
        <th><?php echo __('Message'); ?></th>
        <!-- th><?php // echo __('Created'); ?></th -->
        <!-- th><?php // echo __('Modified'); ?></th -->
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($connectionsOutgoing as $connection): ?>
        <tr>
            <td><?php echo $connection['Connection']['id']; ?></td>
            <td><?php echo $connection['MyUser']['username']; ?></td> 
            <!-- td><?php //echo $connection['MyConnection']['username']; ?></td -->
            <td><?php echo $this->Html->link(__($connection['MyConnection']['username']), array('controller' => 'users', 'action' => 'view', $connection['MyConnection']['id'])); ?></td>
            <td><?php echo $connection['Connection']['connection_type']; ?></td>
            <!-- td><?php //echo $connection['Connection']['verified']; ?></td -->
            <td><?php echo $connection['Connection']['message']; ?></td>
            <!-- td><?php // echo $connection['Connection']['created']; ?></td -->
            <!-- td><?php // echo $connection['Connection']['modified']; ?></td -->
            <td class="actions">
                <?php // echo $this->Html->link(__('Verify'), array('controller' => 'connections', 'action' => 'verify', $connection['Connection']['id'])); ?>
                <?php echo $this->Html->link(__('View'), array('controller' => 'connections', 'action' => 'view', $connection['Connection']['id'])); ?>
                <?php echo $this->Html->link(__('Edit'), array('controller' => 'connections', 'action' => 'edit', $connection['Connection']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'connections', 'action' => 'delete', $connection['Connection']['id']), array(), __('Are you sure you want to delete # %s?', $connection['Connection']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php else: ?>
      <h5>You don't have any.</h5>
      <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Make a New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
        </ul>
      </div>
      <br style="clear:both"/>
    <?php endif; ?>
    <h4><?php echo __('Incomming Connection Requests For You'); ?></h4>
    <?php if (!empty($connectionsIncoming)): ?>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <th><?php echo __('Id'); ?></th>
        <th><?php echo __('Connection Owner'); ?></th>
        <th><?php echo __('Connection Recipient'); ?></th -->
        <th><?php echo __('Connection Type'); ?></th>
        <!-- th><?php //echo __('Verified'); ?></th -->
        <th><?php echo __('Message'); ?></th>
        <!-- th><?php // echo __('Created'); ?></th -->
        <!-- th><?php // echo __('Modified'); ?></th -->
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($connectionsIncoming as $connection): ?>
        <tr>
            <td><?php echo $connection['Connection']['id']; ?></td>
            <td><?php echo $this->Html->link(__($connection['MyUser']['username']), array('controller' => 'users', 'action' => 'view', $connection['MyUser']['id'])); ?></td>
            <td><?php echo $connection['MyConnection']['username']; ?></td -->
            <td><?php echo $connection['Connection']['connection_type']; ?></td>
            <!--td><?php //echo $connection['Connection']['verified']; ?></td-->
            <td><?php echo $connection['Connection']['message']; ?></td>
            <!-- td><?php // echo $connection['Connection']['created']; ?></td -->
            <!-- td><?php //echo $connection['Connection']['modified']; ?></td -->
            <td class="actions">
            <?php 
                if ( $connection['Connection']['verified'] ) {
                    echo $this->Html->link(__('Re-Verify'), array('controller' => 'connections', 'action' => 'verify', $connection['Connection']['id']));
                } else {
                    echo $this->Html->link(__('Verify'), array('controller' => 'connections', 'action' => 'verify', $connection['Connection']['id']));
                }
                ?>
                <?php echo $this->Html->link(__('View'), array('controller' => 'connections', 'action' => 'view', $connection['Connection']['id'])); ?>
                <?php //echo $this->Html->link(__('Edit'), array('controller' => 'connections', 'action' => 'edit', $connection['Connection']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'connections', 'action' => 'delete', $connection['Connection']['id']), array(), __('Are you sure you want to delete # %s?', $connection['Connection']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php else: ?>
      <h5>You don't have any.</h5>
      <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Make a New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
        </ul>
      </div>
      <br style="clear:both"/>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Connection'), array('controller' => 'connections', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>

<div class="related">
    <h2><?php echo __('Notes Inbox'); ?></h2>
    <?php if (!empty($notesIncoming)): ?>
    <h4><?php echo __('Incoming Notes For You'); ?></h4>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <!-- th><?php // echo __('Id'); ?></th -->
        <th><?php echo __('From'); ?></th>
        <th><?php echo __('Subject'); ?></th>
        <th><?php echo __('Created'); ?></th>
        <!-- th><?php // echo __('Read'); ?></th -->
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($notesIncoming as $note): ?>
        <?php 
        if ( !$note['Note']['read'] ) {
            echo "<tr class=\"unread\">";
        } else {
            echo "<tr class=\"read\">";
        }
        ?>
            <!-- td><?php //echo $note['Note']['id']; ?></td -->
            <td><?php
                if ( $note['Note']['read'] ) {
                    echo $this->Html->link(__($note['User']['username']), array('controller' => 'users', 'action' => 'view', $note['User']['id']), array('class' => 'read user')); 
                } else {
                    echo $this->Html->link(__($note['User']['username']), array('controller' => 'users', 'action' => 'view', $note['User']['id']), array('class' => 'unread user')); 
                }
                ?>
            </td>
            <td>
                <?php
                if ( $note['Note']['read'] ) {
                    echo $this->Html->link(__($note['Note']['subject']), array('controller' => 'notes', 'action' => 'view', $note['Note']['id']), array('class' => 'read subject')); 
                } else {
                    echo $this->Html->link(__($note['Note']['subject']), array('controller' => 'notes', 'action' => 'view', $note['Note']['id']), array('class' => 'unread subject')); 
                }
                ?>
            </td>
            <td><?php echo $note['Note']['created']; ?></td>
            <!-- td><?php //echo $note['Note']['read']; ?></td -->
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'notes', 'action' => 'view', $note['Note']['id'])); ?>
                <?php echo $this->Html->link(__('Reply'), array('controller' => 'notes', 'action' => 'reply', $note['Note']['id'])); ?>
                <?php 
                if ( $note['Note']['read'] ) {
                    echo $this->Html->link(__('Mark Read'), array('controller' => 'notes', 'action' => 'mark_read', $note['Note']['id']), array('class' => 'mark_read hide')); 
                    echo $this->Html->link(__('Mark Unread'), array('controller' => 'notes', 'action' => 'mark_unread', $note['Note']['id']), array('class' => 'mark_unread ')); 
                } else {
                    echo $this->Html->link(__('Mark Read'), array('controller' => 'notes', 'action' => 'mark_read', $note['Note']['id']), array('class' => 'mark_read ')); 
                    echo $this->Html->link(__('Mark Unread'), array('controller' => 'notes', 'action' => 'mark_unread', $note['Note']['id']), array('class' => 'mark_unread hide')); 
                }
                ?>
                <?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['Note']['id']), array('class' => 'delete'), __('Are you sure you want to delete note \'%s\'?', $note['Note']['subject'])); ?>
                <?php echo $this->Html->link(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['Note']['id']), array('class' => 'delete')); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <h2><?php echo __('Notes Outbox'); ?></h2>
    <?php if (!empty($notesOutgoing)): ?>
    <h4><?php echo __('Notes you have sent'); ?></h4>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
        <!-- th><?php // echo __('Id'); ?></th -->
        <th><?php echo __('To'); ?></th>
        <th><?php echo __('Subject'); ?></th>
        <th><?php echo __('Sent'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($notesOutgoing as $note): ?>
        <tr>
            <!-- td><?php // echo $note['Note']['id']; ?></td -->
            <td><?php echo $this->Html->link(__($note['ToUser']['username']), array('controller' => 'users', 'action' => 'view', $note['ToUser']['id'])); ?></td>
            <td><?php echo $this->Html->link(__($note['Note']['subject']), array('controller' => 'notes', 'action' => 'view', $note['Note']['id'])); ?></td>
            <td><?php echo $note['Note']['created']; ?></td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('controller' => 'notes', 'action' => 'view', $note['Note']['id'])); ?>
                <?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['Note']['id']), array('class' => 'delete'), __('Are you sure you want to delete note \'%s\'?', $note['Note']['subject'])); ?>
                <?php echo $this->Html->link(__('Delete'), array('controller' => 'notes', 'action' => 'delete', $note['Note']['id']), array('class' => 'delete')); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php endif; ?>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Note'), array('controller' => 'notes', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
