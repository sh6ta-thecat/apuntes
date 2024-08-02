<div class="media show-controls">
<?php
if (isset($type)) {
    if ($type === "video") {
        echo "<video class='archive' controls><source src='/conecter/$filePath' type='$fileType'>Tu navegador no soporta la reproducción de video.</video>";
    } else {
        echo "<img src='$filePath' class='archive' alt='" . htmlspecialchars($apunte['nombre']) . "'>";
    }
} else {
    echo 'Tipo de archivo no definido';
}
?>
</div>