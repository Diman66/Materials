<?php

class CategoriesController extends Controller {
    private $pageHeader = '/views/layout/header.php';
    private $pageFooter = '/views/layout/footer.php';
    private $pageTpl = '/views/list-category.tpl.php';

    public function __construct() {
        $this->model = new CategoriesModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = "Категории";

        $categories = $this->model->getCategories();
        $this->pageData['categories'] = $categories;

        $this->view->render($this->pageHeader, $this->pageData);
		$this->view->render($this->pageTpl, $this->pageData);
		$this->view->render($this->pageFooter, $this->pageData);
    }
}