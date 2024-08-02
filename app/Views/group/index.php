<?php
$title = 'Grupos';
$css = 'group';
include_once($_SERVER['DOCUMENT_ROOT'] . '/conecter/app/Views/static/head.php');



?>

<body>
    <h2>Groups</h2>
    <a href="/conecter/group/create">Create a Group</a>
    <div class="groups-container">
        <?php foreach ($groups as $group) : ?>
            <div class="group-card">
                <div class="imge" style="
    width: 100%;
    height: 50%;
    overflow: hidden;
"><img src="<?php echo $group['image_path']; ?>" alt="Imagen de <?= $group['name'] ?>">
                </div>
                <div class="content">
                    <h2><?= $group['name'] ?></h2>
                    <div class="members">1</div>
                </div>
                <div class="actions">
                    <button class="join-btn">Unirse</button>
                    <a href="/conecter/g/<?php echo $group['namelink']; ?>"><button class="see-btn">Ver</button></a>
                    <!--mas acciones: si esta unido uno unirse desaparecera-->
                </div>
            </div>

        <?php endforeach; ?>
    </div>
    </ul>
</body>

</html>