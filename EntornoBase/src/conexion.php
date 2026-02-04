<?php
$host = 'db'; // Nombre del servicio en Docker
$user = 'vichoxusr';
$password = 'L3Ñ4&T!n0usr';
$db = 'vichoxdatabase';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}

echo "✅ Conexión exitosa a la base de datos: <strong>$db</strong>";

// Consulta de prueba para ver que todo responde
$resultado = $conn->query("SHOW TABLES");
echo "<h3>Tablas actuales:</h3>";
if ($resultado && $resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo " - " . $fila["Tables_in_$db"] . "<br>";
    }
} else {
    echo "No hay tablas todavía. ¡Es un lienzo en blanco!";
}
?>