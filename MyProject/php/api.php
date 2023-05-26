<?php

//Aufruf erfolgt: "http://localhost/MyProject/php/api/" => .htaccess - Datei

//http://localhost/MyProject/php/api/product/list => gibt eine Liste aller produkte zurück
//http://localhost/MyProject/php/api/category/list => gibt eine Liste aller category zurück
//http://localhost/MyProject/php/api/products/9 - outcome aller Detailinformationen des Produkts mit ID 1 inkl. der Kat
//http://localhost/MyProject/php/api/category/9/products - outcome aller Produkte die zu der Kategorie mit ID 1 gehören (wie liste)


use MyProject\php\cat\Mysql;
use MyProject\php\cat\row\Category;
use MyProject\php\cat\Prod;
use MyProject\php\cat\Cats;

use MyProject\php\cat\Validate;


require "setup.php"; 

header("Content-Type: application/json");

function fehler($message) {
  header("HTTP/1.1 404 Not Found");
  echo json_encode(array(
    "status" => 0,
    "error" => $message
  ));
  exit;
}

// GET-Parameter aus request_uri entfernen
$request_uri_ohne_get = explode("?", $_SERVER["REQUEST_URI"])[0];
// Aus Anfrage-URI die gewünschte Methode ermitteln
$teile = explode("/api/", $request_uri_ohne_get, 2);
$parameter = explode("/", $teile[1]);

// Leere Einträge aus Parameter-Array entfernen
foreach ($parameter as $k => $v) {
  if (empty($v)) {
    unset($parameter[$k]);
  } else {
    // Alle Parameter in Kleinbuchstaben umwandeln, falls diese falsch daherkommen
    $parameter[$k] = mb_strtolower($v);
  }
}
// Indizes neu zuordnen falls mit doppelten Schrägstrichen aufgerufen wird
$parameter = array_values($parameter);
$db = Mysql::getInstance();


if (empty($parameter)) {
  fehler("Nach der Version wurde keine Methode übergeben. Prüfen Sie Ihren Aufruf!");
}

// Ab hier ist in $parameter[0] immer die Hauptmethode drin,
// in $parameter[1], etc. die genauere Spezifizierung was angefragt wurde
if ($parameter[0] == "product") { 
  if($parameter[1] == "list") { 
    $outcome = array (
      "status" => 1,
      "result" => array()
    );

    $result = $db->query("SELECT * FROM product ");
    while ($row = mysqli_fetch_assoc($result)) {
      $outcome["result"][] = $row;
    }
      echo json_encode($outcome);
      exit;
  } elseif (!empty($parameter[1])) {
    $sql_product_id = $db->escape($parameter[1]);
    $result = $db->query("SELECT * FROM product JOIN category ON product.cat_id = category.id WHERE product.id = '{$sql_product_id}' ");
    $outcome = array (
      "status" => 1,
      "result" => array()
    );
    while ($row = mysqli_fetch_assoc($result)) {
      $outcome["result"][] = $row;
    }
      echo json_encode($outcome);
      exit;
  } 
}
    if ($parameter[0] == "category") {
      if ($parameter[1] == "list") {
          $outcome = array(
              "status" => 1,
              "result" => array()
          );
  
          $result = $db->query("SELECT * FROM category");
          while ($row = mysqli_fetch_assoc($result)) {
              $outcome["result"][] = $row;
          }
          echo json_encode($outcome);
          exit;
      } elseif (!empty($parameter[2]) && $parameter[2] == "product") {
          $sql_category_id = $db->escape($parameter[1]);
          $result = $db->query("SELECT * FROM product WHERE cat_id = '{$sql_category_id}'");
          $outcome = array(
              "status" => 1,
              "result" => array()
          );
          while ($row = mysqli_fetch_assoc($result)) {
              $outcome["result"][] = $row;
          }
          echo json_encode($outcome);
          exit;

      } elseif (!empty($parameter[1])) {
          $sql_category_id = $db->escape($parameter[1]);
          $result = $db->query("SELECT * FROM category WHERE id = '{$sql_category_id}'");
          $outcome = array(
              "status" => 1,
              "result" => array()
          );
          while ($row = mysqli_fetch_assoc($result)) {
              $outcome["result"][] = $row;
          }
          echo json_encode($outcome);
          exit;
      }
  }
  
  





    
    
    


//   } elseif (!empty($parameter[2]) && $parameter[2] == "product") {
//     $sql_product_id = $db->escape($parameter[1]);
//     $result = $db->query("SELECT * FROM product JOIN category ON product.cat_id = category.id WHERE product.id = '{$sql_product_id}'");
//     $outcome = array(
//       "status" => 1,
//       "result" => array()
//     );
//     while ($row = mysqli_fetch_assoc($result)) {
//       $outcome["result"][] = $row;
//     }
//     echo json_encode($outcome);
//     exit;
//   }
// } 
    
    
//     //elseif ($parameter[0] == "category" && !empty($parameter[1]) && $parameter[2] == "product") {
//     $sql_category_id = $db->escape($parameter[1]);

//     $outcome = array(
//       "status" => 1,
//       "result" => array()
//     );

//     $result = $db->query("SELECT * FROM product WHERE cat_id = '{$sql_category_id}'");
//     while ($row = mysqli_fetch_assoc($result)) {
//       $outcome["result"][] = $row;
//     };

//     echo json_encode($outcome);
//     exit;
//   }
// }


  
//     } elseif (!empty($parameter[2]) && ($parameter[2] == "product")) {
//         $sql_product_id = $db->escape($parameter[2]);
//         $result = $db->query("SELECT * FROM product WHERE cat_id = '{$sql_category_id}");
//         $outcome = array (
//           "status" => 1,
//           "result" => array()
//         );
//         while ($row = mysqli_fetch_assoc($result)) {
//           $outcome["result"][] = $row;
//         }
//           echo json_encode($outcome);
//           exit;
//       } 
  




