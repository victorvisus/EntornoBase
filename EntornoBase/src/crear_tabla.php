<?php
// src/crear_tabla.php

// Importa la conexión existente
require_once 'conexion.php';

// Consulta SQL para crear la tabla 'productos'
$sqlCrearTabla = "CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
)";

// Ejecuta la consulta para crear la tabla
if ($conn->query($sqlCrearTabla) === TRUE) {
    echo "✅ Tabla 'productos' creada exitosamente.";
} else {
    echo "❌ Error al crear la tabla: " . $conn->error;
}

// Consulta SQL para insertar productos de ejemplo
$sqlInsertarProductos = "INSERT INTO productos (nombre, precio) VALUES
    ('Producto 1', 10.99),
    ('Producto 2', 19.99),
    ('Producto 3', 29.99)
";

// Ejecuta la consulta para insertar productos de ejemplo
if ($conn->query($sqlInsertarProductos) === TRUE) {
    echo "✅ Productos de ejemplo insertados exitosamente.";
} else {
    echo "❌ Error al insertar productos de ejemplo: " . $conn->error;
}

// Cierra la conexión
$conn->close();
?>