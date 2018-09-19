<?php

/*************************************************
 * TheYkk's fw
 * Helpers
 *
 * Author   : Yusuf Kaan Karakaya
 * Web      : http://theykk.net
 *
 * Github   : http://github.com/theykk/fw
 * License  : MIT
 *
 *************************************************/


/**
 * Debug by TheYkk
 */

if (!function_exists('debug')) {

    function debug($var)
    {

        new System\Libs\Debug\Debug($var);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Go back redirect
 *
 */

if (!function_exists('goback')) {
    function goback()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
}

/*---------------------------------------------------------------------------*/

/**
 * Bosluk helper
 */

if (!function_exists('br')) {

    function br($hr = false)
    {


        echo '<br>';

        if ($hr) echo '<hr>';


    }

}

/*---------------------------------------------------------------------------*/

/**
 * Debug Helper
 * @return mixed
 */

if (!function_exists('dd')) {

    function dd($data, $stop = false)

    {

        echo '<pre>';

        print_r($data);

        echo '</pre>';


        if ($stop === true)

            die();

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get current language
 *
 * @return string
 */

if (!function_exists('get_lang')) {

    function get_lang()

    {

        $lang = config('app.general.default_lang');


        if (!Session::has(md5('lang'))) {

            Session::set(md5('lang'), $lang);

            return $lang;

        } else {

            return Session::get(md5('lang'));

        }

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Set language
 *
 * @param string $lang
 * @return void
 */

if (!function_exists('set_lang')) {

    function set_lang($lang = '')

    {

        $language = config('app.general.default_lang');

        $languages = config('app.general.languages');


        if (!is_string($lang))

            return false;


        if (!$languages[$lang]) {

            $lang = $language;

        }

        Session::set(md5('lang'), $lang);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get string with current language
 *
 * @param string $params
 * @param string $change
 * @return bool|mixed
 * @throws Exception
 */

if (!function_exists('lang')) {

    function lang($params = '', $replace = '', $locale = null)

    {

        $config = config('app.general.languages');


        $keys = explode('.', $params);

        // Set lang file

        $file = $keys[0];

        // Get lang file

        if (!is_string($file))

            return false;


        //Set lang

        if (is_string($locale))

            $lan = $locale;

        else

            $lan = get_lang();


        //Get dirs

        $appLangDir = APP_DIR . 'Languages/' . ucwords($config[$lan]) . '/' . ucwords($file) . '.php';

        $sysLangDir = SYSTEM_DIR . 'Languages/' . ucwords($config[$lan]) . '/' . ucwords($file) . '.php';


        if (file_exists($appLangDir))

            $langfile = require $appLangDir;

        elseif (file_exists($sysLangDir))

            $langfile = require $sysLangDir;

        else

            throw new System\Libs\Exception\ExceptionHandler('Dosya bulunamadı', '<b>Language : </b> ' . $file);


        // Remove file item from array

        array_shift($keys);

        // Find the item that requested

        foreach ($keys as $key) {

            $langfile = $langfile[$key];

        }


        if (!is_array($replace)) {

            if (!empty($replace)) {

                return str_replace('%s', $replace, $langfile);

            } else {

                return $langfile;

            }

        } else {

            if (!empty($replace)) {

                $keys = [];

                $vals = [];

                foreach ($replace as $key => $value) {

                    $keys[] = $key;

                    $vals[] = $value;

                }

                return str_replace($keys, $vals, $langfile);

            } else {

                return $langfile;

            }

        }


    }

}

/*---------------------------------------------------------------------------*/

/**
 * Redirect to specified url
 *
 * @param string $url
 * @param integer $delay
 * @return void
 */

if (!function_exists('redirect')) {

    function redirect($url, $delay = 0)

    {

        if ($delay > 0)

            header("Refresh:" . $delay . ";url=" . $url);

        else

            header("Location:" . $url);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Bug fix for ngnix
 *
 * @return array
 */


if (!function_exists('getallheaders')) {

    function getallheaders()
    {
        $headers = [];

        foreach ($_SERVER as $name => $value) {

            if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {

                $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;

            }

        }

        return $headers;
    }

}

/*---------------------------------------------------------------------------*/

/**
 * Define csrf token
 *
 * @return string
 */

if (!function_exists('csrf_token')) {

    function csrf_token()

    {

        Session::set('ykk_token', base64_encode(openssl_random_pseudo_bytes(32)));

        return Session::get('ykk_token');

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Validate csrf token
 *
 * @param string $token
 * @return boolean
 */

if (!function_exists('csrf_check')) {

    function csrf_check()

    {

        if (Session::has('ykk_token')) {

            if (

                @request('_token') == Session::get('ykk_token') ||

                @Request::headers('X-CSRF-TOKEN') == Session::get('ykk_token')

            ) {

                Session::delete('ykk_token');

                return true;

            } else {

                return false;

            }

        } else {

            return false;

        }

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Csrf field
 *
 * @param string $token
 * @return boolean
 */

if (!function_exists('csrf_field')) {


    function csrf_field()

    {

        $field = '<input type="hidden" name="_token" value="' . csrf_token() . '">';

        return $field;

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Csrf meta
 *
 * @param string $token
 * @return boolean
 */

if (!function_exists('csrf_meta')) {

    function csrf_meta()

    {

        $field = '<meta name="csrf-token" content="' . csrf_token() . '">';

        return $field;

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Csrf jquer ajax
 *
 * @param string $token
 * @return boolean
 */

if (!function_exists('csrf_ajax')) {

    function csrf_ajax()

    {

        $field = '<script type="text/javascript">

                        $.ajaxSetup({

                            headers: {

                                \'X-CSRF-TOKEN\': $(\'meta[name="csrf-token"]\').attr(\'content\')

                            }

                        });

                    </script>';

        return $field;

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Csrf jquer ajax
 *
 * @param string $token
 * @return mixed
 */

if (!function_exists('__')) {


    function __()

    {

        $args = func_get_args();

        return call_user_func_array('lang', $args);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get assets
 *
 * @param string $file
 * @return string
 */

if (!function_exists('get_asset')) {

    function get_asset($file, $version = null)

    {

        if (file_exists(ROOT_DIR . '/Public/' . $file))

            return (is_null($version)) ? PUBLIC_DIR . $file : PUBLIC_DIR . $file . '?v=' . $version;

        else

            throw new System\Libs\Exception\ExceptionHandler('Dosya bulunamadı', '<b>Asset : </b> ' . $file);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get files inside Public directory
 *
 * @param string $file
 * @return string
 */

if (!function_exists('public_path')) {

    function public_path($file)

    {

        if (file_exists(ROOT_DIR . '/Public/' . $file))

            return ROOT_DIR . '/Public/' . $file;

        else

            throw new System\Libs\Exception\ExceptionHandler('Dosya bulunamadı', '<b>Public : </b> ' . $file);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get base url
 *
 * @param string $url
 * @return string
 */

if (!function_exists('base_url')) {

    function base_url($url = null)

    {

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')

            $protocol = 'https';

        else

            $protocol = 'http';

        if (is_null($url))

            return $protocol . "://" . $_SERVER['HTTP_HOST'];

        else

            return $protocol . "://" . rtrim($_SERVER['HTTP_HOST'], '/') . '/' . $url;

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get current url
 *
 * @return string
 */

if (!function_exists('current_url')) {

    function current_url()

    {

        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Make internal link
 *
 * @return string
 */

if (!function_exists('link_to')) {

    function link_to($url)

    {

        return BASE_DIR . '/' . $url;

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Reach All Request Data
 *
 * @param string|array/null $params
 * @return array|string
 */

if (!function_exists('request')) {

    function request($params = null)

    {

        $requestMethod = Request::getRequestMethod();


        switch ($requestMethod) {

            case 'GET'      :
                $request = Request::get();
                break;

            case 'POST'     :
                $request = Request::post();
                break;

            case 'PUT'      :
                $request = Request::put();
                break;

            case 'PATCH'    :
                $request = Request::patch();
                break;

            case 'DELETE'   :
                $request = Request::delete();
                break;

            default         :
                $request = Request::all();

        }


        if (is_null($params)) {

            return $request;

        } else {

            if (is_array($params)) {

                foreach ($params as $param) {

                    $data[$param] = $request[$param];

                }

                return $data;

            } else {

                return $request[$params];

            }

        }

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get Config Parameters
 *
 * @param string $params
 * @return mixed
 */

if (!function_exists('config')) {

    function config($params)

    {

        return Config::get($params);

    }

}

/*---------------------------------------------------------------------------*/

/**
 * Get URL of the Named Route
 *
 * @param string $name
 * @param array $params
 * @return string
 */

if (!function_exists('route')) {

    function route($name, $params = [])

    {

        return link_to(System\Libs\Router\Router::getUrl($name, $params));

    }

}

/*---------------------------------------------------------------------------*/

/**
 * URL Slug Generator
 *
 * @param string $str
 * @param array $options
 * @return string
 */

if (!function_exists('slug')) {

    function slug($str, $options = array())
    {

        // Make sure string is in UTF-8 and strip invalid UTF-8 characters

        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());


        $defaults = array(

            'delimiter' => '-',

            'limit' => null,

            'lowercase' => true,

            'replacements' => array(),

            'transliterate' => true,

        );


        // Merge options

        $options = array_merge($defaults, $options);


        $char_map = array(

            // Latin

            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',

            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',

            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',

            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',

            'ß' => 'ss',

            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',

            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',

            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',

            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',

            'ÿ' => 'y',


            // Latin symbols

            '©' => '(c)',


            // Greek

            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',

            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',

            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',

            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',

            'Ϋ' => 'Y',

            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',

            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',

            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',

            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',

            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',


            // Turkish

            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',

            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',


            // Russian

            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',

            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',

            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',

            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',

            'Я' => 'Ya',

            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',

            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',

            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',

            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',

            'я' => 'ya',


            // Ukrainian

            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',

            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',


            // Czech

            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',

            'Ž' => 'Z',

            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',

            'ž' => 'z',


            // Polish

            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',

            'Ż' => 'Z',

            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',

            'ż' => 'z',


            // Latvian

            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',

            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',

            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',

            'š' => 's', 'ū' => 'u', 'ž' => 'z'

        );


        // Make custom replacements

        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);


        // Transliterate characters to ASCII

        if ($options['transliterate']) {

            $str = str_replace(array_keys($char_map), $char_map, $str);

        }


        // Replace non-alphanumeric characters with our delimiter

        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);


        // Remove duplicate delimiters

        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);


        // Truncate slug to max. characters

        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');


        // Remove delimiter from ends

        $str = trim($str, $options['delimiter']);


        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;

    }

}

