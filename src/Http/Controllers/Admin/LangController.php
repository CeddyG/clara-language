<?php

namespace CeddyG\ClaraLanguage\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App;
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
        
        $aLangs         = config('clara.lang.iso');
        $aActiveLangs   = config('clara.lang.active', [App::getLocale()]);
        
        $iCountActive   = count($aActiveLangs);
        
        $aActive    = [];
        
        for ($i = 0 ; $i < $iCountActive ; $i++)
        {
            $aActive[] = 1;
        }
        
        $aActiveLangs   = array_combine($aActiveLangs, $aActive);
        
        return view('clara-lang::admin.lang.index', compact('sPageTitle', 'aLangs', 'aActiveLangs'));
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
