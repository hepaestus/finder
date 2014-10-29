<div class="interests form">
    <!-- pre>
    <?php //echo print_r($activities,1); ?>
    </pre -->
    <!-- pre>
    <?php //echo print_r($interests,1); ?>
    </pre -->
    <?php echo $this->Form->create('Interest'); ?>
    <fieldset>
        <legend><?php echo __('Add Interests'); ?></legend>
        <table>
            <tr>
                <th>Name</th>
                <th>Interested</th>
                <th>Giving</th>
                <th>Recieving</th>
                <th>Importance</th>
                <th>Experience</th>
            </tr>
<?php
$activity_count = 0;
foreach ($activities as $activity ) {
    echo "<tr>\n";
    echo "<td>";
    echo $this->Html->link(__($activity['Activity']['name']), array('action' => 'view', $activity['Activity']['id']));
    echo "</td>\n";
    echo "<td>";
    echo $this->Form->checkbox('Interest.' . $activity_count . '.activity_id', array('value' => $activity['Activity']['id'],'hiddenField' => false));
    echo $this->Form->label('Yes Please');
    echo "</td>\n";
    echo "<td>" . $this->Form->checkbox('Interest.' . $activity_count . '.giving') . "</td>\n";
    echo "<td>" . $this->Form->checkbox('Interest.' . $activity_count . '.recieving') . "</td>\n";
    echo "<td>" . $this->Form->input('Interest.' . $activity_count . '.importance', array('options' => array(1,2,3,4,5), 'empty' => '')) . "</td>\n";
    echo "<td>" . $this->Form->input('Interest.' . $activity_count . '.experience', array('options' => array(0,1,2,3,4,5,6,7,8,9,10), 'empty' => '')) . "</td>\n";
    echo "</tr>\n";
    ++$activity_count;
}
?>
</table>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('List Interests'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
    </ul>
</div>
