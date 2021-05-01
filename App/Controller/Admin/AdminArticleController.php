<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Form\ArticleAddForm;

class AdminArticleController extends Controller {

    private $request;

    private $response;

    private $addArticleForm;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->userRegisterForm = new ArticleAddForm();
    }
    public function index()
    {
        $this->render("admin/articles/list.phtml");
    }

    public function create()
    {
        $form = new ArticleAddForm();
        $addArticle = $form->getForm();
        
        $this->render("admin/articles/add.phtml", ['addArticle'=>$addArticle]);
    }
}