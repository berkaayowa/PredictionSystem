<?php


$paths = array(

    "route"=>[

        "BerkaPhp/Router/Dispatcher/",
        "Config/Route/",
        "BerkaPhp/Framework/Config/Route/",
    ],

    "errors"=> [
        "Config/Redirect/",
        "BerkaPhp/Error/"
    ],

    "Resource"=> [
        "Resources/label/"
    ],

    "database"=> [
        "BerkaPhp/Database/",
        "BerkaPhp/ThirdParty/"
    ],

    "baseViews"=> [
        "BerkaPhp/View/"
    ],

    "controllers"=> [
        "BerkaPhp/Controller/",
        "BerkaPhp/Framework/Controllers/Framework/",
        "Controllers/Client/",
        "Controllers/Base/",
        "Controllers/Job/",
        "Controllers/Email/",
        "Controllers/Sms/",
        "Controllers/Admin/"

    ],

    "components"=> [
        "BerkaPhp/Controller/Components/",
        "Controllers/Components/",
        "Controllers/Components/ComponentFiles/Email/",
        "Controllers/Components/ComponentFiles/PayFast/",
        "Controllers/Components/ComponentFiles/PayPal/"
    ],

    "model"=> [
        "BerkaPhp/Model/",
        "Models/"
    ],

    "views"=> [
        "BerkaPhp/Template/"
    ],

    "helpers"=> [
        "BerkaPhp/Helper/",
        "Util/"
    ]
);

function getDirContents($dir){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            require_once($path);
        } else if($value != "." && $value != "..") {
            getDirContents($path);
        }
    }

}

?>


<?php

foreach($paths as $path) {
    foreach($path as $fileInfo => $filePath) {
        foreach (glob($filePath."*.php") as $filename)
        {
            if(file_exists($filename)) {
               // echo $filename .'<br>';
                require_once($filename);
            } else {

            }


        }
    }
}

?>

