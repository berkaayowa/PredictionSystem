<?=\BerkaPhp\Helper\Element::Render("Breadcrumb", "Client", array("breadcrumb"=>$breadcrumb))?>
<div class="box  box-default">
    <div class="box-body">
        <div class="containerMain">

            <div class="row">
                <div class="col-md-12 center">
                    <div class="error-template">
                        <h1>
                            Oops!</h1>
                        <h2>
                            401 Unauthorized Access</h2>
                        <div class="error-details">
                            You are not Unauthorized to access the requested resource!
                        </div>
                        <br>
                        <div class="error-actions">
                            <a href="/" class="btn btn-primary btn-lg"> <span class="glyphicon glyphicon-home"></span>Take Me Home </a>
                            <a href="/contacts" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Us </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
