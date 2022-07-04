<?php

class TagsController extends Controller {
    private $pageHeader = '/views/layout/header.php';
    private $pageFooter = '/views/layout/footer.php';
    private $pageTpl = '/views/list-tags.tpl.php';

    public function __construct() {
        $this->model = new TagsModel();
        $this->view = new View();
    }

    public function index() {
        $this->pageData['title'] = "Теги";

        $tags = $this->model->getTags();
        $this->pageData['tags'] = $tags;

        $this->view->render($this->pageHeader, $this->pageData);
		$this->view->render($this->pageTpl, $this->pageData);
		$this->view->render($this->pageFooter, $this->pageData);
    }
}