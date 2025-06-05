<html>
    <head>
        <?php
//date_default_timezone_set('Asia/Kolkata');
        include 'function.php';

        /*
          Merchant has to enter the Merchant Id shared by 1Pay in the below variable 'merchantId' and pass in the Request along with encrypted Request Data.
          Merchant has to enter the API Key shared by 1Pay to Encrypt/Decrypr the Transaction Request/Response.
          Algorithm used for encryption is AES.
          Merchant Encryption Key will be different for TEST and PRODUCTION environment.
         */
        $merchantId = $_POST['merchantId'];
        $data['merchantId'] = $_POST['merchantId'];
        $data['apiKey'] = $_POST['apiKey'];
        $data['txnId'] = $_POST['txnId'];
        $data['amount'] = $_POST['amount'];
        $data['dateTime'] = date('Y-m-d h:i:s');
        $data['custMail'] = $_POST['custMail'];
        $data['custMobile'] = $_POST['custMobile'];
        $data['udf1'] = $_POST['udf1'];
        $data['udf2'] = $_POST['udf2'];
        $data['returnURL'] = $_POST['returnURL'];
        $data['productId'] = $_POST['productId'];
        $data['channelId'] = $_POST['channelId'];
        $data['isMultiSettlement'] = $_POST['isMultiSettlement'];
        $data['txnType'] = $_POST['txnType'];
        $data['instrumentId'] = $_POST['instrumentId'];
        $data['udf3'] = $_POST['udf3'];
        $data['udf4'] = $_POST['udf4'];
        $data['udf5'] = $_POST['udf5'];
        $data['cardDetails'] = $_POST['cardDetails'];
        $data['cardType'] = $_POST['cardType'];
        $jsondata = json_encode($data);
        $enc = get_encrypt($jsondata);


        //add the Transaction Posting URL
        $url = 'http://139.59.1.254:8080/onepayVAS/payprocessor';
        $myvars = "merchantId=" . $merchantId . "&reqData=" . $enc;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        ?>
        <script type="text/javascript">
            function redirectRequest() {
                document.myform.submit();
            }
        </script>
    </head>
    <body onload="redirectRequest();">
        <form name="myform" method="post" action="http://139.59.1.254:8080/onepayVAS/payprocessor">

            <input type="hidden" name="merchantId" value="<?php echo $merchantId; ?>">;
            <input type="hidden" name="reqData" value="<?php echo $enc; ?>">;


        </form>
    </body>
</html>
