<?php

namespace CeddyG\ClaraLanguage\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use CeddyG\ClaraLanguage\ClaraLang;

class LangController extends Controller
{
    protected $oClaraLang;

    public function __construct(ClaraLang $oClaraLang)
    {
        $this->oClaraLang = $oClaraLang;
    }
    
    public function index()
    {
        $sPageTitle = __('clara-lang::lang.language');
        
        $aLangs = config('clara.lang.iso');
        
        return view('clara-lang::admin.lang.index', compact('sPageTitle', 'aLangs'));
    }
    
    public function store(Request $oRequest)
    {
        $aInputs = $oRequest->all();
        
        $aActive = [];
        foreach ($aInputs as $sLang => $iVal)
        {
            if ((int)$iVal == 1)
            {
               $aActive[] = $sLang;
            }
        }
        
        $this->oClaraLang->setActiveLang($aActive);
        
        return redirect(config('clara.lang.route.web.prefix'));
    }
}
