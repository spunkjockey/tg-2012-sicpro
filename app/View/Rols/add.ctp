<!-- File: /app/View/Rols/add.ctp -->

<h1>Agregar Roles</h1>
<?php
echo $this->Form->create('Rol');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
?>