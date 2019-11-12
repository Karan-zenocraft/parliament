<?php

namespace common\models;

class Pages extends \common\models\base\PagesBase
{

	/**
* @inheritdoc
*/
public function rules()
{
return [
            [['page_title', 'page_content'], 'required'],
            [['page_content', 'meta_description'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['custom_url', 'page_title', 'meta_title', 'meta_keyword'], 'string', 'max' => 255],
            [['page_title','meta_title','meta_keyword'],'trim']
        ];
}
    
}