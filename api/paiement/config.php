<?php
    $host = "http://localhost:8000";
    define("APP_ID","21322e5a9e0ad36e3df169ae222312");
    define("SECRET_KEY","4f71e0edc347872efac215ea99ba417570c9b76f");
    define("CLIENT_ID","CF21322FNXA7LS9B2MYMMQ");
    define("CLIENT_SECRET","cde1ef140f8e1809a1a40ea52770b6ce0a85045a");
    define("ENV_LINK","https://payout-gamma.cashfree.com");
    define("POST_SUBMIT_LINK","https://test.cashfree.com/billpay/checkout/post/submit");

    // define("POST_SUBMIT_LINK","https://www.cashfree.com/checkout/post/submit");
    // define("ENV_LINK","https://payout-api.cashfree.com");
    // define("APP_ID","6538488bcffedf05a898612de48356");
    // define("SECRET_KEY","fb3134ca2f65340e9fb67437764fc3214a0b9bed");
    // define("CLIENT_ID","CF65384BJTMCXV5TDV2AMM");
    // define("CLIENT_SECRET","1cae33a242192e7372f3824500d21e2846916646");

    define("RETURN_URL",$host.'/api/paiement/return.php');
    define("NOTIFY_URL",$host.'/api/paiement/notify.php');
    define('SITE_ROOT', __DIR__);
?>