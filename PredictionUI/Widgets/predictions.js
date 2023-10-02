function createFrame() {

    var ifrm = document.createElement("iframe");
    var source = window.location.host;
    var url = window.location.href;
    ifrm.setAttribute("src", "https://soccerprediction.co.za/pages/prediction_widget?source=" + source + "&url=" + url);
    ifrm.setAttribute("title", "Soccer Predictions");

    ifrm.style.width = "100%";
    ifrm.style.height = "100%";

    document.getElementById("predictionHolder").appendChild(ifrm)

}

createFrame();