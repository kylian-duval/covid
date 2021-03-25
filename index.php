<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require "user.php";
require "personnage.php";
$PDO = new PDO('mysql:host=mysql-kylian-duval.alwaysdata.net; dbname=kylian-duval_virus; charset=utf8', '223354', 'admin123456789.');
$jouer = new user($PDO);
$perso = new personnage($PDO);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php if (isset($_POST["co"])) {

    $jouer->connection($_POST['user'], $_POST['mdp']);
}


?>

<body>
    <?php
    $PDO = new PDO('mysql:host=mysql-kylian-duval.alwaysdata.net; dbname=kylian-duval_virus; charset=utf8', '223354', 'admin123456789.');
    echo '<form action="" method="post">';
    if (isset($_SESSION['id']) == true) { ?>
        <input type="submit" value="déco" name="deco">
        <?php 
            $perso->getChoixPersonnage();
            if(!$perso->getId()==0){
                $jouer->setPersonnage($perso);
            }
        ?>
        


    <?php } else { ?>



        <input type="text" name=" user">
        <input type="password" name="mdp">
        <input type="submit" name="co" value="connection">


        </form>

    <?php }
    
    if (isset($_POST["deco"])) {
        session_destroy();
        echo "vous etre deoc";
    }
    ?>


</body>

</html>