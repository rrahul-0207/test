<?php

error_reporting(0);
require_once( "assets/import/hybridauth/hybridauth/Hybrid/Auth.php" );
require_once( "assets/import/hybridauth/hybridauth/Hybrid/Endpoint.php" );
require_once('assets/import/hybridauth/vendor/autoload.php');
Hybrid_Endpoint::process();