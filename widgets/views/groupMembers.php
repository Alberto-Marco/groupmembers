<?php

use humhub\modules\user\models\User;
use humhub\widgets\PanelMenu;
use yii\helpers\Html;

/* @var string $title */
/* @var User[] $groupUsers */
?>

<div class="panel panel-default" id="panel-group-people">
    <?= PanelMenu::widget(['id' => 'panel-group-people']); ?>
    <div class="panel-heading">
        <b><?= $title; ?></b>
    </div>
    <div class="panel-body">
        <?php foreach ($groupUsers as $user) : ?>
            <a href="<?= $user->getUrl(); ?>">
                <img src="<?= $user->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                     height="40" width="40" alt="40x40" data-src="holder.js/40x40"
                     style="width: 40px; height: 40px;"
                     data-toggle="tooltip" data-placement="top" title=""
                     data-original-title="<?= Html::encode($user->displayName); ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>
