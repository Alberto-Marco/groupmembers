<?php

use humhub\modules\dashboard\widgets\Sidebar;
use humhub\modules\space\widgets\Sidebar as Spacebar;

return [
    'id' => 'groupmembers',
    'class' => 'humhub\modules\groupmembers\Module',
    'namespace' => 'humhub\modules\groupmembers',
    'events' => [
        ['class' => Sidebar::class, 'event' => Sidebar::EVENT_INIT, 'callback' => ['humhub\modules\groupmembers\Module', 'onSidebarInit']],
        ['class' => Spacebar::class, 'event' => Spacebar::EVENT_INIT, 'callback' => ['humhub\modules\groupmembers\Module', 'onSidebarInit']],
    ],
];
?>
