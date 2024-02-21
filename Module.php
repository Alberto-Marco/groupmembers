<?php

namespace humhub\modules\groupmembers;

use humhub\modules\groupmembers\widgets\GroupMembersSidebarWidget;
use humhub\modules\groupmembers\forms\GroupMembersConfigureForm;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{

    /**
     * @inerhitdoc
     */
    public $resourcesPath = 'resources';

    public static function onSidebarInit($event)
    {
        $config = new GroupMembersConfigureForm();
        $event->sender->addWidget(GroupMembersSidebarWidget::class, [], ['sortOrder' => $config->position]);
    }

    /**
     * @inerhitdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/groupmembers/config/config']);
    }

}
