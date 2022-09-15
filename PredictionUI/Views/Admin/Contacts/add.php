<br/>
<br/>
<br/>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h3>New contact</h3></div>
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/contacts/add')?>" enctype="multipart/form-data">
        <div class="panel-body">
               
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="ID">i d</label>
        <div class="col-sm-10">
            <input type="number" class="form-control " name="ID" id="ID" placeholder="i d">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="PrimaryEmail">primary email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="PrimaryEmail" id="PrimaryEmail" placeholder="primary email">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="SecondaryEmail">secondary email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="SecondaryEmail" id="SecondaryEmail" placeholder="secondary email">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="PrimaryTell">primary tell</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="PrimaryTell" id="PrimaryTell" placeholder="primary tell">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="SecondaryTell">secondary tell</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="SecondaryTell" id="SecondaryTell" placeholder="secondary tell">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Fax">fax</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Fax" id="Fax" placeholder="fax">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="PhysicalAddress">physical address</label>
        <div class="col-sm-10">
            <textarea data-editor="true" rows="10" class="form-control " name="PhysicalAddress" id="PhysicalAddress" placeholder="physical address"></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Facebook">facebook</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Facebook" id="Facebook" placeholder="facebook">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Twitter">twitter</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Twitter" id="Twitter" placeholder="twitter">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="MapLongitude">map longitude</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="MapLongitude" id="MapLongitude" placeholder="map longitude">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="Maplatitude">maplatitude</label>
        <div class="col-sm-10">
            <input type="text" class="form-control " name="Maplatitude" id="Maplatitude" placeholder="maplatitude">
        </div>
    </div>
        
    <div class="form-group row">
        <label class="control-label brk-php-label col-sm-2" for="GoogleMap">google map</label>
        <div class="col-sm-10">
            <textarea data-editor="true" rows="10" class="form-control " name="GoogleMap" id="GoogleMap" placeholder="google map"></textarea>
        </div>
    </div>
        
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>