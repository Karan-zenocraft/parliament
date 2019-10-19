<?php
namespace frontend\components;

use yii\base\Widget;

class HelloWidget extends Widget
{
    public function run()
    {
        return $this->render('/site/leftLayout', array(

        ));
    }
}
