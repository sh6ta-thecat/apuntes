<?php
$css = 'perfil';
$title = '@' . $user['name'];
include 'static/head.php';
?>
<div class="main-content">
    <aside class="profile">
        <img src="<?php echo $user['image_path']; ?>" alt="Foto de perfil" width="200px" class="profile-picture">
        <h1 class="profile-name"><?php echo $user['name']; ?></h1>
        <p class="profile-bio">Me gustan los gatos</p>
        <a href="edit_profile"><button class="edit-button">Editar</button></a>
    </aside>
    <main class="profile-main">
        <aside style="width: 100%;">
        <nav class="profile-nav">
                <a href="@<?php echo $user['screenname']; ?>?t=apuntes" class="<?php echo (!isset($_GET['t']) || $_GET['t'] === 'Apuntes') ? 'active' : ''; ?>">Apuntes</a>
                <a href="@<?php echo $user['screenname']; ?>?t=info" class="<?php echo (isset($_GET['t']) && $_GET['t'] === 'Info') ? 'active' : ''; ?>">Info</a>
            </nav>
        </aside>

        <section class="apunts" style="width:800px;">
            <?php
            $t = isset($_GET['t']) ? $_GET['t'] : 'apuntes'; // Default to 'info'
            switch ($t) {
                case 'info':
                    include 'profile/info.php';
                    break;
                case 'apuntes':
                    include 'apuntes/user_apunte.php';
                    break;
                default:
                    include 'profile/apuntes.php';
                    break;
            }
            ?>
        </section>
    </main>

</div>



<script src="public/js/ts.js"></script>