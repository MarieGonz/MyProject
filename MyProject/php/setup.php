<?php

// Konfiguration für das Projekt
const MYSQL_HOST = "localhost";
const MYSQL_USER = "root"; 
const MYSQL_PASSWORD = "";
const MYSQL_DATABASE = "Myproject";

// Setup-Code: Nur verändern wenn du weißt, was du tust.
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

spl_autoload_register(
    function(string $class) {
        // Projekt-spezifisches namespace prefix
        $prefix = "MyProject\\php";
 

        // Basisverzeichnis für das namespace prefix
        $basis = __DIR__ .  "/";
    

        // Wenn die Klasse das prefix nicht verwendet, abbrechen
        $len = strlen($prefix);
        if (substr($class, 0, $len) !== $prefix) {
            return;
        }

        // Klasse ohne Prefix
        $relativ = substr($class, $len);

        // Dateipfad erstellen
        $file = $basis . str_replace("\\", "/", $relativ) . ".php";
 
        // Wenn die Datei existiert, einbinden.
        if (file_exists($file)) {
            include $file;
        }
    }
);

function is_logged_in() {
    if ( empty($_SESSION["loggedin"]) ) {
        header("Location: myaccount.php");
        exit;
    }
}