<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
    <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellidos');
        echo $this->Form->input('idrol', array(
            'options' => array(4 => 'Adminsys', 9 => 'Master')
        ));
		echo $this->Form->input('estado', array(
            'options' => array(1 => 'Habilitado', 0 => 'Deshabilitado')
        ));
		echo $this->Form->input('modified',array('type'=>'hidden','value'=>null));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>