<?php

class PageController {
    public function faq() {
        require_once 'app/views/faq.php';
    }

    public function about() {
        require_once 'app/views/about.php';
    }

    public function terms() {
        require_once 'app/views/terms.php';
    }

    public function privacy() {
        require_once 'app/views/privacy.php';
    }

    public function contact() {
        require_once 'app/views/contact.php';
    }
}
?>
