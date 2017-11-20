<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 10/11/2017
 * Time: 11:26
 */

$title = 'Billet pour l\'Alaska - Jean Forteroche';

ob_start();

?>

<section>
    <?php
    foreach ($chapters as $chapter) :

        $chapitre = new \blog\app\models\Chapters($chapter);
        ?>
        <article>
            <div class="date_pastille">
                <div class="date_pastille_contain">
                    <p><?= substr($chapitre->createDate(), 0,2); ?></p>
                    <p><?= substr($chapitre->createDate(), 3,3); ?></p>
                </div>
            </div>
            <div class="chapitre-conteneur">
                <h2 class="titre_chapitre"><a href="index.php?action=shwcha&amp;c=<?= $chapitre->idChapter(); ?>"><?= $chapitre->title(); ?></a></h2>
                <p class="contenu_chapitre"><?= substr($chapitre->chapter(), 0, 600); ?></p>
                <p class="commentaires"><i class="fa fa-commenting"></i><span class="count_comment"><?= $commentManager->nb_comment($chapitre->idChapter()); ?></span><span> Commentaires</span> </p>
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
