<?php

use humhub\libs\Html;
use humhub\modules\groupmembers\forms\GroupMembersConfigureForm;
use humhub\widgets\Button;
use yii\bootstrap\ActiveForm;

/* @var GroupMembersConfigureForm $model */
?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Yii::t('GroupmembersModule.base', '<strong>Group Members</strong> Module Configuration'); ?></div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'panelTitle') ?>
        <?= $form->field($model, 'maxMembers') ?>
        <?= $form->field($model, 'position') ?>
        <?= $form->field($model, 'groupName') ?>
        <?= $form->field($model, 'spaceId') ?>

        <?= Html::label(Yii::t('GroupmembersModule.base', 'Show on dashboard'), null, ['class' => 'control-label']) ?>
        <?= $form->field($model, 'displayForMembers')->checkbox() ?>
        <?= $form->field($model, 'displayForGuests')->checkbox() ?>

        <hr>

        <?= Button::save()->submit() ?>
        <?= Button::defaultType(Yii::t('GroupmembersModule.base', 'Back to modules'))->link(['/admin/module']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
