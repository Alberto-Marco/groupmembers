<?php

namespace humhub\modules\groupmembers\controllers;

use Yii;
use humhub\modules\admin\components\Controller;
use humhub\modules\groupmembers\forms\GroupMembersConfigureForm;

/**
 * Defines the configure actions.
 *
 * @package humhub.modules.groupmembers.controllers
 * @author Marjana Pesic
 */
class ConfigController extends Controller
{

    /**
     * Configuration Action for Super Admins
     */
    public function actionConfig()
    {
        $form = new GroupMembersConfigureForm();

        if ($form->load(Yii::$app->request->post()) && $form->save()) {
            $this->view->saved();
        }

        return $this->render('config', ['model' => $form]);
    }

}
