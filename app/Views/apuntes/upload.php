<?php
$title = 'Apt';
$css = 'apuntes';
include_once($_SERVER['DOCUMENT_ROOT'] . '/conecter/app/Views/static/head.php');
?>
    <div class="content">
        <div class="apuntes">
            <main style="margin-left: 15px;" class="main">
                <h2>Subir apuntes</h2>
                <div class="context">
                    Sólo se puede subir un archivo. Si necesitas subir varios archivos para que tu contenido sea consistente, puedes comprimirlos en .zip o .rar
                </div>
                <br>
                <div style="background: #27272a;padding: 24px;
                    margin: 16px auto;box-shadow: 0 4px 6px rgba(0, 0, 0, 1);
                    max-width: 800px;border-radius: 8px;">
                    <form action="/conecter/apt/storeApunte" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre" name="nombre" required>
                        </div>
                        <div>
                            <label for="descripcion">Descripción</label>
                            <input type="text" id="descripcion" name="descripcion" required>
                        </div>
                        <div>
                        <label for="tags">Tags (separados por comas):</label>
                        <input type="text" id="tags" name="tags" required><br>
                        </div>
                        <div class="file-upload">
                        <input type="file" id="archivo" name="archivo" required><br>
                        </div>
                        <input class="button-primary" type="submit" value="Subir">
                    </form>
                </div>
            </main>
        </div>
    </div>
</div>