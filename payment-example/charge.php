<?php
extract($_REQUEST);
//Get Charge by id
function getCharge($id){
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.tap.company/v2/charges/".$id."",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "{}",
    CURLOPT_HTTPHEADER => array(
        "authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        $data=json_decode($response,true);

        switch (strtoupper($data['status'])) {
            case 'INITIATED':
                //customer should be redirected to this url in order to complete the payment.
                $url = $data['transaction']['url'];
                echo $url;
                header("Location: ".$url);
                break;

            case 'CAPTURED ':
                //Amount got charged successfully.
                header("Location: index.php?charged=d");
                break;    
            
            default:
                //Payment got failed.
                header("Location: index.php?charged=f");
                break;
        }

    }

}

if(isset($charge)) {
    getCharge($charge);
}

if(isset($tapToken)) {
    $curl = curl_init();

    //create charge
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.tap.company/v2/charges",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"amount\":1,\"currency\":\"".$currency."\",
        \"threeDSecure\":true,\"save_card\":false,\"description\":\"Description\",
        \"statement_descriptor\":\"Sample\",\"reference\":{\"transaction\":\"txn_0001\",\"order\":\"ord_0001\"},
        \"receipt\":{\"email\":false,\"sms\":true},\"redirect\":{\"url\":\"charge.php\"},
        \"customer\":{\"first_name\":\"".$first."\",\"last_name\":\"".$last."\",\"email\":\"".$email."\",
            \"phone\":{\"country_code\":\"".$c_code."\",\"number\":\"".$phone."\"}},
        \"source\":{\"id\":\"".$tapToken."\"}}",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
        die();
    } else {
        $data=json_decode($response,true);
        getCharge($data['id']);
    }   

}  



?>