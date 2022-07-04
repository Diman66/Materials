<?php

class MaterialsController extends Controller {

    // устанавливаем шаблоны для формирования страницы

    private $pageHeader = '/views/layout/header.php';
    private $pageFooter = '/views/layout/footer.php';
    private $pageTpl = '/views/list-materials.tpl.php';

    // подключаются модель и вид

    public function __construct() {
        $this->model = new MaterialsModel();
        $this->view = new View();
    }

    // метод по умолчанию

    public function index() {
        $this->pageData['title'] = "Mатериалы";

        $materials = $this->model->getmaterials();
        $this->pageData['materials'] = $materials;

        $this->view->render($this->pageHeader, $this->pageData);
		$this->view->render($this->pageTpl, $this->pageData);
		$this->view->render($this->pageFooter, $this->pageData);

    }

    // метод создания материала

    public function createMaterial() {
        $this->pageTpl = '/views/create-material.tpl.php';
        $this->pageData['title'] = "Добавить материал";
        $this->pageData['validate'] = "validate";
        if(is_array($_POST) && !empty($_POST)) {
            if(trim($_POST['type_material']) =='' || trim($_POST['category']) =='' || trim($_POST['name'] =='')) {
                $this->pageData['validate'] = 'novalidate';
            } else {
                $typeMaterial = strip_tags(trim($_POST['type_material']));
                $category = strip_tags(trim($_POST['category']));
                $name = strip_tags(trim($_POST['name']));
                $autor = strip_tags(trim($_POST['autor']));
                $decription = strip_tags(trim($_POST['description']));
                if ($this->model->addMaterial($typeMaterial, $category, $name, $autor, $decription)) {
                    header("Location: /materials");
                } else print 'что пошло не так!';
            };
        } 
        
        $this->pageData ['type_materials'] = $this->model->getTypeMaterials();
        $this->pageData ['categories']  = $this->model->getCategories();
                            
        $this->view->render($this->pageHeader, $this->pageData);
		$this->view->render($this->pageTpl, $this->pageData);
		$this->view->render($this->pageFooter, $this->pageData);
    }

    // метод просмотра материала

    public function viewMaterial($slug) {
        $this->pageData['title'] = "Mатериал";
        if (is_array($_POST) && !empty($_POST) && trim($_POST['tag']) != '') {
            $id = strip_tags(trim($_POST['tag']));
            $slug = strip_tags(trim($slug));
            if ($this->model->saveTagToMaterial($id, $slug)) {
                header("Location: /materials/viewMaterial/$slug");
            } else echo "тег уже существует";
        }
        if ($slug != '') {
            $this->pageTpl = '/views/view-material.tpl.php';
            $material = $this->model->getMaterial($slug);
            $this->pageData['material'] = $material;
           
            $this->view->render($this->pageHeader, $this->pageData);
            $this->view->render($this->pageTpl, $this->pageData);
            $this->view->render($this->pageFooter, $this->pageData);
        } else {
            $this->view->render($this->pageHeader, $this->pageData);
            $this->view->render($this->pageTpl, $this->pageData);
            $this->view->render($this->pageFooter, $this->pageData);
        }
        
    }

    // метод редактирования материала

    public function editMaterial($slug) {
        $this->pageData['title'] = "Редактирование материала"; 
        $this->pageData['validate'] = "validate";
        if ($slug != '') {
            $this->pageTpl = '/views/create-material.tpl.php';
            
            if (is_array($_POST) && !empty($_POST)) {
                if (trim($_POST['type_material']) =='' || trim($_POST['category']) =='' || trim($_POST['name'] =='')) {
                    $this->pageData['validate'] = 'novalidate';
                } else {
                    $typeMaterial = strip_tags(trim($_POST['type_material']));
                    $category = strip_tags(trim($_POST['category']));
                    $name = strip_tags(trim($_POST['name']));
                    $autor = strip_tags(trim($_POST['autor']));
                    $decription = strip_tags(trim($_POST['description']));
                    if ($this->model->saveMaterial($typeMaterial, $category, $name, $autor, $decription, $slug)) {
                        header("Location: /materials");
                    } else print 'что пошло не так!';
                };
            } else {
                $material = $this->model->getMaterial($slug);
                $this->pageData['material'] = $material;
                $this->pageData['button'] = "Сохранить";
                $this->pageData ['type_materials'] = $this->model->getTypeMaterials();
                $this->pageData ['categories']  = $this->model->getCategories();
                $this->view->render($this->pageHeader, $this->pageData);
                $this->view->render($this->pageTpl, $this->pageData);
                $this->view->render($this->pageFooter, $this->pageData);
            }
        } else {
            $this->view->render($this->pageHeader, $this->pageData);
            $this->view->render($this->pageTpl, $this->pageData);
            $this->view->render($this->pageFooter, $this->pageData);
        }
    }

    // метод удаления материала

    public function deleteMaterial($slug) {
        if ($this->model->deleteMaterial($slug)) {
            header("Location: /materials");
        } else print 'что пошло не так!';
    }

    // метод поиска материала

    public function search ($str) {
        $this->pageData['title'] = "Mатериалы";

        if(is_array($_POST) && !empty($_POST)) {
            if (strip_tags(trim($_POST['str']))!= '') {
                $str = strip_tags(trim($_POST['str']));
                $materials = $this->model->getFindMaterial($str);   
                $this->pageData['materials'] = $materials;       
                $this->view->render($this->pageHeader, $this->pageData);
                $this->view->render($this->pageTpl, $this->pageData);
                $this->view->render($this->pageFooter, $this->pageData);
            } else header("Location: /materials");
        } else {
            header("Location: /materials");
        };    
    }

    // метод удаления тега материала

    public function deleteTagFromMaterial($id) {
        if ($this->model->deleteTagFromMaterial($id)) {
            header("Location: ".$_SERVER['HTTP_REFERER']);
        } else print 'что пошло не так!';
    }
}

 ?>