<?php

namespace CeddyG\ClaraLanguage\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class LangRepository extends QueryBuilderRepository
{
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
    
    public function __construct()
    {
        $this->sTable       = config('clara-lang.table', 'lang');
        $this->sPrimaryKey  = config('clara-lang.primary_key', 'id_lang');
    }
    
    protected function getActiveLabelAttribute($oItem)
    {
        return $oItem->lang_active == 0 ? __('clara-lang.no') : __('clara-lang.yes');
    }
    
    public function text_lang()
    {
        return $this->hasMany('CeddyG\ClaraLanguage\Repositories\TextLangRepository', 'fk_lang');
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
