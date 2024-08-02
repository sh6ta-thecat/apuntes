<?php

function cargarRecursos(){
    $pagina_actual = basename($_SERVER['REQUEST_URI'], ".php");

    $recursos = array(
        'home'=>array(
            'css'=>array('sidebar.css')
        )
    );
    if (isset($recursos[$pagina_actual])) {
        $pagina_recursos = $recursos[$pagina_actual];
        if (isset($pagina_recursos['css']) && is_array($pagina_recursos['css'])) {
            foreach ($pagina_recursos['css'] as $css) {
                echo '<link rel="stylesheet" type="text/css" href="/public/css/'.$css.'">';
            }
        }
    }
}
?>
