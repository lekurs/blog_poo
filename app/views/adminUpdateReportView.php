<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/11/2017
 * Time: 14:16
 */

$title = 'Modification du commentaire N° ' . $_GET['comm'];
ob_start();

?>
<section>
    <div class="admin-container">
        <div class="menus">
            <?php
                foreach($menu as $datas) :
                $menus = new \blog\app\models\Menus($datas)
            ?>
                <p><a href="<?= $menus->lien(); ?>" class="menus-btn"><?= $menus->menus(); ?></a></p>
            <?php
                endforeach;
            ?>
        </div>
        <div class="admin">
            <h2>Bienvenue dans l'administration du blog</h2>
            <div class="recap-admin">
                <h3>Messages signalés</h3>
                <?php
                    foreach ($comment as $datas) :
                        $comments = new \blog\app\models\Comments($datas);
                    ?>
                    <form action="index.php?action=adminreport&update=ok" method="post">
                        <textarea id="comments_area" name="comments_area"><?= $comments->comments(); ?></textarea>
                        <p><input type="submit" value="Mettre à jour" class="sub-btn"></p>
                    </form>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
    </div>
</section>

<?php

$content = ob_get_clean();

require('app/views/tpl/front_tpl.php');

?>
