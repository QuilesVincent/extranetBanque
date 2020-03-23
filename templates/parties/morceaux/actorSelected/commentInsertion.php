<?php
//affichage des différents commentaires
        foreach($commentaireAndAuthor as $com){
            $commentDate = $com['comment_date'];
            $commentContent = $com['comment_content'];
            $idUserComment = $com['id_targetUser'];
            $nameUserComment = $com[5];
    ?>
    <div class='comment'>
        <div class='infoUserComment'>
            <p><?= $nameUserComment;?></p> <!-- On se sert bien du nom de l'objet User pour mettre le nom à jour en cas de changement dans param compte -->
        <p><?= htmlspecialchars($commentDate);?></p>
        </div>
        <div class='contentComment'>
            <p><?= htmlspecialchars($commentContent);?></p>
        </div>
        </div>
        <?php

    } ?>