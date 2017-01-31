<?php
namespace online\tasks;
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
require_once("RepeatingTask.php");
use online\tasks\RepeatingTask;
use online\AsyncWorker;
use online\Utils;
use online\Website;
class RepeatingWebsite extends RepeatingTask {
    public function __construct($sock, $port) {
        $this->port = $port;
        $this->sock = $sock;
        echo "Hey4";
    }
    public function onRun() {
        AsyncWorker::open(new Website($this->sock, realpath(__DIR__) . "/../../www/htdocs/"));
    }
}