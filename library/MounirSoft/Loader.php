<?php

namespace MounirSoft;

class Loader {

    private $namespaces = array();

    public function __construct() {
        $this->namespaces = array(
            __NAMESPACE__ => LIB_PATH . DIRECTORY_SEPARATOR,
            'Application' => ROOT_PATH . DIRECTORY_SEPARATOR,
        );
    }

    public function register() {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function unregister() {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    public function loadClass($classname) {
        $parts = explode(DIRECTORY_SEPARATOR, $classname);
        require $this->formatPath($this->namespaces[$parts[0]]. $classname) . '.php';
    }

    public function formatPath($path = null) {
        return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
    }

    public function __destruct() {
        $this->unregister();
    }

}
