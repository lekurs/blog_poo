<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 12/11/2017
 * Time: 13:37
 */


$title = 'Administration - Blog Billet pour l\'Alaska';

ob_start();
?>
<section>
    <div class="admin-container">
        <div class="menus">
            <?php
                foreach($menu as $datas) :
                    $menus = new \blog\app\models\Menus($datas);
            ?>
                <p><a href="<?= $menus->lien(); ?>" class="menus-btn"><?= $menus->menus(); ?></a></p>
            <?php
                endforeach;
            ?>
        </div>
        <div class="admin">
            <h2>Bienvenue dans l'administration du blog</h2>
            <div class="recap-admin">
                <div class="admin-chapters">
                    <h3>Vos chapitres diffusés</h3>
                    <div class="admin-chapters-post">
                        <table>
                            <thead>
                            <tr>
                                <th class="admin-title-chapter-table">Titre</th>
                                <th class="admin-resume-chapter-table">Résumé</th>
                                <th class="admin-comm-table"><i class="fa fa-commenting"></i></th>
                                <th class="admin-report-table"><i class="fa fa-commenting"></i>  <i class="fa fa-warning"></i> </th>
                                <th class="admin-chapter-update">Modif</th>
                                <th class="admin-chapter-delete">Suppr</th>
                            </tr>
                            </thead>
                            <?php
                            foreach($chapters as $datas) :
                                $chapter = new \blog\app\models\Chapters($datas);
                                ?>
                                <tbody>
                                <tr class="inter-chapter-table">
                                    <td class="admin-title-chapter-table"><?= $chapter->title(); ?></td>
                                    <td class="admin-resume-chapter-table"><?= nl2br(substr($chapter->chapter(), 0, 200)); ?></td>
                                    <td class="admin-comm-table"><?= $commentManager->nb_comment($chapter->idChapter());?></td>
                                    <td class="admin-report-table"><?= $commentManager->countReportByChapter($chapter->idChapter()); ?></td>
                                    <td class="admin-chapter-update"><a href="index.php?action=adminupdatepost&amp;c=<?=$chapter->idChapter(); ?>" ><i class="fa fa-pencil"></i></a></td>
                                    <td class="admin-chapter-delete"><a href="index.php?action=admin&amp;del=<?= $chapter->idChapter(); ?>&suppr=ok"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                    <p>Total chapitres en ligne : <?= $countChapter; ?></p>
                    <p>Total messages signalés : <?= $reportComments; ?></p>
                </div>
                <div class="admin-chapter-offline">
                    <h3>Vos chapitres à finaliser</h3>
                    <div class="admin-chapters-offline">
                        <table>
                            <thead>
                            <tr>
                                <th class="admin-title-chapter-table">Titre</th>
                                <th class="admin-resume-chapter-table">Résumé</th>
                                <th class="admin-comm-table"><i class="fa fa-commenting"></i></th>
                                <th class="admin-report-table"><i class="fa fa-commenting"></i>  <i class="fa fa-warning"></i> </th>
                                <th class="admin-chapter-update">Modif</th>
                                <th class="admin-chapter-delete">Suppr</th>
                            </tr>
                            </thead>
                            <?php
                            foreach($chapterOffline as $datas) :
                            $chapterOffline = new \blog\app\models\Chapters($datas);
                                ?>
                                <tbody>
                                    <tr class="inter-chapter-table">
                                        <td class="admin-title-chapter-table"><?= $chapterOffline->title(); ?></td>
                                        <td class="admin-resume-chapter-table"><?= substr($chapterOffline->chapter(), 0, 200); ?></td>
                                        <td class="admin-comm-table"><?= $commentManager->nb_comment($chapterOffline->idChapter());?></td>
                                        <td class="admin-report-table"><?= $commentManager->countReportByChapter($chapterOffline->idChapter()); ?></td>
                                        <td class="admin-chapter-update"><a href="index.php?action=adminupdatepost&amp;c=<?=$chapterOffline->idChapter(); ?>" ><i class="fa fa-pencil"></i></a></td>
                                        <td class="admin-chapter-delete"><a href="index.php?action=admin&amp;del=<?= $chapterOffline->idChapter(); ?>&suppr=ok"><i class="fa fa-trash"></i></a> </td>
                                    </tr>
                                </tbody>
                                <?php
                            endforeach;
                            ?>
                        </table>
                    </div>
                </div>
                <div class="admin-user">
                    <h3>Utilisateurs</h3>
                    <?php foreach ($lastUser as $datas) :
                    $user = new \blog\app\models\User($datas);
                    ?>
                    <p>Dernier utilisateur enregistré : <?= $user->username(); ?></p>
                    <?php
                    endforeach;
                    ?>
                    <p>Nombre d'utilisateurs : <?= $userManager->getMaxUsers(); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

$content = ob_get_clean();

require ('app/views/tpl/front_tpl.php');
?>
