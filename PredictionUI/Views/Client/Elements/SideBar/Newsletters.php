<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
    <h3 class="section-title">Newsletters</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <p>Sign Up for Our Newsletter!</p>
        <form id="subscribe-form">
            <div class="form-group">
                <label class="sr-only" for="SubscriberEmail">Email address</label>
                <input type="email" class="form-control" id="SubscriberEmail" name="SubscriberEmail" placeholder="Subscribe to our newsletter">
            </div>
            <button class="btn btn-primary">Subscribe</button>
        </form>
    </div>
    <!-- /.sidebar-widget-body -->
</div>

<script>
    $(document).ready(function() {
        bluetech.initSubscribe();
    });
</script>