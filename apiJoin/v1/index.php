<?php

require 'flight/Flight.php';

require_once 'database/db_users.php';
require_once 'env/domain.php';






Flight::route('GET /getAllLogsBySuperAdmin/', function () {




  header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom_main();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_integrations();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response = file_get_contents($sub_domain.'/crystalIntegrations/apiControlTower/v1/getAllLogsBySuperAdmin/', false, $context);
           

      curl_close($curl);




      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_main();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response2 = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getBasicInfoBySuperAdmin/', false, $context);
           

      curl_close($curl);






  
//echo $response1;
   $deco1=json_decode($response,true);
   $deco2=json_decode($response2,true);  
   // Crear el array combinado
$logs = array(
  'logs' => $deco1['logs']
);
$usuarios = array(
  'users' => $deco2['users']
);

$res = array(
  
  'logs' => $logs['logs'],
  'users' => $usuarios['users']
  
);
$arr = array_merge($logs, $usuarios);

$logs = $arr['logs'];
$users = $arr['users'];

$r1 = [];
$result = [];

foreach ($users as $user) {
    $profile = $user['profileId'];

    // Buscar los grupos con el mismo perfil
    $matchingGroups = [];
    foreach ($logs as $log) {
        if ($log['profileId'] === $profile) {
            $matchingGroups[] = $log;
        }
    }

    // Combinar los datos del usuario con cada grupo
    foreach ($matchingGroups as $log) {
        $combinedData = array_merge($log, $user);
        $result[] = $combinedData;
        array_push($r1, $combinedData);
    }
}

echo json_encode(['logs' => $r1]);



//echo json_encode($profile);
//echo json_encode($arr);}
    }
});


Flight::route('GET /getOneLogsBySuperAdmin/@profileId', function ($profileId) {




  header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom_main();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_integrations();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response = file_get_contents($sub_domain.'/crystalIntegrations/apiControlTower/v1/getOneLogsBySuperAdmin/'.$profileId, false, $context);
           

      curl_close($curl);




      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_main();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response2 = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getBasicInfoBySuperAdmin/', false, $context);
           

      curl_close($curl);






  
//echo $response1;
   $deco1=json_decode($response,true);
   $deco2=json_decode($response2,true);  
   // Crear el array combinado
$logs = array(
  'logs' => $deco1['logs']
);
$usuarios = array(
  'users' => $deco2['users']
);

$res = array(
  
  'logs' => $logs['logs'],
  'users' => $usuarios['users']
  
);
$arr = array_merge($logs, $usuarios);

$logs = $arr['logs'];
$users = $arr['users'];

$r1 = [];
$result = [];

foreach ($users as $user) {
    $profile = $user['profileId'];

    // Buscar los grupos con el mismo perfil
    $matchingGroups = [];
    foreach ($logs as $log) {
        if ($log['profileId'] === $profile) {
            $matchingGroups[] = $log;
        }
    }

    // Combinar los datos del usuario con cada grupo
    foreach ($matchingGroups as $log) {
        $combinedData = array_merge($log, $user);
        $result[] = $combinedData;
        array_push($r1, $combinedData);
    }
}

echo json_encode(['logs' => $r1]);



//echo json_encode($profile);
//echo json_encode($arr);}
    }
});



Flight::route('GET /getAllLogsByAdmin/@profileId', function ($profileId) {




  header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom_main();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_integrations();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response = file_get_contents($sub_domain.'/crystalIntegrations/apiControlTower/v1/getAllLogsByAdmin/', false, $context);
           

      curl_close($curl);




      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_main();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response2 = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getBasicInfoByAdmin/'.$profileId, false, $context);
           

      curl_close($curl);






  
//echo $response1;
   $deco1=json_decode($response,true);
   $deco2=json_decode($response2,true);  
   // Crear el array combinado
$logs = array(
  'logs' => $deco1['logs']
);
$usuarios = array(
  'users' => $deco2['users']
);

$res = array(
  
  'logs' => $logs['logs'],
  'users' => $usuarios['users']
  
);
$arr = array_merge($logs, $usuarios);

$logs = $arr['logs'];
$users = $arr['users'];

$r1 = [];
$result = [];

foreach ($users as $user) {
    $profile = $user['profileId'];

    // Buscar los grupos con el mismo perfil
    $matchingGroups = [];
    foreach ($logs as $log) {
        if ($log['profileId'] === $profile) {
            $matchingGroups[] = $log;
        }
    }

    // Combinar los datos del usuario con cada grupo
    foreach ($matchingGroups as $log) {
        $combinedData = array_merge($log, $user);
        $result[] = $combinedData;
        array_push($r1, $combinedData);
    }
}

echo json_encode(['logs' => $r1]);



//echo json_encode($profile);
//echo json_encode($arr);}
    }
});





