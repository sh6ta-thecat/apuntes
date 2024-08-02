<?php
$title = 'Apt';
$css = 'aptview';
include_once($_SERVER['DOCUMENT_ROOT'] . '/conecter/app/Views/static/head.php');



?>
    <div class="content">
        <!-- 
    <h1><?php echo htmlspecialchars($apunte['nombre']); ?></h1>
    <p><?php echo htmlspecialchars($apunte['descripcion']); ?></p> -->
        <div class="mdia">
            <?php
            $filePath = $apunte['archivo'];
            $fileType = $apunte['tipo'];

            switch ($fileType) {
                case 'text/html':
                    echo file_get_contents($filePath);
                    break;
                case 'image/jpeg':
                case 'image/png':
                case 'image/ico':
                case 'image/webp':
                    $type = "image";
                    include "medias/medias.php";
                    break;
                case 'video/mp4':
                    $type = "video";
                    include "medias/medias.php";
                    break;
                default:
                    echo "<a href='/$filePath' download>Descargar archivo</a>";
                    break;
            }
            ?>
            <a href="/conecter/apt/list">Volver a sla lista de apuntes</a>
            <div class="info">
                <a href='<?php echo $filePath ?>' download="<?php echo $filePath ?>"><button>Descargar</button></a>
            </div>
            <div>Likes: <?php echo $apunte['likes']; ?></div>
            <div>Views: <?php echo $apunte['views']; ?></div>
            <button id="like-button" data-apunte-id="<?php echo $apunte['id']; ?>">
                <?php echo $apunte['like'] ? 'Quitar Like' : 'Dar Like'; ?>
            </button>

        </div>
        <div class="comments">
            <h1>Comentarios</h1>
            <div class="comment">
                <div class="picture"><img src="public/imges/Users/default.gif" alt="Imagen de usuario"></div>
                <div class="comm"><input type="text" placeholder="Escribe tu comentario"></div>
            </div>
            <div class="comment">
                <div class="picture"><img src="public/imges/Users/default.gif" alt="Imagen de usuario"></div>
                <div class="comm">el gato</div>
            </div>
        </div>
    </div>

    <script src="public/js/like.js"></script>