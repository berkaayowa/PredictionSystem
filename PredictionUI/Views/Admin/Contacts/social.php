<?php $data = $template_data['contact'][0]; ?>
<div class="row text-right">
    <div class="col-sm-12 col-md-12 col-lg-12 ">
        <div class="btn-group">
            <a  class="mb-0" href="<?= BerkaPhp\Helper\Html::action('/banners')?>">
                <button type="button" class="btn btn-default">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </button>
            </a>
        </div>
    </div>
</div>

<div class="">
    <div class="panel panel-default">
        <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/contacts/edit/'.$data['ID'])?>" enctype="multipart/form-data">
        <div class="panel-body">

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Facebook">facebook</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Facebook" id="Facebook" value="<?=$data["Facebook"]?>" placeholder="facebook">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Twitter">twitter</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Twitter" id="Twitter" value="<?=$data["Twitter"]?>" placeholder="twitter">
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="Whatsapp">Whatsapp</label>
            <div class="col-sm-12">
                <input type="text" class="form-control " name="Whatsapp" id="Whatsapp" value="<?=$data["Whatsapp"]?>" >
            </div>
        </div>


        <div class="form-group row">
            <label class="control-label brk-php-label col-sm-12" for="GoogleMap">google map</label>
            <div class="col-sm-12">
                <textarea rows="5" class="form-control " name="GoogleMap" id="GoogleMap" placeholder="google map"><?=$data["GoogleMap"]?></textarea>
            </div>
        </div>

            </div>
            <div class="panel-footer">
                <input type="hidden" name="ID" value="<?=$data['ID']?>">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div
