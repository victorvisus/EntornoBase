<?php

// Importa la conexión existente
require_once 'conexion.php';

// Función para obtener todos los productos
function obtenerProductos() {
    global $conn;
    $sql = "SELECT * FROM productos";
    $resultado = $conn->query($sql);
    return $resultado;
}

// Función para obtener un producto por su ID
function obtenerProductoPorId($id) {
    global $conn;
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = $conn->query($sql);
    return $resultado->fetch_assoc();
}

// Función para crear un producto
function crearProducto($nombre, $precio, $stock) {
    global $conn;
    $sql = "INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $precio, $stock);
    $stmt->execute();
    return $stmt->insert_id;
}

// Función para actualizar un producto
function actualizarProducto($id, $nombre, $precio, $stock) {
    global $conn;
    $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nombre, $precio, $stock, $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

// Función para eliminar un producto
function eliminarProducto($id) {
    global $conn;
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->affected_rows;
}

// Mostrar una tabla HTML con los productos
echo "<h2>Productos:</h2>";
echo "<table>";
echo "<tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr>";

$productos = obtenerProductos();

if ($productos && $productos->num_rows > 0) {
    while($fila = $productos->fetch_assoc()) {
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

// Cierra la conexión
$conn->close();
// Formulario para agregar, modificar o eliminar productos
echo "<h2>Agregar, modificar o eliminar producto</h2>";
echo "<form action='#' method='post'>";
$productos = obtenerProductos();

if (!$conn->connect_error) {
    echo "<select name='id' required>";
    echo "<option value='' disabled selected>Seleccione un producto</option>";

    if ($productos && $productos->num_rows > 0) {
        while($fila = $productos->fetch_assoc()) {
            echo "<option value='" . $fila["id"] . "'>" . $fila["nombre"] . "</option>";
        }
    }
    echo "</select>";
}

echo "<input type='submit' name='accion' value='Agregar'>";
echo "<input type='submit' name='accion' value='Modificar'>";
echo "<input type='submit' name='accion' value='Eliminar'";

echo "</form>";

