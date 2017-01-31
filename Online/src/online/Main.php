<?php
namespace online; 
 
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

require_once("JSONConfig.php");
require_once("plugin\Plugin.php");
require_once("AsyncWorker.php");
require_once("Website.php");
require_once("tasks\RepeatingWebsite.php");
require_once("tasks\RepeatingTask.php");
use online\plugin\Plugin;
use online\Website;
use online\utils\Utils;
use online\AsyncWorker;
use online\tasks\RepeatingWebsite;
use online\tasks\RepeatingTask;
use online\JSONConfig;
 
$cfg = new JSONConfig(realpath(__DIR__) . "../../../config.json"); // Getting the config for port
$address = '0.0.0.0';
$port = $cfg->get("port");

$sock = socket_create(AF_INET, SOCK_STREAM, 0) or Utils::alert("Could not create socket\n"); // Creating port
if (!socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, 1)) { // if we can't use address
    echo socket_strerror(socket_last_error($sock));
} 
$result = socket_bind($sock, $address, $port) or Utils::alert('Could not bind to address');

Utils::popup();
Utils::alert("Website open on port $port");
Plugin::onEnable();

AsyncWorker::open(new RepeatingTask($socket = new RepeatingWebsite($sock, $port))); // creating an asynctask of the website

echo "Website open on port " . $port . "\n";

