<!-- File: /app/View/Posts/index.ctp -->

<h1>Roles</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <!-- Here is where we loop through our $roles array, printing out post info -->

    <?php foreach ($rols as $rol): ?>
    <tr>
        <td><?php echo $rol['rol']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($rol['Rol']['title'],
array('controller' => 'rols', 'action' => 'view', $rol['rol']['id'])); ?>
        </td>
        <td><?php echo $rol['Rol']['created']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>