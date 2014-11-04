<?php
/**
 * * @package app.View.Pages
 * * @since CakePHP(tm) v 0.10.0.1076
 * */
if (!Configure::read('debug')):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
    <h3><?php echo __d('cake_dev', 'Getting Started'); ?></h3>
<p>
Blah blah blah
</p>
<p>
<?php
echo $this->Html->link(
    __d('cake_dev', 'The 15 min Finder Tutorial'),
    'tutorial',
    array('target' => '_self', 'escape' => false)
);
?>
</p>
<p>
<?php
echo $this->Html->link(
    __d('cake_dev', 'Register For Finder'),
    '/users/register',
    array('target' => '_self', 'escape' => false)
);
?>
</p>
