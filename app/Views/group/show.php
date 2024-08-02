<!DOCTYPE html>
<html>
<head>
    <title><?php echo $group['name']; ?> conecter</title>
    <style>/* Estilos para el modal */
.modal {
    display: none; /* Ocultar por defecto */
    position: fixed; /* Mantener el modal en su posición */
    z-index: 1; /* Asegurarse de que el modal esté por encima de otros elementos */
    left: 0;
    top: 0;
    width: 100%; /* Ancho completo */
    height: 100%; /* Altura completa */
    overflow: auto; /* Habilitar el desplazamiento si es necesario */
    background-color: rgba(0, 0, 0, 0.4); /* Fondo negro con opacidad */
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% desde la parte superior y centrado horizontalmente */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Ancho del 80% */
    max-width: 600px; /* Máximo ancho */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Estilos adicionales para el formulario dentro del modal */
.modal-content form {
    display: flex;
    flex-direction: column;
}

.modal-content form div {
    margin-bottom: 15px;
}

.modal-content form label {
    margin-bottom: 5px;
    font-weight: bold;
}

.modal-content form input[type="text"],
.modal-content form textarea,
.modal-content form select,
.modal-content form input[type="file"] {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.modal-content form button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.modal-content form button:hover {
    background-color: #45a049;
}
</style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2><?php echo $group['name']; ?></h2>
<?php if (!empty($group['image_path'])): ?>
    <img src="../<?php echo $group['image_path']; ?>" alt="Imagen del grupo" class="group-image">
<?php endif; ?>
<p><?php echo $group['description']; ?></p>
<?php if ($group['type'] == 'public' || $group['type'] == 'intermediate' || in_array($_SESSION['user_id'], array_column($posts, 'user_id'))): ?>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li><?php echo $post['content']; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="group-actions">
        <?php if ($userRole == 'guest'): ?>
            <a href="/conecter/group/join/<?php echo htmlspecialchars($group['namelink']); ?>">Unirse al grupo</a>
        <?php elseif ($userRole == 'member'): ?>
            <a href="/conecter/group/leave/<?php echo htmlspecialchars($group['namelink']); ?>">Dejar grupo</a>
        <?php elseif ($userRole == 'admin'): ?>
            <a href="/conecter/g/<?php echo htmlspecialchars($group['namelink']); ?>/edit">Editar grupo</a>
            <a href="/conecter/g/<?php echo htmlspecialchars($group['namelink']); ?>/manage">Administrar grupo</a>
        <?php endif; ?>
    </div>


    <h3>Miembros del Grupo</h3>
    <ul>
        <?php if (!empty($members)) : ?>
            <?php foreach ($members as $member): ?>
                <li><?php echo htmlspecialchars($member['name']); ?></li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No hay miembros en este grupo.</li>
        <?php endif; ?>
        </ul>
<!-- Botón para abrir el modal -->
<h3>Publicaciones del Grupo</h3>
    <ul>
        <?php if (!empty($posts)) : ?>
            <?php foreach ($posts as $post): ?>
                <li><?php echo htmlspecialchars($post['content']); ?></li>
            <?php endforeach; ?>
        <?php else : ?>
            <li>No hay publicaciones en este grupo.</li>
        <?php endif; ?>
    </ul>

<!-- Modal -->
<div id="editGroupModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Editar Grupo</h2>
        <form id="editGroupForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="group_id" value="<?php echo $group['id']; ?>">
            <div>
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $group['name']; ?>" required>
            </div>
            <div>
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" required><?php echo $group['description']; ?></textarea>
            </div>
            <div>
                <label for="type">Tipo:</label>
                <select id="type" name="type" required>
                    <option value="public" <?php if ($group['type'] == 'public') echo 'selected'; ?>>Público</option>
                    <option value="intermediate" <?php if ($group['type'] == 'intermediate') echo 'selected'; ?>>Intermedio</option>
                    <option value="private" <?php if ($group['type'] == 'private') echo 'selected'; ?>>Privado</option>
                </select>
            </div>
            <div>
                <label for="image">Imagen:</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Abrir el modal
    $('#editGroupBtn').on('click', function() {
        $('#editGroupModal').show();
    });

    // Cerrar el modal
    $('.close').on('click', function() {
        $('#editGroupModal').hide();
    });

    // Enviar el formulario mediante AJAX
    $('#editGroupForm').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '/conecter/group/update',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#editGroupModal').hide();
                location.reload(); // Recargar la página para reflejar los cambios
            },
            error: function(xhr, status, error) {
                // Manejar errores
                alert('Error al actualizar el grupo');
            }
        });
    });
});
</script>
</body>
</html>
