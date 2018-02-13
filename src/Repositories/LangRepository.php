<?php

namespace CeddyG\ClaraLanguage\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

use App;

class LangRepository extends QueryBuilderRepository
{
    protected $iIdCurrentLang = 0;

    protected $aFillable = [
        'lang_code',
		'lang_active'
    ];
    
    protected $aRelations = [
        'text_lang'
    ];
    
    /**
     * List of the customs attributes.
     * 
     * @var array
     */
    protected $aCustomAttribute = [
        'active_label' => [
            'lang_active'
        ],
        'name' => [
            'traduction_lang.lang_name'
        ]
    ];
    
    public function __construct()
    {
        $this->sTable       = config('clara-lang.table', 'lang');
        $this->sPrimaryKey  = config('clara-lang.primary_key', 'id_lang');
        
        $this->iIdCurrentLang = (int) $this->findByField('lang_code', App::getLocale(), ['id_lang'])
            ->first()
            ->id_lang;
    }
    
    protected function getActiveLabelAttribute($oItem)
    {
        return $oItem->lang_active == 0 ? __('clara-lang.no') : __('clara-lang.yes');
    }
    
    protected function getNameAttribute($oItem)
    {
        return $oItem->text_lang->first()->lang_name;
    }
    
    public function traduction_lang()
    {
        return $this->hasMany('CeddyG\ClaraLanguage\Repositories\TextLangRepository', 'fk_lang', [['fk_traduction', '=', $this->iIdCurrentLang]]);
    }
    
    public function text_lang()
    {
        return $this->hasMany('CeddyG\ClaraLanguage\Repositories\TextLangRepository', 'fk_lang');
    }

    public function getIdCurrentLang()
    {
        return $this->iIdCurrentLang;
    }
    
    public function getActiveLang()
    {
        return $this->findWhere(
            [
                ['lang_active', '=', 1]                
            ], 
            ['id_lang', 'name']
        );
    }
}
