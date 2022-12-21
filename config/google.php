<?php
require_once("vendor/google/apiclient-services/autoload.php");
$gClient = new Google\Client();
$gClient->setClientId("128720067234-kktk2bauu38r83evmac9dl6b3u3dsgte.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Login with google");
$gClient->setRedirectUri("http://localhost/JavaScript/php/index.php?option=google");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/admin.directory.user https://www.googleapis.com/auth/plus.login");
$gClient->setScopes(array('https://www.googleapis.com/auth/analytics.readonly', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'));
$login_url = $gClient->createAuthUrl();
