<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $rfc = $_POST['rfc'];
    $direccion = $_POST['direccion'];
    $estado = $_POST['estado'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];

    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'integradora');

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if ($accion == 'guardar') {
        $stmt = $conn->prepare("INSERT INTO proveedor (nombre, apellido, rfc, direccion, estado, ciudad, telefono) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nombre, $apellido, $rfc, $direccion, $estado, $ciudad, $telefono);
    } elseif ($accion == 'actualizar') {
        $stmt = $conn->prepare("UPDATE proveedores SET nombre=?, apellido=?, rfc=?, direccion=?, estado=?, ciudad=?, telefono=? WHERE id=?");
        $stmt->bind_param("sssssssi", $nombre, $apellido, $rfc, $direccion, $estado, $ciudad, $telefono, $id);
    } elseif ($accion == 'eliminar') {
        $stmt = $conn->prepare("DELETE FROM proveedores WHERE id=?");
        $stmt->bind_param("i", $id);
    }

    if ($stmt->execute()) {
        echo "Operación realizada con éxito";
    } else {
        echo "Error en la operación: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
