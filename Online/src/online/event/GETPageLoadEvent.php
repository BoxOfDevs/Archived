<?php
namespace online\event;
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
require_once("PageLoadEvent.php");
class GETPageLoadEvent extends PageLoadEvent {
    public function __construct($file, $client) {
        $this->file = $file;
        $this->client = $client;
    }
    public function getFile() {
        return $this->file;
    }
    public function getClient() {
        return $this->client;
    }
}