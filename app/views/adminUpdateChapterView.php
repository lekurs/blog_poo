<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/11/2017
 * Time: 10:13
 */

$title = 'Administration - Mise à jour du chapitre';

ob_start();
?>
<section>
    <div class="admin-container">
        <div class="menus">
            <?php
            foreach($menu as $menus) :

                ?>
                <p><a href="<?php echo $menus['lien']; ?>" class="menus-btn"><?php echo $menus['menus']; ?></a></p>
                <?php
            endforeach;
            ?>
        </div>
        <div class="admin">
            <?php
            foreach($chap as $datas) :
            $chapter = new \blog\app\models\Chapters($datas);
            ?>
            <h2>Chapitre à modifier :</h2>
            <form action="index.php?action=adminupdatepost&amp;c=<?= $chapter->idChapter();?>&amp;up=ok" method="post">
                <input type="hidden" name="idChapter" id="idChapter" value="<?= $chapter->idChapter(); ?>" />
                <input type="text" name="title" id="title" placeholder="Titre :" value="<?= $chapter->title(); ?>"/>
                <textarea id="chapitre_area" name="chapitre_area" placeholder="Votre texte"><?= $chapter->chapter(); ?></textarea>
                <div class="check">
                    <div><p>Souhaitez vous mettre en ligne ce chapitre ?</p></div>
                    <div class="contain-checkbox">
                        <label class="switch">
                            <input type="checkbox" value="online" name="online" id="online" checked <?php if($chapter->online() === 1) { ?>checked<?php } ; ?>/> <!-- voir comment modifier ça -->
                            <div class="slider round">
                        </label>
                    </div>
                </div>
        </div>
        <p>
            <input type="submit" value="Mettre à jour" class="sub-btn" name="update_chapter" id="reccord_chapter">
        </p>
        </form>
        <?php
        endforeach;
        ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require('app/views/tpl/front_tpl.php');
?>
