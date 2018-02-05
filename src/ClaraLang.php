<?php

namespace CeddyG\ClaraLanguage;

use Illuminate\Translation\Translator;

use CeddyG\ClaraLanguage\Repositories\LangRepository;

/**
 * Description of ClaraLang
 *
 * @author Ceddyg
 */
class ClaraLang extends Translator
{
	public function __call($method, $parameters)
	{
		if (method_exists('LangRepository', $method))
		{
			$oLangRepository = new LangRepository();
			return $oLangRepository->$method($parameters);
		}
	}
}
