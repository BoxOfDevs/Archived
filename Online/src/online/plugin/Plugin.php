<?php
#
#
# //=====\\      ||\\     ||     ||         //\\     ||\\     ||    //======
#||       ||     || \\    ||     ||         \\//     || \\    ||    ||
#||       ||     ||  \\   ||     ||          ||      ||  \\   ||    ||______
#||       ||     ||   \\  ||     ||          ||      ||   \\  ||    ||------
#||       ||     ||    \\ ||     ||          ||      ||    \\ ||    ||
# \\=====//      ||     \\||     \\=====     ||      ||     \\||    \\======
#
# Make websites better and easilier !
#
# Author: BoxOfDevs Team
# Authors: Ad5001
#
# Website: http://boxofdevs.byethost14.com
namespace online\plugin;
use online\event\PageLoadEvent;
use online\event\PHPPageLoadEvent;
use online\event\HTMLPageLoadEvent;
use online\event\GETPageLoadEvent;
use online\event\NotFoundEvent;
use online\event\ForbiddenEvent;

class Plugin {
    static function onPageLoad(PageLoadEvent $event) {}
    static function onPHPPageLoad(PHPPageLoadEvent $event) {}
    static function onHTMLPageLoad(HTMLPageLoadEvent $event) {}
    static function onGETPageLoad(GETPageLoadEvent $event) {}
    static function onNotFound(NotFoundEvent $event) {}
    static function onForbidden(ForbiddenEvent $event) {}
    static function onEnable() {}
    static function onDisable() {}
    public function getPluginPath() {
        return realpath(__DIR__ . "../../../plugins/");
    }
    public function getFileFolder() {
        return realpath(__DIR__ . "../../../www/htdocs/");
    }
    public function getRootPath() {
        return realpath(__DIR__ . "../../../");
    }
}