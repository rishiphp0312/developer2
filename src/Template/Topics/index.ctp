<!-- $this->Html is the form helper object that contain code snippets for html elements like forms,links,etc
	link() method generate html link
 -->
<h1>Blog topics</h1>
<p><?= $this->Html->link('Add Topic', ['action' => 'add']) ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>

<!-- Here's where we loop through our $topics query object, printing out topic info -->

    <?php foreach ($topics as $topic): ?>
    <tr>
        <td><?= $topic->id ?></td>
        <td>
            <?= $this->Html->link($topic->title, ['action' => 'view', $topic->id]) ?>
        </td>
        <td>
            <?= $topic->created->format(DATE_RFC850) ?>
        </td>
        <td>
            <?= $this->Form->postLink(
                'Delete',
                ['action' => 'delete', $topic->id],
                ['confirm' => 'Are you sure?'])
            ?>
            <?= $this->Html->link('Edit', ['action' => 'edit', $topic->id]) ?>
        </td>
    </tr>
    <?php endforeach; ?>
	<tr>
	<?php  if ($this->request->session()->read('Auth.User')){ ?>
		<td> <?=$this->Html->Link(__('Log out'),['controller'=>'users','action'=>'logout']) ?>  </td>
	<?php }else{  ?>
		<td> <?=$this->Html->Link(__('Login'),['controller'=>'users','action'=>'login']) ?>  </td>	
	<?php } ?>
	
	</tr>
</table>