<div class="panel">
    <div class="panel-body">
        <div class="col-sm-12 col-md-8 col-lg-8 no-padding">
            <form class="form-vertical">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="" for="email">Start Date</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" name="StartDate" value="<?=$data["StartDate"]?>" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="" for="email">End Date</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" name="EndDate" value="<?=$data["EndDate"]?> "/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="" for="email">Category</label>
                        <input type="text" class="form-control" id="email" value="<?=$data["TypeName"]?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="" for="email">State</label>
                        <input type="text" class="form-control" id="email" value="<?=$data["StateName"]?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="" for="email">Repository</label>
                        <input type="text" class="form-control" id="email" value="<?=$data["Repository"]?>">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="" for="email">Test Url</label>
                        <input type="text" class="form-control" id="email" value="<?=$data["StagingUrl"]?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 no-padding-right">
            <div class="col-sm-12">
                <form class="form-vertical">
                    <div class="form-group">
                        <label class="" for="email">Name</label>
                        <input type="text" class="form-control" id="email" value="<?=$data["FirstName"]?>">
                    </div>
                    <div class="form-group">
                        <label class="" for="pwd">Email</label>
                        <input type="text" class="form-control" id="email"  value="<?=$data["Email"]?>">
                    </div>
                    <div class="form-group">
                        <label class="" for="pwd">Skype</label>
                        <input type="text" class="form-control" id="email"  value="<?=$data["Email"]?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>