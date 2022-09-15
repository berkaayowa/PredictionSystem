

<div class="row">
    <div class="col-sm-12">
        <div class="box  box-default">
            <div class="box-header btn-brd">
                <h2>Seamless integration and communication</h2>
                <p>
                    I-Send provide you with the messaging solutions that you require by enabling you to get your messages to the right customers, at the
                    right time all from one system. Join I-Send’s secure global network to reliably send notification messages to your customers, expand to include a response from your customers and begin to adopt Chat
                </p>

            </div>
            <div class="box-body">
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#php">
                                PHP send request Sample
                            </a>
                        </li>
                        <li >
                            <a data-toggle="tab" href="#csharp">
                                C# send request Samples
                            </a>
                        </li>

                        <li class="hide">
                            <a data-toggle="tab" href="#java">
                                JAVA send request Samples
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content section-tab">
                        <div id="php" class="tab-pane fade in active">

                            <div class="sample">
                                $data = array(
                                    'message'=>'hello',
                                    'destination'=>'+27717253114',
                                    'authkey'=>'0a971597663950629552b8d57813erf'
                                );
                                <br/>
                                <br/>
                                $data_json = json_encode($data);<br/>
                                $ch = curl_init();<br/>
                                curl_setopt($ch, CURLOPT_URL, 'http://api.softclicktech.com/sms/request/send');<br/>
                                curl_setopt($ch, CURLOPT_HTTPHEADER);<br/>
                                curl_setopt($ch, CURLOPT_POST, 1);<br/>
                                curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);<br/>
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);<br/>
                                <br/>
                                $response  = curl_exec($ch);<br/>
                                $response = json_decode($response);<br/>
                                <br/>
                                curl_close($ch);<br/>
                            </div>

                        </div>

                        <div id="csharp" class="tab-pane">
                            <div class="sample">
                                var data = new Dictionary< string, string ><br/>
                                {<br/>
                                    { "message", "hello" },<br/>
                                    { "destination", "+27747253114" },<br/>
                                    { "authkey", "0a971597663950629552b8d57813erf" }<br/>
                                };<br/>
                                <br/>
                                HttpClient client = new HttpClient();<br/>
                                var content = new FormUrlEncodedContent(data);<br/>

                                var response = await client.PostAsync("http://api.softclicktech.com/sms/request/send", content);<br/>

                                JObject json = JObject.Parse(response.Content.ReadAsStringAsync().Result);<br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
