<?php


//Utilisation d'une function pour couper à un endroit précis, selectionné plus tard à l'appel de la fonction, au niveau d'un espace pour ne pas couper en plein millieu d'un mot
function tronquer($content,$maxCarac)
{
    $positionSpace = strpos($content, ' ',$maxCarac);
    $newContent = substr($content,0,$positionSpace);
    $newContent .= '...';
    return $newContent;
}

foreach($actors as $actor){
    ?>
    <div class="partieActeur<?= $actor['name_actor']?> partieActeurDiv">
        <div class='partieGaucheLogo'>
            <img src="image/logo/<?= $actor['name_actor']?>.png" alt="logo de l'entité de <?php echo $actor['name_actor']?>">
        </div>
        <div class='partieDroitePres'>
            <h3><?php echo $actor['name_actor']?></h3>
            <a href='Demander lien au mentor'></a><!--Demander lien au mentor-->
            <p><?php echo tronquer($actor['presentation_actor'],120);?></p>
            <div class="contentLien">
            <a href="index.php?controllers=actor&task=showOneSelected&actor=<?php echo htmlspecialchars($actor['id_actor']);?>&user=<?= $_SESSION['id'];?>" class='lienActeur'>Lire la suite</a>
            </div>
        </div>
    </div>
<?php
}
?>
