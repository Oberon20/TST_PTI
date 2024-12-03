<?php

require "vendor/autoload.php";
require "Resi.php";

// Generate WSDL file
$gen = new \PHP2WSDL\PHPClass2WSDL("Resi", "http://localhost/soaprecon/dns/server.php");
$gen->generateWSDL();
file_put_contents("resi.wsdl", $gen->dump());
echo "WSDL selesai dibuat!";
