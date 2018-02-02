<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 1/02/18
 * Time: 11:34 AM
 */

if (! function_exists('tt')) {
    /**
     *
     * I18n generica ver documentación
     * @param string/array $param1
     * @param string/array/number/boolean $param2 [Optional]
     * @return string|array
     *
     * @author Juan Esteban Moreno
     */
    function tt($param1 = null, $param2 = null) {
        $id = null;
        $locale = null;
        $parameters = [];
        $number = 0;
        $plurals = false;
        $domain = 'messages';
        $id_empresa = null;
        if(gettype($param1)=='string') {
            $id = $param1;
            switch(gettype($param2)) {
                case 'string':
                    switch ($param2) {
                        case TT_CONFIG:
                            $array = config($param1);
                            foreach ($array as $key => $value)
                                $array[$key] = tt($value);
                            return $array;
                            break;
                        case TT_EQUIVALENCES:
                            if (is_array($lang = trans($id))) {
                                $lang = array_map('strtolower', $lang);
                                return array_map('revert_slug', array_flip($lang));
                            }
                    }
                    $locale = $param2;
                    break;
                case 'array':
                    $parameters = $param2;
                    break;
                case 'integer':
                    $plurals = true;
                    $number = $param2;
                    break;
                case 'boolean':
                    $plurals = true;
                    $number = $param2 == TT_SINGULAR ? 1 : 0;
                    break;
                case "NULL":
                    break;
                default:
                    throw new Exception('$param2: Type not supported');
                    break;
            }
        } else if ($param1 === null)
            return trans();
        else
            throw new Exception('$param1: Type not supported');

        if (session()->has(LANG_PREFIX.$id))
            $id = session(LANG_PREFIX.$id);
        else if(getType(trans($id)) == 'array')
            $id .= '.xx';

        if($plurals)
            return trans_choice($id, $number, $parameters, $domain, $locale);
        return explode('|',trans($id, $parameters, $domain, $locale))[0];
    }
}

