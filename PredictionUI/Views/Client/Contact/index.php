<div class="box  box-default">
    <div class="box-body">
        <div class="containerMain ">
                <div class="probootstrap-section-heading text-center mb50 probootstrap-animate">
                    <h4 class="sub-heading">Get In Touch</h4>
                    <h2 class="heading">Let's Chat</h2>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <form data-toggle="validator" action="#" method="post" class="probootstrap-form mb60">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input required type="text" class="form-control" id="fname" name="fname">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input required type="text" class="form-control" id="lname" name="lname">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" required class="form-control" id="email" name="email">
                            </div>
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
                        <h4>Contact Information</h4>
                        <ul class="with-icon colored">
                            <li><i class="icon-location2"></i> <span><?=$contacts->physicalAddress?></span></li>
                            <li><i class="icon-mail"></i><span><?=$contacts->email?></span></li>
                            <li><i class="icon-phone2"></i><span><?=$contacts->mobileNumber?></span></li>
                        </ul>

                        <h4>Feedback</h4>
                        <p><?=$contacts->feedback?></p>
                        <p><a href="/aboutus">Learn More</a></p>
                    </div>
                </div>
            </div>
    </div>
</div>
