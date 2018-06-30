<?php

include_once 'head.php';
?>
            
<main role="main" class="container">
    <div class="row" id=gauche >
        <div class="col-md-12 blog-main" >
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            <strong>ADMINISTRATION</strong>
          </h3>

            <?php
                if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                {
            ?>
            <div class="container">
                <div class="form-row">
                    <h2>Modifier un commentaire</h2>
   
                        <?php
                            if(isset($insert_erreur) AND isset($insert_erreur)) {
                        ?>

                            <p><strong>Veuillez renseigner tout les champs, merci !</strong></p>
                        <?php  
                            } ;
                        ?>

                    <form <?php if(isset($comment['id']) AND $comment['id']) ?>  action="<?= 'index.php?action=updateCommentaire&id=' . $comment['id'] ?>" method="post" >
                        <div class="form-group"> 
                            <br/>
                            <br/> 
                            <br/>
                            <br/>                                
                            <label for="val"><strong>Statut du commentaire : </strong></label>
                            <br/>
                                <input class="form-control" <?php if(isset($comment['id']) AND $comment['id']) :?> value="<?= strip_tags($comment['val']);?>"<?php endif;?> name="val" id="val" type=text required>
                            <br/>
                            <label for="contenu"><strong>Contenu : </strong>
                                <br/>

                                <textarea name="contenu" id="contenu" rows="5" cols="80"><?php if(isset($comment['id']) AND $comment['id']) :?><?= nl2br(strip_tags($comment['contenu']));?><?php endif;?></textarea></label></p>
                            <br/>
                            </label>
                            
                            <button type="submit" class="btn btn-outline-primary" ">Modifier</button> <a class="btn btn-outline-warning" href="index.php?action=Admin">Retour</a>  
                                <br/>
                                <br/>                            
                        </div>
                    </form>               
                </div>
            </div>
        </div>
    </div>    
</main>

            <?php  
            } ;
            ?>