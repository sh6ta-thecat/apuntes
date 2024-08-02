
<div class="navar">
    <nav class="sidebar">
        <ul class="navbar">
            <li class="navbar-brand">
                <a href="dashboard">
                    <img src="public/imges/default/logo2.png" alt="">
                </a>
            </li>
            
            <li class="nav-item">
                <a href="@<?php echo $_SESSION['username']; ?>" class="item-icon">
                    #
                </a>
                <a href="@<?php echo $_SESSION['username']; ?>" class="item-link">
                    Perfil
                </a>
            </li>
            <li class="nav-item">
                <a href="apt" class="item-icon home">
                    #
                </a>
                <a href="apt" class="item-link">
                    apuntes
                </a>
            </li>
            <li class="nav-item">
                <a href="apt/upload" class="item-icon">
                    #
                </a>
                <a href="apt/upload" class="item-link">
                    Nuevo apunte
                </a>
            </li>
            <li class="nav-item">
                <a href="logout" class="item-icon home">
                    #
                </a>
                <a href="logout" class="item-link">
                    Cerrar sesion
                </a>
            </li>
            
        </ul>
    </nav>
</div>