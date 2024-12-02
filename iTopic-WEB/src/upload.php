<?php
session_start();
include 'db.php';

if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = uniqid() . '_' . $_FILES['imagen']['name'];
    move_uploaded_file($_FILES['imagen']['tmp_name'], 'uploads/' . $nombreArchivo);

    $stmt = $conn->prepare("INSERT INTO fotos (usuario_id, nombre_foto) VALUES (?, ?)");
    $stmt->execute([$_SESSION['user_id'], $nombreArchivo]);

    header("Location: profile.php");
}
?>
