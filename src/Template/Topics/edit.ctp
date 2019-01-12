<!-- File: src/Template/Topics/edit.ctp -->

<h1>Edit Topic</h1> 
<?php
    echo $this->Form->create($topic);
    echo $this->Form->input('title');
    echo $this->Form->input('content', ['rows' => '3']);
    echo $this->Form->input('tags');	
    echo $this->Form->input('author');	
    echo $this->Form->button(__('Save Topic'));
    echo $this->Form->end();
?>