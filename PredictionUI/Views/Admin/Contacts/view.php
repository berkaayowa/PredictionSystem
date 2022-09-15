<?php $data = $template_data['contact'][0]; ?>

<h2 style="margin-top: 0;text-transform: capitalize;">Viewing contact</h2>
<form >
	
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="ID">i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="ID" id="ID" value="<?=$data["ID"]?>" placeholder="i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="PrimaryEmail">primary email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="PrimaryEmail" id="PrimaryEmail" value="<?=$data["PrimaryEmail"]?>" placeholder="primary email">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="SecondaryEmail">secondary email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="SecondaryEmail" id="SecondaryEmail" value="<?=$data["SecondaryEmail"]?>" placeholder="secondary email">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="PrimaryTell">primary tell</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="PrimaryTell" id="PrimaryTell" value="<?=$data["PrimaryTell"]?>" placeholder="primary tell">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="SecondaryTell">secondary tell</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="SecondaryTell" id="SecondaryTell" value="<?=$data["SecondaryTell"]?>" placeholder="secondary tell">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Fax">fax</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Fax" id="Fax" value="<?=$data["Fax"]?>" placeholder="fax">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="PhysicalAddress">physical address</label>
        <div class="col-sm-10">
            <textarea data-editor="true" rows="10" class="form-control " name="PhysicalAddress" id="PhysicalAddress" placeholder="physical address"><?=$data["PhysicalAddress"]?></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Facebook">facebook</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Facebook" id="Facebook" value="<?=$data["Facebook"]?>" placeholder="facebook">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Twitter">twitter</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Twitter" id="Twitter" value="<?=$data["Twitter"]?>" placeholder="twitter">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="MapLongitude">map longitude</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="MapLongitude" id="MapLongitude" value="<?=$data["MapLongitude"]?>" placeholder="map longitude">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Maplatitude">maplatitude</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Maplatitude" id="Maplatitude" value="<?=$data["Maplatitude"]?>" placeholder="maplatitude">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="GoogleMap">google map</label>
        <div class="col-sm-10">
            <textarea data-editor="true" rows="10" class="form-control " name="GoogleMap" id="GoogleMap" placeholder="google map"><?=$data["GoogleMap"]?></textarea>
        </div>
    </div>
        
	<input type="hidden" name="ID" value="<?=$data['ID']?>">
	<a href="/contacts" class="btn btn-primary">Go Back</a>
</form>