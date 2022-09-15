<section class="panel tasks-widget no-margin">
    <header class="panel-heading">
    </header>
    <div class="panel-body">
        <div class=" add-task-row">
            <a class="btn btn-success btn-sm pull-left" href="#" <?= \BerkaPhp\HelperModel::openButton('newTaskModel') ?>>Add New Tasks</a>
            <a class="btn btn-default btn-sm pull-right" panel="groupTasks" data-ajax="/admin/tasks/project/<?=$data['ProjectID']?>">See All Tasks</a>
        </div>
    </div>
</section>

<div class="panel panel-default list-group-panel no-margin" id="groupTasks">

</div>

<?php
    $modelData = \BerkaPhp\HelperForm::Create(array(
        ['type'=>"hidden", 'id'=>"AuthID", 'value'=>\BerkaPhp\Helper\Auth::GetActiveUser(true,'UserID')],
        ['type'=>"hidden", 'id'=>"RefProjectID", 'value'=>$data['ProjectID']],
        ['type'=>"text", 'id'=>"TaskName", 'placeholder'=>"Enter task name", 'caption'=>'Task'],
        ['type'=>"text", 'id'=>"RefCatID", 'caption'=>'category', 'data-value'=>'CatID', 'data-text'=>'CatName','data-type'=>'Taskcategories', 'data-select'=>true],
        ['type'=>"text", 'id'=>"tes", 'caption'=>'category', 'data-value'=>'ID', 'data-text'=>'Name','data-type'=>'Services', 'data-select'=>true],
        ['type'=>"textarea", 'id'=>"TaskDescription", 'placeholder'=>"Enter description", 'caption'=>'Description','rows'=>'7']
    ), array('text'=>'Save task', 'id'=>'newtask'))
?>

<?= \BerkaPhp\HelperModel::Create(['id' => 'newTaskModel', 'title'=>'New Task', 'content'=>$modelData], false) ?>

