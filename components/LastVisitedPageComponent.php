<?php

namespace app\components;

use yii\base\Component;
use yii\helpers\Html;


class LastVisitedPageComponent extends Component
{
    /**
     * Init component
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Return html-string
     *
     * @return string
     */
    public function show()
    {
        $lvp = $this->getLastVisitedPage();
        $this->setLastVisitedPage();

        return Html::tag('p', Html::encode("Предыдущая страница: $lvp"), ['style' => 'text-align: center;']);
    }

    /**
     * Set session variable - 'lastVisitedPage'
     */
    protected function setLastVisitedPage()
    {
        \Yii::$app->session->set('lastVisitedPage', $_SERVER['REQUEST_URI']);
    }

    /**
     * Get session variable - 'lastVisitedPage'
     *
     * @return mixed
     */
    protected function getLastVisitedPage()
    {
        return \Yii::$app->session->get('lastVisitedPage');
    }
}