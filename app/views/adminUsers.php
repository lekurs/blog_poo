<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/11/2017
 * Time: 11:47
 */

$title = 'Administration des utilisateurs';

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
            <h2>Gestion des Utilisateurs</h2>
            <table class="admin-comments-table">
            <?php
            foreach($ranks as $datas) :
                $rank = new \blog\app\models\RankUsers($datas);
            ?>
                <thead>
                    <tr>
                        <th><?= $rank->role();?></th>
                        <th>Modif</th>
                        <th>Suppr</th>
                    </tr>
                </thead>
            <?php
                $userManager = new \blog\app\models\UserManager();
                $users = $userManager->getRankUser($rank->id());
                    foreach ($users as $datas) :
                        $user = new \blog\app\models\User($datas);
            ?>
                        <tbody>
                        <tr class="inter-chapter-table">
                            <td class="admin-number-comment-table"><?= $user->username(); ?></td>
                            <td class="admin-comment-update">
                                <select name="rank">
                                    <?php
                                    foreach ($ranks as $datas) :
                                        $allRank = new \blog\app\models\RankUsers($datas);
                                    ?>
                                    <option><?= $allRank->role(); ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                </select>
                                <input type="submit" value="" name="update-rank"><i class="fa fa-check-circle"></i>
                            </td>
                            <td class="admin-comment-delete"><a href="index.php?action=delcomm&amp;comm=<?= $user->idUser();?>"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        </tbody>
            <?php
                  endforeach;
            endforeach;
                ?>
            </table>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require ('app/views/tpl/front_tpl.php');
?>
