<?php



function conn() {
    $hostname = "localhost"; // o dirección IP del servidor de la base de datos remota
    $usuariodb = "root"; // reemplazar con el usuario de la base de datos
    $passworddb = ""; // reemplazar con la contraseña de la base de datos
    $dbname = "lugmatools"; // reemplazar con el nombre de la base de datos

    try {
        // Conexión a la base de datos
        $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);

        // Establecer el conjunto de caracteres de la conexión
        if (!mysqli_set_charset($conectar, "utf8mb4")) {
            throw new Exception("Error al establecer el conjunto de caracteres: " . mysqli_error($conectar));
        }

        return $conectar;
    } catch (Exception $e) {
        // Manejo del error
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        exit();
    }
}



function conn1() {
    $hostname = "localhost"; // o dirección IP del servidor de la base de datos remota
    $usuariodb = "root"; // reemplazar con el usuario de la base de datos
    $passworddb = ""; // reemplazar con la contraseña de la base de datos
    $dbname = "lugmacore"; // reemplazar con el nombre de la base de datos

    try {
        // Conexión a la base de datos
        $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);

        // Establecer el conjunto de caracteres de la conexión
        if (!mysqli_set_charset($conectar, "utf8mb4")) {
            throw new Exception("Error al establecer el conjunto de caracteres: " . mysqli_error($conectar));
        }

        return $conectar;
    } catch (Exception $e) {
        // Manejo del error
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        exit();
    }
}



function conn2() {
    $hostname = "localhost"; // o dirección IP del servidor de la base de datos remota
    $usuariodb = "root"; // reemplazar con el usuario de la base de datos
    $passworddb = ""; // reemplazar con la contraseña de la base de datos
    $dbname = "lugmarepos"; // reemplazar con el nombre de la base de datos

    try {
        // Conexión a la base de datos
        $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);

        // Establecer el conjunto de caracteres de la conexión
        if (!mysqli_set_charset($conectar, "utf8mb4")) {
            throw new Exception("Error al establecer el conjunto de caracteres: " . mysqli_error($conectar));
        }

        return $conectar;
    } catch (Exception $e) {
        // Manejo del error
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        exit();
    }
}


function conn3() {
    $hostname = "localhost"; // o dirección IP del servidor de la base de datos remota
    $usuariodb = "root"; // reemplazar con el usuario de la base de datos
    $passworddb = ""; // reemplazar con la contraseña de la base de datos
    $dbname = "lugmacom"; // reemplazar con el nombre de la base de datos

    try {
        // Conexión a la base de datos
        $conectar = mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);

        // Establecer el conjunto de caracteres de la conexión
        if (!mysqli_set_charset($conectar, "utf8mb4")) {
            throw new Exception("Error al establecer el conjunto de caracteres: " . mysqli_error($conectar));
        }

        return $conectar;
    } catch (Exception $e) {
        // Manejo del error
        echo "Error al conectar con la base de datos: " . $e->getMessage();
        exit();
    }
}


?>