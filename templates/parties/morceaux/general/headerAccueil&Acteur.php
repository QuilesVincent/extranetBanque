<?php


$idUserSafe = htmlspecialchars($_SESSION['id']);

if(isset($_GET["actor"])){
    $idActor = $_GET['actor'];
};

?>

<header class="headerMultiPage">
    <div class='containHeader'>
        <div class='logoHeader'>
            <div class="img">
            </div>
        </div>
        <div class='infoUser'>
                <p><?php echo htmlspecialchars($_SESSION['lastName']). ' & ' .htmlspecialchars($_SESSION['firstName']);?></p>
            <nav>
                <ul>
                    <li class="menuDeroulant"><img src="image/logo/compte.png">
                        <ul class="sousMenuDeroulant">
                            <li><a href="index.php?controllers=afficheur&task=afficheChangeDonneUser&user=<?= $idUserSafe;?><?= isset($idActor) ? "&actor=" .$idActor : false;?>">Paramètres de compte</a></li>
                            <li><a href="index.php?controllers=user&task=logOut">Deconnexion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</header>