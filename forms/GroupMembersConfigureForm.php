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
     * @var string $fromDate
     */
    public $fromDate;

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
        $this->fromDate = $this->module->settings->get('fromDate');
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
            ['fromDate', 'date', 'format' => 'yyyy-MM-dd hh:mm:ss'],
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
            'fromDate' => Yii::t('GroupmembersModule.base', 'From which registration date should new users displayed as new?'),
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
            'fromDate' => Yii::t('GroupmembersModule.base', 'This value is maybe necessary after an import from existing users. Let it empty if your user base grows naturally.'),
        ];
    }

    public function save(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->module->settings->set('panelTitle', $this->panelTitle);
        $this->module->settings->set('maxMembers', $this->maxMembers);
        $this->module->settings->set('fromDate', $this->fromDate);
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
