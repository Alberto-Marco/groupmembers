<?php

namespace humhub\modules\groupmembers;

use humhub\modules\groupmembers\widgets\GroupMembersSidebarWidget;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{

    /**
     * @inerhitdoc
     */
    public $resourcesPath = 'resources';

    public static function onSidebarInit($event)
    {
        $event->sender->addWidget(GroupMembersSidebarWidget::class, [], ['sortOrder' => 100]);
    }

    /**
     * @inerhitdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/groupmembers/config/config']);
    }

}
