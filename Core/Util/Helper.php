<?php
namespace Core\Util;
use Core\Http\Session;
class Helper
{
    /**
     * @param string $path
     * @return string public folder path
     */
    
    public function getPath(string $path = ""): string
    {
        if(!empty($path)){
            return "/public/" . $path;
        }

        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR;
    }

    public function getFormatedDate()
    {
        
    }

    public function getFlashMessage($key)
    {
        $session = new Session();
        return $session->getMessage($key);
    }

}