<?php
namespace App\Controller\Admin;

use Core\Controller;

class AdminArticleController extends Controller
{
    public function index()
    {
        $this->render("admin/articles/list.phtml");
    }

    public function create()
    {
        $this->render("admin/articles/add.phtml");
    }
}