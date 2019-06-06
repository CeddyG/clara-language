<?php

namespace CeddyG\ClaraLanguage;

use App;
use File;

class ClaraLang
{
    /**
     * Get the lang id with his code.
     * @param string $sCode
     * 
     * @return int
     */
    public function getIdByCode($sCode)
    {
        return array_keys(config('clara.lang.iso'), $sCode)[0];
    }
    
    public function getActiveLang()
    {
        $aActiveLang    = config(
            'clara.lang.active', 
            [
                $this->getIdByCode(App::getLocale()) => App::getLocale()
            ]
        );
        
        $aLang = [];
        
        foreach ($aActiveLang as $iIdLang => $sLang)
        {
            $aLang[$iIdLang] = __('clara-lang::code.'.$sLang);
        }
        
        return $aLang;
    }
    
    /**
     * Activate a list of lang.
     * 
     * @param array $aLang Array with iso code of languages to activate.
     */
    public function setActiveLang(array $aLang)
    {
        $aNewConfig = [];
        foreach ($aLang as $sValue)
        {
            $aNewConfig[] = "    ".$this->getIdByCode($sValue)." => '".$sValue."'";
        }
        
        $this->createFile('clara.lang.active.php', [
            'Config' => implode(",\n", $aNewConfig)
        ]);
    }
    
    /**
     * Create the file and the directory if needed.
     * 
     * @param string $sFileName 
     * @param array $aDummies Array to contains all dummies with their values.
     * 
     * @return void
     */
    protected function createFile($sFileName, $aDummies)
    {
        $sPath = $this->makeDirectory($sFileName);
        
        File::put($sPath, $this->buildFile($aDummies));
    }
    
    /**
     * Build the directory for the class if necessary.
     *
     * @param  string $sFileName
     * 
     * @return string $sPath
     */
    protected function makeDirectory($sFileName)
    {
        $sPath = base_path().'/config/'.$sFileName;
            
        if (!File::isDirectory(dirname($sPath))) 
        {
            File::makeDirectory(dirname($sPath), 0777, true, true);
        }
        
        return $sPath;
    }
    
    /**
     * Build the content of the file in replace the dummies.
     * 
     * @param array $aDummies Array to contains all dummies with their values.
     * 
     * @return string $sStub Content of the file.
     */
    protected function buildFile($aDummies)
    {
        $sStub = File::get(__DIR__.'/../resources/blueprints/config.stub');
        
        foreach ($aDummies as $sDummy => $sValue)
        {
            $sStub = str_replace('Dummy'.$sDummy, $sValue, $sStub);
        }
        
        return $sStub;
    }
}
