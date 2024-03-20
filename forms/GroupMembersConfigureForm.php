<?php

namespace humhub\modules\groupmembers\forms;

use humhub\modules\groupmembers\Module;
use Yii;
use yii\base\Model;

class GroupMembersConfigureForm extends Model
{
    /**
     * @var Module $module
     */
    public $module;

    /**
     * @var string $panelTitle
     */
    public $panelTitle;

    /**
     * @var int $maxMembers
     */
    public $maxMembers;

        /**
     * @var int $position
     */
    public $position;

    /**
     * @var string $groupName
     */
    public $groupName;

        /**
     * @var int $spaceId
     */
    public $spaceId;

    /**
     * @var bool $displayForMembers
     */
    public $displayForMembers;

    /**
     * @var bool $displayForGuests
     */
    public $displayForGuests;

    public function init()
    {
        parent::init();

        $this->module = Yii::$app->getModule('groupmembers');

        $this->panelTitle = $this->module->settings->get('panelTitle') ?: Yii::t('GroupmembersModule.base', 'Group Members');
        $this->maxMembers = (int)$this->module->settings->get('maxMembers', 10);
        $this->position = (int)$this->module->settings->get('position', 00);
        $this->groupName = $this->module->settings->get('groupName') ?: Yii::t('GroupmembersModule.base', 'Administrators');
        $this->spaceId = $this->module->settings->get('spaceId', 00);
        $this->displayForMembers = (bool)$this->module->settings->get('displayForMembers', true);
        $this->displayForGuests = (bool)$this->module->settings->get('displayForGuests', true);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maxMembers'], 'required'],
            [['panelTitle'], 'string'],
            ['maxMembers', 'integer', 'min' => '0'],
            ['position', 'integer', 'min' => '0'],
            [['groupName'], 'string'],
            ['spaceId', 'integer', 'min' => '0'],
            [['displayForMembers', 'displayForGuests'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'panelTitle' => Yii::t('GroupmembersModule.base', 'The panel title for the dashboard widget.'),
            'maxMembers' => Yii::t('GroupmembersModule.base', 'The number of most active users that will be shown.'),
            'position' => Yii::t('GroupmembersModule.base', 'The number of position humhub.'),
            'groupName' => Yii::t('GroupmembersModule.base', 'The name of the group with user to show'),
            'spaceId' => Yii::t('GroupmembersModule.base', 'The id of the space where show widget'),
            'displayForMembers' => Yii::t('GroupmembersModule.base', 'For logged in members'),
            'displayForGuests' => Yii::t('GroupmembersModule.base', 'For guests'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
            'groupName' => Yii::t('GroupmembersModule.base', 'Without this value you cant use the plugin.'),
        ];
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->module->settings->set('panelTitle', $this->panelTitle);
        $this->module->settings->set('maxMembers', $this->maxMembers);
        $this->module->settings->set('position', $this->position);
        $this->module->settings->set('groupName', $this->groupName);
        $this->module->settings->set('spaceId', $this->spaceId);
        $this->module->settings->set('displayForMembers', $this->displayForMembers);
        $this->module->settings->set('displayForGuests', $this->displayForGuests);

        return true;
    }

    /**
     * Check if the widget is visible on dashboard for current User
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        if ($this->maxMembers < 1) {
            // Nothing to display
            return false;
        }

        return Yii::$app->user->isGuest ? $this->displayForGuests : $this->displayForMembers;
    }

}
