<div class="info">
    <table>
        <tr>
            <th colspan="1">Información</th>
        </tr>
        <tr>
            <th>Información de la cuenta</th>

        <tr>
            <td>Nombre</td>
            <td><?php echo $_SESSION['username'] ?></td>
        </tr>
        <tr>

            <td>Apellido</td>
            <td><?php echo $user['last_name'] ?></td>
        </tr>
        </tr>
        <tr>
            <th>Información Basica</th>
            <tr>
                <td>Semestre</td>
                <td><?=$user['semester']?></td>
            </tr>
            <tr>
                <td>ScreenName</td>
                <td><?=$user['screenname']?></td>
            </tr>
            <tr>
                <td>Correo Institucional</td>
                <td><?=$user['email']?></td>
            </tr>
        </tr>
    </table>
</div>