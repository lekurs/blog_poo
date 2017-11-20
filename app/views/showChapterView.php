<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 02/11/2017
 * Time: 09:09
 */

$title = 'Billet simple pour l\'Alaska - Chapitre : ';
ob_start();
?>

<section class="chapitre">
    <?php
    foreach ($showChapter as $chap) :
    ?>
    <article class="article-contain">
            <div class="date_pastille">
                <div class="date_pastille_contain">
                    <p><?= substr($chap->date_creation, 0, 2); ?></p>
                    <p><?= substr($chap->date_creation, 3, 3); ?></p>
                </div>
            </div>
            <div class="chapitre-conteneur">
                <h2 class="titre_chapitre"><?= $chap->title; ?></h2>
                <p class="contenu_chapitre"><?= $chap->chapter; ?></p>
            </div>
    </article>
    <?php
    endforeach;
    ?>

    <article class="commentaires">

        <h3>Commentaires (<?= $nbComment; ?>)</h3>
        <?php
        $i=1;
        foreach($comments as $comment) :
        ?>
            <div class="liste-commentaires">
                <p class="numero-comment"><?php echo $i++; ?></p>
                <p class="log-comment"><?=  ucfirst($comment['username']); ?></p>
                <p class="detail-comment"><?= htmlentities($comment['comments']); ?></p>
                <p class="warning">
                    <input type="hidden" name="report" class="report" value="<?= $comment['report']; ?>" />
                    <input type="hidden" name="chapterId" class="chapterId" value="<?= $comment['chapterId']; ?>" />
                    <input type="hidden" name="idComments" class="idComments" value="<?= $comment['idComments']; ?>" />
                    <i class="fa fa-exclamation-triangle" class="black-exclam"></i>
                </p>
            </div>
        <?php
        endforeach;
        ?>
        <?php
        if(isset($_SESSION) && !empty($_SESSION))
        {
            ?>
            <div class="post-comm">
                <h3>Postez votre commentaire :</h3>
                <form action="index.php?action=postcomm&amp;c=<?= $_GET['c']; ?>" method="post">
                    <input type="hidden" value="<?php echo $_GET['c']; ?>" id="chapterId" name="chapterId" />
                    <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="sessionId" id="sessionId" />
                    <textarea id="post_commentaire" name="post_commentaire" placeholder="Tapez votre commentaire ici :"></textarea>
                    <input type="submit" value="Poster" id="post_comm_sub">
                </form>
            </div>
            <?php
        }
        ?>
    </article>
</section>

<?php
$content = ob_get_clean();

require ('app/views/tpl/front_tpl.php');
?>

