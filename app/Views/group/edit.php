<!DOCTYPE html>
<html>
<head>
    <title>Editar Grupo</title>
</head>
<body>
    <h2>Editar Grupo</h2>
    <form action="/conecter/group/update" method="POST" enctype="multipart/form-data">
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
                <option value="public" <?php if ($group['type'] == 'public') echo 'selected'; ?>>Publico</option>
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
</body>
</html>
