<!-- app/views/edit_profile.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Perfil</title>
</head>
<body>
    <h1>Editar Perfil</h1>
    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        
        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        
        <label for="institutional_email">Email Institucional:</label>
        <input type="email" name="institutional_email" id="institutional_email" value="<?php echo htmlspecialchars($user['institutional_email']); ?>" required>
        
        <label for="semester">Semestre:</label>
        <input type="number" name="semester" id="semester" value="<?php echo htmlspecialchars($user['semester']); ?>" required>
        
        <label for="career_id">Carrera:</label>
        <input type="text" name="career_id" id="career_id" value="<?php echo htmlspecialchars($user['career_id']); ?>" required>
        
        <label for="screen_name">Nombre de pantalla:</label>
        <input type="text" name="screen_name" id="screen_name" value="<?php echo htmlspecialchars($user['screen_name']); ?>" required>
        
        <button type="submit">Guardar cambios</button>
    </form>
</body>
</html>
