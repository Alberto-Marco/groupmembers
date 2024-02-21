<?php

namespace humhub\modules\groupmembers\widgets;

use humhub\components\Widget;
use humhub\modules\groupmembers\forms\GroupMembersConfigureForm;
use humhub\modules\user\models\User;
use humhub\modules\user\models\GroupUser;
use humhub\modules\user\models\Group;

/**
 * Shows newly registered members as sidebar widget on the dashboard
 *
 * @package humhub.modules_core.directory.widgets
 * @since 0.11
 * @author Andreas Strobel
 */
class GroupMembersSidebarWidget extends Widget
{

    /**
     * Execute widget
     */
    public function run()
    {
        $config = new GroupMembersConfigureForm();

        if (!$config->isVisible()) {
            return '';
        }

        $group = Group::findOne(['name' => 'AmbitoA']);
        $groupUsers = [];
        if($group == null)
        {
            return '';
        }

        $groupUsersIncomplete = GroupUser::findAll(['group_id' => $group->id]);

        foreach ($groupUsersIncomplete as $groupUser) {
        // Ottieni l'oggetto utente completo
        $user = User::findOne(['id' => $groupUser->user_id]);
        if ($user !== null) {
            // Stampa i dettagli dell'utente, ad esempio l'email
            // Aggiungi l'oggetto utente all'array di utenti
            $groupUsers[] = $user;
        }
    }


        if (empty($groupUsers)) {
            return '';
        }

        return $this->render('groupMembers', [
            'groupUsers' => $groupUsers,
            'title' => $config->panelTitle,
        ]);
    }

}
