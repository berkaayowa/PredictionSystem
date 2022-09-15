<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Auto genating Files
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?= BerkaPhp\Helper\Html::action('/generators/file/')?>" style="margin-bottom: 20px;margin-top: 0;">
                            <label class="form-label">Select Table To generate Element for</label><br>
                            <br/>
                            <select class="form-control selectpicker" name="table">
                                <option>---</option>
                                <?php foreach ($template_data['tables'] as $table => $name  ): ?>
                                    <option value="<?=$name?>" ><?=$name?></option>
                                <?php endforeach ?>
                            </select><br>
                            <h4>Select Element/s To Generate</h4>
                            <div class="funkyradio">
                                <div class="funkyradio-default" style="width: 133px;">
                                    <input type="checkbox" name="model" id="checkbox1"/>
                                    <label for="checkbox1">Model</label>
                                </div>
                                <div class="funkyradio-default" style="width: 133px;">
                                    <input type="checkbox" name="views" id="checkbox2"/>
                                    <label for="checkbox2">Views</label>
                                </div>
                                <div class="funkyradio-default" style="width: 133px;">
                                    <input type="checkbox" name="controller" id="checkbox3"/>
                                    <label for="checkbox3">Controller</label>
                                </div>
                                <div class="funkyradio-default" style="width: 133px;">
                                    <input type="checkbox" name="all" id="checkbox4"/>
                                    <label for="checkbox4">All</label>
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-primary" style="width: 133px;">Generate</button>
                            <br/>
                            <br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
