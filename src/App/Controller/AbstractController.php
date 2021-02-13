<?php
namespace App\Controller;

use App\Service\FormBuilder;
use App\Service\FormValidator;
use NeutronStars\Controller\Controller;
use NeutronStars\Model\Model;

abstract class AbstractController extends Controller
{
    protected Model $model;
    protected array $filters;
    protected string $view;

    public function __construct(string $view, Model $model, $filters)
    {
        $this->view = $view;
        $this->model = $model;
        $this->filters = $filters;
    }

    protected function checkValid(&$values, &$errors, $callback, $submitTitle)
    {
        if($values == null){ $values = []; }
        if($errors == null){ $errors = []; }
        if (empty($_POST)) {
            $this->show($submitTitle, $values, $errors);
            return;
        }
        $validation = $this->createFormValidator($this->filters);
        $values = $validation->getValues();
        $errors = $validation->getErrors();
        if($validation->isValid())
        {
            $callback($values);
        }
        $this->show($submitTitle, $values, $errors);
    }

    protected function createFormValidator($filters): FormValidator
    {
        return new FormValidator($_POST, $filters);
    }

    protected function show($submitTitle, $values = [], $errors = [])
    {
        $this->render($this->view, [
            'objects' => $this->model->all(),
            'form'    => new FormBuilder($values, $errors),
            'submitTitle' => $submitTitle
        ]);
    }

    protected function get($id, string $idColumn = 'id'): Object
    {
        $obj = $this->model->findById($id, $idColumn);
        if($obj == null){
            $this->page404();
        }
        return $obj;
    }
}
