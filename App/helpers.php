<?php 

if (!function_exists('base_path')) {
    function base_path($path = ''){
        return __DIR__ . '/..//' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if(!function_exists('env')){
    function env($var, $default = false){
        $value = getenv($var);

        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
                return true;
                break;
            case 'false':
                return false;
                break;
            default:
                return $value;
        }
    }
}

if (!function_exists('redirect')) {
    function redirect($url){
        return new Zend\Diactoros\Response\RedirectResponse($url);
    }
}
