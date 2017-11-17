<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 10/11/2017
 * Time: 11:26
 */
session_start();
$title = 'Billet pour l\'Alaska - Jean Forteroche';

ob_start();

?>

<section>
    <?php
    foreach ($chapters as $chapter) :

        $chapter = new \blog\app\models\Chapters($chapter);
        ?>
        <article>
            <div class="date_pastille">
                <div class="date_pastille_contain">
                    <p><?= substr($chapter->createDate(), 0,2); ?></p>
                    <p><?= substr($chapter->createDate(), 3,3); ?></p>
                </div>
            </div>
            <div class="chapitre-conteneur">
                <h2 class="titre_chapitre"><a href="index.php?action=shwcha&amp;c=<?= $chapter->idChapter(); ?>"><?= $chapter->title(); ?></a></h2>
                <p class="contenu_chapitre"><?= substr($chapter->chapter(), 0, 600); ?></p>
                <p class="commentaires"><i class="fa fa-commenting"></i><span class="count_comment"><?= $comment=$commentManager->nb_comment($chapter->idChapter()); ?></span><span> Commentaires</span> </p>
            </div>
        </article>
        <?php
    endforeach;
    ?>
</section>

<?php
$content = ob_get_clean();

require ('app/views/tpl/front_tpl.php');
?>
