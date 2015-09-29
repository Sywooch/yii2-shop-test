<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\behaviors;

use rico\yii2images\behaviors\ImageBehave;

class ImageBehavior extends ImageBehave
{
    /**
     * вытягиваем все главные картинки
     * @param array $arItems
     * @param string $modelName
     * @return array
     */
    public function getImagesMain($arItems,$modelName)
    {
        if ($this->getModule()->className === null) {
            $imageQuery = Image::find();
        } else {
            $class = $this->getModule()->className;
            $imageQuery = $class::find();
        }
        $imageQuery->where([
            'isMain' => 1,
            'itemId' => $arItems,
            'modelName' => $modelName,
        ]);
        //$imageQuery->orderBy(['isMain' => SORT_DESC, 'id' => SORT_ASC]);

        $imageRecords = $imageQuery->all();
        $imageRecordsAr['items'] = [];
        $imageRecordsAr['placeholder'] = $this->getModule()->getPlaceHolder();
        foreach ($imageRecords as $value) {
            $imageRecordsAr['items'][$value->itemId] = $value;
        }
        return $imageRecordsAr;
    }
}