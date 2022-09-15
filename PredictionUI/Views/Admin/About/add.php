<br/>
<br/>
<br/>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h3>New abou</h3></div>
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/about/add')?>" enctype="multipart/form-data">
        <div class="panel-body">
               
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="ID">i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="ID" id="ID" placeholder="i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Title">title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Title" id="Title" placeholder="title">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Content">content</label>
        <div class="col-sm-10">
            <textarea data-editor="true" rows="10" class="form-control " name="Content" id="Content" placeholder="content"></textarea>
        </div>
    </div>
        
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>