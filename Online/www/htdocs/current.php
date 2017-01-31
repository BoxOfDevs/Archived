<?php 
$GET = ["test" => "2"];
?><html>
<head><title><?php echo "hey"; ?></title></head>
<body>
<?php
if(isset($GET["test"])) {
    echo "<h3>You made the test !</h3>";
}
?>
</body>