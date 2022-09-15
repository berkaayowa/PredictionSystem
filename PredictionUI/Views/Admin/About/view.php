<?php $data = $template_data['abou'][0]; ?>

<h2 style="margin-top: 0;text-transform: capitalize;">Viewing abou</h2>
<form >
	
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="ID">i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="ID" id="ID" value="<?=$data["ID"]?>" placeholder="i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Title">title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Title" id="Title" value="<?=$data["Title"]?>" placeholder="title">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Content">content</label>
        <div class="col-sm-10">
            <textarea data-editor="true" rows="10" class="form-control " name="Content" id="Content" placeholder="content"><?=$data["Content"]?></textarea>
        </div>
    </div>
        
	<input type="hidden" name="ID" value="<?=$data['ID']?>">
	<a href="/about" class="btn btn-primary">Go Back</a>
</form>