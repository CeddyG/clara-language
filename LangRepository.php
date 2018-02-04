<?php

namespace App\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use Illuminate\Translation\Translator;

class LangRepository extends QueryBuilderRepository
{
    protected $sTable = 'lang';

    protected $sPrimaryKey = 'id_lang';
    
    protected $sDateFormatToGet = 'd/m/Y';
    
    protected $aRelations = [
        'text_category_price',
		'text_category_product',
		'text_channel',
		'text_image_variant',
		'text_lang',
		'text_product',
		'text_variant'
    ];

    protected $aFillable = [
        'lang_code',
		'lang_active'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'active_label' => [
            'lang_active'
        ]
    ];
    
    public function __call()
    {
        
    }
    
    protected function getActiveLabelAttribute($oItem)
    {
        return $oItem->lang_active == 0 ? __('general.no') : __('general.yes');
    }
    
    public function text_lang()
    {
        return $this->hasMany('App\Repositories\TextLangRepository', 'fk_lang');
    }

    public function getActiveLang()
    {
        return $this->findWhere(
            [
                ['lang_active', '=', 1],
                ['text_lang.fk_lang', '=', 1]
            ], 
            ['id_lang', 'text_lang.lang_name']);
    }
}
