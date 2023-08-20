<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">
                <h3 class="headerFocus">Get In Touch</h3>
                <p class="pSubHeaderx">
                    If you have any enquiry concerning about Localhost service, please email us through the following form or for advertising enquiries.
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default ">
            <div class="box-body ">

                <div class="row">
                    <div class="col-md-8">
                        <form data-toggle="validator" class="frmSearch" message="<?=Resource\Label::General("Sending your message")?>..."  request-type="POST" id="request" data-request="<?= BerkaPhp\Helper\Html::action('/contacts/index')?>">
                            <?php if(!\BerkaPhp\Helper\Auth::IsUserLogged()): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fullname">Full name</label>
                                            <input required type="text" class="form-control" id="fullname" name="fullname">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" required class="form-control" id="email" name="email">
                                </div>
                            <?php else : ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fullname">Full name</label>
                                            <input disabled value="<?= ucfirst( BerkaPhp\Helper\Auth::GetActiveUser()->name)?> <?= ucfirst( BerkaPhp\Helper\Auth::GetActiveUser()->surname)?>" required type="text" class="form-control" id="fullname" name="fullname">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" disabled required class="form-control" id="email" name="email" value="<?=BerkaPhp\Helper\Auth::GetActiveUser()->emailAddress?>">
                                </div>
                            <?php endif ?>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea required cols="30" rows="10" class="form-control" id="message" name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <input required type="submit" class="btn btn-primary" id="submit" name="submit" value="Send Message">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3 col-md-push-1">
                        <h4>Contacts Information</h4>
                        <ul class="with-icon colored">
                            <li><i class="icon-location2"></i> <span></span></li>
                            <li><i class="glyphicon glyphicon-envelope"></i> <?=EMAIL_SUPPORT?></li>
                            <li><i class="glyphicon glyphicon-envelope"></i> soccerprediction.co.za@gmail.com</li>

                            <li class="hide"><i class="icon-phone2"></i><span></span></li>
                        </ul>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

