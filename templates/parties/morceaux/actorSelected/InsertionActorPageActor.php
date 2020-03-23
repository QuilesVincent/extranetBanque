<?php


//Appel de la fonction d'affichage de l'actor

?>
    <div class='actorLogo'>
        <img src='public/logo/<?php echo $actor['name_actor'];?>.png' alt='Une photo du logo de <?php echo $actor['name_actor'];?>'>
    </div>
    <div class='infoActeur'>
        <h2><?php echo $actor['name_actor'];?></h2>
        <a href='demanderLienAuMentor'></a> <!--Demander lien au mentor-->
        <p><?php echo $actor['presentation_actor'];?></p>
    </div>