Flight::route('GET /getOneLogsByAdmin/@profileId/@logId', function ($profileId,$logId) {




  header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom_main();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_integrations();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response = file_get_contents($sub_domain.'/crystalIntegrations/apiControlTower/v1/getOneLogsByAdmin/'.$logId, false, $context);
           

      curl_close($curl);




      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_main();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response2 = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getBasicInfoByAdmin/'.$profileId, false, $context);
           

      curl_close($curl);






  
//echo $response1;
   $deco1=json_decode($response,true);
   $deco2=json_decode($response2,true);  
   // Crear el array combinado
$logs = array(
  'logs' => $deco1['logs']
);
$usuarios = array(
  'users' => $deco2['users']
);

$res = array(
  
  'logs' => $logs['logs'],
  'users' => $usuarios['users']
  
);
$arr = array_merge($logs, $usuarios);

$logs = $arr['logs'];
$users = $arr['users'];

$r1 = [];
$result = [];

foreach ($users as $user) {
    $profile = $user['profileId'];

    // Buscar los grupos con el mismo perfil
    $matchingGroups = [];
    foreach ($logs as $log) {
        if ($log['profileId'] === $profile) {
            $matchingGroups[] = $log;
        }
    }

    // Combinar los datos del usuario con cada grupo
    foreach ($matchingGroups as $log) {
        $combinedData = array_merge($log, $user);
        $result[] = $combinedData;
        array_push($r1, $combinedData);
    }
}

echo json_encode(['logs' => $r1]);



//echo json_encode($profile);
//echo json_encode($arr);}
    }
});






Flight::route('GET /getAllTransmissionList/@profileId', function ($profileId) {




  header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom_main();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_integrations();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response = file_get_contents($sub_domain.'/crystalIntegrations/apiControlTower/v1/getAllTransmissionList/', false, $context);
           

      curl_close($curl);




      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_main();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response2 = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getBasicInfoByAdmin/'.$profileId, false, $context);
           

      curl_close($curl);






  
//echo $response1;
   $deco1=json_decode($response,true);
   $deco2=json_decode($response2,true);  
   // Crear el array combinado
$logs = array(
  'logs' => $deco1['logs']
);
$usuarios = array(
  'users' => $deco2['users']
);

$res = array(
  
  'logs' => $logs['logs'],
  'users' => $usuarios['users']
  
);
$arr = array_merge($logs, $usuarios);

$logs = $arr['logs'];
$users = $arr['users'];

$r1 = [];
$result = [];

foreach ($users as $user) {
    $profile = $user['profileId'];

    // Buscar los grupos con el mismo perfil
    $matchingGroups = [];
    foreach ($logs as $log) {
        if ($log['profileId'] === $profile) {
            $matchingGroups[] = $log;
        }
    }

    // Combinar los datos del usuario con cada grupo
    foreach ($matchingGroups as $log) {
        $combinedData = array_merge($log, $user);
        $result[] = $combinedData;
        array_push($r1, $combinedData);
    }
}

echo json_encode(['transmissionList' => $r1]);



//echo json_encode($profile);
//echo json_encode($arr);}
    }
});







