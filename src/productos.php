<?php
// Importa la conexión existente
require_once 'conexion.php';

// Consulta SQL para crear la tabla 'productos' si no existe
$sqlCrearTabla = "CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL
)";

// Ejecuta la consulta para crear la tabla 'productos'
if ($conn->query($sqlCrearTabla) === TRUE) {
    echo "✅ Tabla 'productos' creada exitosamente.";
} else {
    echo "❌ Error al crear la tabla: " . $conn->error;
}

// Consulta SQL para obtener los productos
$sqlObtenerProductos = "SELECT * FROM productos";
$resultado = $conn->query($sqlObtenerProductos);

// Mostrar una tabla HTML con los productos
echo "<h2>Productos:</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr>";

if ($resultado && $resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["precio"] . "</td>";
        echo "<td>";
        if (isset($fila["stock"])) {
            echo $fila["stock"];
        } else {
            echo "No disponible";
        }
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No hay productos.</td></tr>";
}

echo "</table>";

// Cerrar la conexión
$conn->close();

// Estilos CSS
echo "<style>";
echo "table {";
echo "    border-collapse: collapse;";
echo "    width: 100%;";
echo "}";

echo "th, td {";
echo "    border: 1px solid #ddd;";
echo "    padding: 8px;";
echo "}";

echo "th {";
echo "    background-color: #f2f2f2;";
echo "}";

echo "tr:nth-child(even) {";
echo "    background-color: #f9f9f9;";
echo "}";

echo "tr:hover {";
echo "    background-color: #e9e9e9;";
echo "}";
echo "</style>";
?>