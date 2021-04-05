<?php
namespace Core\Routing;

class Template
{

    public function getSiteLayout()
    {
        \ob_start();
        include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "layouts" .  DIRECTORY_SEPARATOR . "siteLayout.phtml";
        return \ob_get_clean();
    }
    
    public function getAdminLayout()
    {
        \ob_start();
        include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "layouts" .  DIRECTORY_SEPARATOR . "adminLayout.phtml";
        return \ob_get_clean();
    }


    public function getView($view, $data = [])
    {
        $viewFile =  dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR. "App" . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $view);
        if(\file_exists($viewFile)){
            \ob_start();
            extract($data, EXTR_SKIP);
            include $viewFile;
            return \ob_get_clean();
        }

    }
}