Flight::route('GET /getModelInfo/@modelId', function ($modelId) {




  header("Access-Control-Allow-Origin: *");
    // Leer los encabezados
    $headers = getallheaders();
    
    // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
    if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
        // Leer los datos de la solicitud
       
        // Acceder a los encabezados
        $apiKey = $headers['Api-Key'];
        $xApiKey = $headers['x-api-Key'];
        
        $sub_domaincon=new model_dom();
        $sub_domain=$sub_domaincon->dom_main();
        $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
      
        $data = array(
          'apiKey' =>$apiKey, 
          'xApiKey' => $xApiKey
          
          );
      $curl = curl_init();
      
      // Configurar las opciones de la sesión cURL
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      
      // Ejecutar la solicitud y obtener la respuesta
      $response1 = curl_exec($curl);

      
      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_integrations();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response = file_get_contents($sub_domain.'/crystalIntegrations/apiControlTower/v1/getAllRoomsTrue/', false, $context);
                 
              

      curl_close($curl);




      $sub_domaincons = new model_dom;
      $sub_domain = $sub_domaincons->dom_main();
      
      // Configurar los headers
      $options = array(
          'http' => array(
              'header' => "Api-Key: $apiKey\r\n" .
                          "x-api-Key: $xApiKey\r\n"
          )
      );
      $context = stream_context_create($options);
      
      // Realizar la solicitud y obtener la respuesta
      $response2 = file_get_contents($sub_domain.'/crystalCore/apiUsers/v1/getBasicInfoByAdmin/'.$modelId, false, $context);
           

      curl_close($curl);






  
//echo $response1;
   $deco1=json_decode($response,true);
   $deco2=json_decode($response2,true);  
   // Crear el array combinado
$logs = array(
  'rooms' => $deco1['rooms']
);
$usuarios = array(
  'users' => $deco2['users']
);

$res = array(
  
  'rooms' => $logs['rooms'],
  'users' => $usuarios['users']
  
);
$arr = array_merge($logs, $usuarios);

$logs = $arr['rooms'];
$users = $arr['users'];

$r1 = [];
$result = [];

foreach ($users as $user) {
    $profile = $user['profileId'];

    // Buscar los grupos con el mismo perfil
    $matchingGroups = [];
    foreach ($logs as $log) {
        if ($log['profileId'] === $profile) {
            $matchingGroups[] = $log;
        }
    }

    // Combinar los datos del usuario con cada grupo
    foreach ($matchingGroups as $log) {
        $combinedData = array_merge($log, $user);
        $result[] = $combinedData;
        array_push($r1, $combinedData);
    }
}

echo json_encode(['modelInfo' => $r1]);


//echo json_encode($response);
//echo json_encode($profile);
//echo json_encode($arr);}
    }
});






Flight::route('GET /getVersionList/', function () {
  header("Access-Control-Allow-Origin: *");
  // Leer los encabezados
  $headers = getallheaders();
  
  // Verificar si los encabezados 'Api-Key' y 'Secret-Key' existen
  if (isset($headers['Api-Key']) && isset($headers['x-api-Key'])) {
      // Leer los datos de la solicitud
     
      // Acceder a los encabezados
      $apiKey = $headers['Api-Key'];
      $xApiKey = $headers['x-api-Key'];
      
      $sub_domaincon=new model_dom();
      $sub_domain=$sub_domaincon->dom_main();
      $url = $sub_domain.'/crystalCore/apiAuth/v1/authApiKey/';
    
      $data = array(
        'apiKey' =>$apiKey, 
        'xApiKey' => $xApiKey
        
        );
    $curl = curl_init();
    
    // Configurar las opciones de la sesión cURL
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    // Ejecutar la solicitud y obtener la respuesta
    $response1 = curl_exec($curl);

    


    curl_close($curl);

    

      // Realizar acciones basadas en los valores de los encabezados


      if ($response1 == 'true' ) {
         
require_once 'versions/versions.php';

$ver=new versiones();
$ver1= $ver->ver_change();

         
             echo $ver1;
         

      } else {
          echo 'Error: Autenticación fallida';
           //echo json_encode($response1);
      }
  } else {
      echo 'Error: Encabezados faltantes';
  }
});



Flight::start();
