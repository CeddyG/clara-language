<?php

namespace CeddyG\ClaraLanguage\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class LangRepository extends QueryBuilderRepository
{
    protected $sTable = 'lang';

    protected $sPrimaryKey = 'id_lang';
    
    protected $sDateFormatToGet = 'd/m/Y';

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
