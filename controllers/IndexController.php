<?php

class IndexController extends Controller {
	private $pageHeader = '/views/layout/header.php';
	private $pageTpl = '/views/main.tpl.php';
	private $pageFooter = '/views/layout/footer.php';



	public function __construct() {
		$this->model = new IndexModel();
		$this->view = new View();
	}


	public function index() {
		$this->pageData['title'] = "главная";
		$this->view->render($this->pageHeader, $this->pageData);
		$this->view->render($this->pageTpl, $this->pageData);
		$this->view->render($this->pageFooter, $this->pageData);
	}



}