if (! function_exists('accents')) {
    function accents($subject){
        $search  = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ã¡,Ã©,Ã­,Ã³,Ãº,Ã±,ÃÃ¡,ÃÃ©,ÃÃ­,ÃÃ³,ÃÃº,ÃÃ±,Ã“,Ã ,Ã‰,Ã ,Ãš,â€œ,â€ ,Â¿,ü,Ã‘,â€¨,Â");
        $replace = explode(",","á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,á,é,í,ó,ú,ñ,Á,É,Í,Ó,Ú,Ñ,Ó,Á,É,Í,Ú,\",\",¿,&uuml;,Ñ,,&nbsp;");
        $s = str_replace($search, $replace, $subject);
        $s = str_replace("\u00c3\u0080", "&Agrave;", $s);
        $s = str_replace(["\u00c3\u0081", 'Á'], "&Aacute;", $s);
        $s = str_replace("\u00c3\u0082", "&Acirc;", $s);
        $s = str_replace("\u00c3\u0083", "&Atilde;", $s);
        $s = str_replace("\u00c3\u0084", "&Auml;", $s);
        $s = str_replace("\u00c3\u0085", "&Aring;", $s);
        $s = str_replace("\u00c3\u0086", "&AElig;", $s);
        $s = str_replace("\u00c3\u00a0", "&agrave;", $s);
        $s = str_replace(["\u00c3\u00a1", 'á'], "&aacute;", $s);
        $s = str_replace("\u00c3\u00a2", "&acirc;", $s);
        $s = str_replace("\u00c3\u00a3", "&atilde;", $s);
        $s = str_replace("\u00c3\u00a4", "&auml;", $s);
        $s = str_replace("\u00c3\u00a5", "&aring;", $s);
        $s = str_replace("\u00c3\u00a6", "&aelig;", $s);
        $s = str_replace("\u00c3\u0087", "&Ccedil;", $s);
        $s = str_replace("\u00c3\u00a7", "&ccedil;", $s);
        $s = str_replace("\u00c3\u0090", "&ETH;", $s);
        $s = str_replace("\u00c3\u00b0", "&eth;", $s);
        $s = str_replace("\u00c3\u0088", "&Egrave;", $s);
        $s = str_replace(["\u00c3\u0089", 'É'], "&Eacute;", $s);
        $s = str_replace("\u00c3\u008a", "&Ecirc;", $s);
        $s = str_replace("\u00c3\u008b", "&Euml;", $s);
        $s = str_replace("\u00c3\u00a8", "&egrave;", $s);
        $s = str_replace(["\u00c3\u00a9", 'é'], "&eacute;", $s);
        $s = str_replace("\u00c3\u00aa", "&ecirc;", $s);
        $s = str_replace("\u00c3\u00ab", "&euml;", $s);
        $s = str_replace("\u00c3\u008c", "&Igrave;", $s);
        $s = str_replace(["\u00c3\u008d", 'Í'], "&Iacute;", $s);
        $s = str_replace("\u00c3\u008e", "&Icirc;", $s);
        $s = str_replace("\u00c3\u008f", "&Iuml;", $s);
        $s = str_replace("\u00c3\u00ac", "&igrave;", $s);
        $s = str_replace(["\u00c3\u00ad", 'í'], "&iacute;", $s);
        $s = str_replace("\u00c3\u00ae", "&icirc;", $s);
        $s = str_replace("\u00c3\u00af", "&iuml;", $s);
        $s = str_replace("\u00c3\u0091", "&Ntilde;", $s);
        $s = str_replace("\u00c3\u00b1", "&ntilde;", $s);
        $s = str_replace("\u00c3\u0092", "&Ograve;", $s);
        $s = str_replace(["\u00c3\u0093", 'Ó'], "&Oacute;", $s);
        $s = str_replace("\u00c3\u0094", "&Ocirc;", $s);
        $s = str_replace("\u00c3\u0095", "&Otilde;", $s);
        $s = str_replace("\u00c3\u0096", "&Ouml;", $s);
        $s = str_replace("\u00c3\u0098", "&Oslash;", $s);
        $s = str_replace("\u00c5\u0092", "&OElig;", $s);
        $s = str_replace("\u00c3\u00b2", "&ograve;", $s);
        $s = str_replace(["\u00c3\u00b3", 'ó'], "&oacute;", $s);
        $s = str_replace("\u00c3\u00b4", "&ocirc;", $s);
        $s = str_replace("\u00c3\u00b5", "&otilde;", $s);
        $s = str_replace("\u00c3\u00b6", "&ouml;", $s);
        $s = str_replace("\u00c3\u00b8", "&oslash;", $s);
        $s = str_replace("\u00c5\u0093", "&oelig;", $s);
        $s = str_replace("\u00c3\u0099", "&Ugrave;", $s);
        $s = str_replace(["\u00c3\u009a", 'Ú'], "&Uacute;", $s);
        $s = str_replace("\u00c3\u009b", "&Ucirc;", $s);
        $s = str_replace("\u00c3\u009c", "&Uuml;", $s);
        $s = str_replace("\u00c3\u00b9", "&ugrave;", $s);
        $s = str_replace(["\u00c3\u00ba", 'ú'], "&uacute;", $s);
        $s = str_replace("\u00c3\u00bb", "&ucirc;", $s);
        $s = str_replace("\u00c3\u00bc", "&uuml;", $s);
        $s = str_replace("\u00c3\u009d", "&Yacute;", $s);
        $s = str_replace("\u00c5\u00b8", "&Yuml;", $s);
        $s = str_replace("\u00c3\u00bd", "&yacute;", $s);
        $s = str_replace("\u00c3\u00bf", "&yuml;", $s);
        return $s;
    }
}

if (! function_exists('trans')) {
    /**
     * Translate the given message.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    function trans($id = null, $parameters = [], $domain = 'messages', $locale = null)
    {
        if (is_null($id)) {
            return app('translator');
        }

        return app('translator')->trans($id, $parameters, $domain, $locale);
    }
}

if (! function_exists('trans_choice')) {
    /**
     * Translates the given message based on a count.
     *
     * @param  string  $id
     * @param  int|array|\Countable  $number
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    function trans_choice($id, $number, array $parameters = [], $domain = 'messages', $locale = null)
    {
        return app('translator')->transChoice($id, $number, $parameters, $domain, $locale);
    }
}