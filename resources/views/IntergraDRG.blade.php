<?php
    $soapURL = "https://iagwebservice.sigquali.com.br/iagwebservice/importaInternacao?wsdl";

    $soapUser = "2827-import";
    $soapPassword = "ZNTevMwD";

    // Xml post structure

    $xml_post_string = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.iagwebservice.sigquali.com.br/">
                       <soapenv:Header/>
                       <soapenv:Body>
                          <ser:importaInternacao>
                             <!--Optional:-->
                             <xml>?</xml>
                             <!--Optional:-->
                             <usuarioIAG>'.$soapUser.'</usuarioIAG>
                             <!--Optional:-->
                             <senhaIAG>'.$soapPassword.'</senhaIAG>
                          </ser:importaInternacao>
                       </soapenv:Body>
                    </soapenv:Envelope>';

    // Headers -  data from the form
    $headers = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "SOAPAction: https://iagwebservice.sigquali.com.br:80/iagwebservice/importaInternacao",
        "Content-length: ".strlen($xml_post_string),
    );

    //SOAPAction: your OP URL
    $url = $soapURL;

    //PHP cURL for https connection with auth

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $soapUser.":".$soapPassword);
    // username and password - declared at the top of the doc
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
    // The SOAP request
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // converting
    $response = curl_exec($ch);
    curl_close($ch);

    new SoapClient()
    echo $response;

