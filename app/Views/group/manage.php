<!DOCTYPE html>
<html>
<head>
    <title>Administrar Grupo</title>
    <style>/* styles.css */

body {
    font-family: Arial, sans-serif;
}

h2 {
    color: #333;
}

h3 {
    margin-top: 20px;
    color: #555;
}

form {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-top: 10px;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
}

button {
    padding: 10px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    margin-top: 10px;
}

button:hover {
    background-color: #0056b3;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    padding: 8px 0;
    border-bottom: 1px solid #ccc;
}

ul li a {
    color: #d9534f;
    text-decoration: none;
    margin-left: 10px;
}

ul li a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>
    <h2>Administrar Grupo: <?php echo $group['name']; ?></h2>
    <h3>Namelink:<?php echo $group['namelink']; ?></h3>
    
    
    <h3>Miembros del Grupo</h3>
    <ul>
        <?php foreach ($members as $member): ?>
            <li><?php echo $member['user_id']; ?> 
                <a href="/conecter/g/<?php echo $group['namelink']; ?>/remove-member/<?php echo $member['user_id']; ?>">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <h3>Publicaciones del Grupo</h3>
    <form action="/conecter/g/<?php echo $group['namelink']; ?>/addpost" method="post">
        <textarea name="content"></textarea><br>
        <button type="submit">Agregar Publicación</button>
    </form>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li><?php echo $post['content']; ?> 
                <a href="/conecter/g/<?php echo $group['namelink']; ?>/remove-post">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
