<?php

namespace CeddyG\ClaraLanguage\Repositories;

use CeddyG\QueryBuilderRepository\QueryBuilderRepository;

class TextLangRepository extends QueryBuilderRepository
{
    protected $sTable = 'text_lang';

    protected $sPrimaryKey = 'id_text_lang';
    
    protected $aRelations = [
        'lang'
    ];

    protected $aFillable = [
        'fk_lang',
        'fk_traduction',
		'lang_name'
    ];
    
    public function lang()
    {
        return $this->belongsTo('CeddyG\ClaraLanguage\Repositories\LangRepository', 'fk_lang');
    }
}
