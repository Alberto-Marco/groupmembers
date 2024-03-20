<?php

namespace humhub\modules\groupmembers;

use humhub\modules\groupmembers\widgets\GroupMembersSidebarWidget;
use humhub\modules\groupmembers\forms\GroupMembersConfigureForm;
use yii\helpers\Url;

use Yii;
use humhub\modules\space\models\Space;

class Module extends \humhub\components\Module
{

    /**
     * @inerhitdoc
     */
    public $resourcesPath = 'resources';

    public static function onSidebarInit($event)
    {
        $config = new GroupMembersConfigureForm();

        $space = $event->sender->space;

        // Ora che hai confermato che si tratta di un oggetto Space, puoi accedere all'ID
        $spaceId = $space->id;
        
        $targetSpaceId = $config->spaceId;
        if($spaceId == $targetSpaceId){
            $event->sender->addWidget(GroupMembersSidebarWidget::class, [], ['sortOrder' => $config->position]);

        }

    }

    /**
     * @inerhitdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/groupmembers/config/config']);
    }

}
