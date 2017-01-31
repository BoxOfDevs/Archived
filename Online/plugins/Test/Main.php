<?php
require_once("../../src/online/plugin/Plugin");
require_once("../../src/online/utils/Utils");
class Test extends Plugin {
    public function onEnable() {
        if(Utils::confirm("Hey")) {
            echo "hello";
        }
    }
}