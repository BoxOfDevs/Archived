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
use online\AsyncWorker;
require_once(realpath(__DIR__) . ".\..\utils\Utils.php");
use online\utils\Utils;
class RepeatingTask {
    public function __construct(RepeatingTask $task) {
        $this->task = $task;
        $this->isRunning = true;
        if(Utils::confirm("Running the task?")) {
            $this->run();
        }
    }
    public function close() {
        $this->isRunning = false;
    }
    public function run() {
        while($this->isRunning) {
            $this->task->onRun();
            echo("Hey2");
        }
    }
}