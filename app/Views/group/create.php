<!DOCTYPE html>
<html>
<head>
    <title>Crear Grupo</title>
</head>
<body>
    <h1>Crear Grupo</h1>
    <form action="/conecter/store-group" method="post" enctype="multipart/form-data">
        <label for="name">Nombre del Grupo:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="description">Descripción:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="type">Tipo:</label>
        <select id="type" name="type" required>
            <option value="public">Público</option>
            <option value="private">Privado</option>
            <option value="intermediate">Intermedio</option>
        </select><br>

        <label for="image">Imagen del Grupo:</label>
        <input type="file" id="image" name="image" accept="image/*"><br>

        <input type="submit" value="Crear Grupo">
    </form>
</body>
</html>
