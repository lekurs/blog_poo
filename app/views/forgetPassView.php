<?php
/**
 * Created by PhpStorm.
 * User: Bidule
 * Date: 13/11/2017
 * Time: 13:36
 */

$title = 'Mot de passe oublié';

ob_start();
?>

<section>
  <form action="index.php?action=forget&amp;pass=forget" method="post">
      <p id="input_forget_pass"><input type="email" name="email_forget" id="email_forget" placeholder="Tapez votre email" /><span id="forget_pass_hide"></span></p>
      <p><input type="submit" value="Envoyez" class="sub-btn"></p>
  </form>

    <form action="#" method="post">
        <?= $form->input('text', 'test', 'test', 'test') ;?>
        <?= $form->input('text', 'test2, test2', 'test2') ; ?>
        <?= $form->area('area', 'test d\'un textarea'); ?>
        <?= $form->checkBox('test', 'test', 'test'); ?>
        <?= $form->radio('test', 'test'); ?>
        <?= $form->select('test'); ?>
        <?php $form->optSelect(['test' => 'test', 'test2' => 'test2']); ?>
        <?php var_dump($form->getOptions()); ?>
        <?= $form->submit('testsub', 'Envoyer', 'sub-btn'); ?>
    </form>
</section>

<?php
$content = ob_get_clean();

require ('app/views/tpl/front_tpl.php');
?>
