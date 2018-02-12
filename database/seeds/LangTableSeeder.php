<?php

use Illuminate\Database\Seeder;

class LangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(config('clara-lang.table', 'lang'))->insert([[
            'lang_code'     => 'fr',
            'lang_active'   => 1
        ],
        [
            'lang_code'     => 'en',
            'lang_active'   => 0
        ]]);
        
        $oLangs = ClaraLang::findWhereIn('lang_code', ['fr', 'en'], ['id_lang', 'lang_code']);
        
        $iIdFr = $oLangs->where('lang_code', 'fr')->first()->id_lang;
        $iIdEn = $oLangs->where('lang_code', 'en')->first()->id_lang;
        
        DB::table('text_lang')->insert([[
            'fk_lang'           => $iIdFr,
            'fk_traduction'     => $iIdFr,
            'lang_name'         => 'Français'
        ],
        [
            'fk_lang'           => $iIdFr,
            'fk_traduction'     => $iIdEn,
            'lang_name'         => 'French'
        ],
        [
            'fk_lang'           => $iIdEn,
            'fk_traduction'     => $iIdEn,
            'lang_name'         => 'English'
        ],
        [
            'fk_lang'           => $iIdEn,
            'fk_traduction'     => $iIdFr,
            'lang_name'         => 'Anglais'
        ]]);
    }
}
