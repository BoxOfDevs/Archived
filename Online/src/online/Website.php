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
namespace online; 
require_once("plugin/Plugin.php");
require_once("event/ForbiddenEvent.php");
require_once("event/HTMLPageLoadEvent.php");
require_once("event/PHPPageLoadEvent.php");
require_once("event/NotFoundEvent.php");
require_once("event/GETPageLoadEvent.php");
require_once("event/PageLoadEvent.php");
use online\plugin\Plugin;
use online\event\PageLoadEvent;
use online\event\PHPPageLoadEvent;
use online\event\HTMLPageLoadEvent;
use online\event\GETPageLoadEvent;
use online\event\NotFoundEvent;
use online\event\ForbiddenEvent;
use online\JSONConfig;

   class Website {
	private $plugin;
	private $sock;
    public function onShutdown() {
        $output = "HTTP/1.1 200 OK \r\n" .
"Date: Fri, 31 Dec 1999 23:59:59 GMT \r\n" .
"Content-Type: text/html \r\n\r\n" . "<script>alert('Connection to server lost.')</script>";
        socket_write($this->client,$output,strlen($output));
        Plugin::onDisable();
    }
    public function __construct($sock, $datapath){
        $this->sock = $sock;
        $this->datapath = $datapath;
        $this->cfg = new JSONConfig(realpath($datapath . "../cfg.json"));
        $this->run();
        register_shutdown_function("onShutdown");
    }
    public function run() {
        $sock = $this->sock;
            socket_listen($this->sock);
            $this->client = socket_accept($sock);
            $input = socket_read($client, 1024);
            $incoming = explode("\r\n", $input);
            $fetchArray = explode(" ", $incoming[0]);
            if($fetchArray[1] == "/"){
                $file =  $this->cfg->get("index"); 
                $fetchArray[1] =  $this->cfg->get("index");
             } else {
                 $filearray = [];
                 $filearray = explode("/", $fetchArray[1]);
                 $file = $fetchArray[1];
             }
             $output = "";
             $Header = "HTTP/1.1 200 OK \r\n" .
             "Date: Fri, 31 Dec 1999 23:59:59 GMT \r\n" .
             "Content-Type: text/html \r\n\r\n";
             $file = ltrim($file, '/');
             if(strpos($file, "?")) {
                 $exe = explode("?", $file);
                 $file = $exe[0];
                 $exe = explode("&", $exe[1]);
             }
             
             if(file_exists($this->datapath . $file)) {
                 if(pathinfo($this->datapath . $file)['extension'] === "php") { // if the file is PHP (need a special think)
                     Plugin::onPageLoad(new PHPPageLoadEvent($file, $client));
                     Plugin::onPHPPageLoad(new PHPPageLoadEvent($file, $client));
                     if(isset($exe[0])) { // if this is using a GET method
                         $GET = [];
                         foreach($exe as $exes) {
                             $ex = explode("=", $exes);
                             array_push($GET, "\"{$ex[0]}\" => \"{$ex[1]}\"");
                         }
                         $current = '<?php 
$GET = [' . implode("," . PHP_EOL, $GET) . '];
?>' . file_get_contents($this->datapath . $file);
                         $current = str_ireplace('$_GET', '$GET', $current); // I need this or it will bug out
                         file_put_contents($this->datapath . "current.php", $current);
                         $file = "current.php";
                     }
                     ob_start();
                     include $this->datapath . $file ;
                     $Content = ob_get_contents();
                     ob_end_clean();
                 } else {
                     Plugin::onHTMLPageLoad(new HTMLPageLoadEvent($file, $client));
                     $Content = file_get_contents($this->datapath . $file);
                 }
                 
             $Header = "HTTP/1.1 200 OK \r\n" .
"Date: Fri, 31 Dec 1999 23:59:59 GMT \r\n" .
"Content-Type: text/html \r\n\r\n";
             } else {
                 Plugin::onNotFound(new NotFoundEvent($file, $client));
             $Header = "HTTP/1.1 404 NOT FOUND \r\n" .
"Date: Fri, 31 Dec 1999 23:59:59 GMT \r\n" .
"Content-Type: text/html \r\n\r\n";
                 $Content = file_get_contents($this->datapath . $this->cfg->get("404"));
             }
             foreach($this->cfg->get("denied-pages") as $dp) {
                 if($dp === $file) {
                     $Header = "HTTP/1.1 403 FORBIDDEN \r\n" .
                     Plugin::onForbidden(new ForbiddenEvent($file, $sock, $client));
"Date: Fri, 31 Dec 1999 23:59:59 GMT \r\n" .
"Content-Type: text/html \r\n\r\n";
                     $Content = file_get_contents($this->datapath . $this->cfg->get("403"));
                 }
             }
             $output = $Header . $Content;
             socket_write($client,$output,strlen($output));
             $this->run();
        }
   }