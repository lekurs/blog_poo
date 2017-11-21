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
            <form action="index.php?action=adminuser&amp;up=ok" id="update-user" method="post">
                <input type="hidden"  id="idUser" name="idUser">
                <input type="hidden"  id="rankUser" name="rankUser">
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
                    <tbody>
                <?php
                    $userManager = new \blog\app\models\UserManager();
                    $users = $userManager->getRankUser($rank->id());
                        foreach ($users as $datas) :
                            $user = new \blog\app\models\User($datas);
                ?>
                            <tr class="inter-chapter-table">
                                <td class="admin-number-comment-table"><?= $user->username(); ?></td>
                                <td class="admin-comment-update">
                                        <div class="select-contain">
                                            <input type="hidden" class="hidd-id" value="<?= $user->idUser(); ?>">
                                            <div class="select">
                                                <select name="rank" class="select-rank">
                                                    <?php
                                                    foreach ($ranks as $datas) :
                                                        $allRank = new \blog\app\models\RankUsers($datas);
                                                    ?>
                                                    <option value="<?= $allRank->id(); ?>" name="opt-rank" class="option-rank"><?= strtoupper($allRank->role()); ?></option>
                                                    <?php
                                                        endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                </td>
                                <td class="admin-comment-delete"><a href="index.php?action=deluser&amp;u=<?= $user->idUser();?>"><i class="fa fa-trash"></i></a></td>
                            </tr>
                <?php
                      endforeach;
                endforeach;
                    ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require ('app/views/tpl/front_tpl.php');
?>
