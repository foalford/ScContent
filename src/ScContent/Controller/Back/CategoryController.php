<?php
/**
 * ScContent (https://github.com/dphn/ScContent)
 *
 * @author    Dolphin <work.dolphin@gmail.com>
 * @copyright Copyright (c) 2013-2014 ScContent
 * @link      https://github.com/dphn/ScContent
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ScContent\Controller\Back;

use ScContent\Controller\AbstractBack,
    ScContent\Service\Back\CategoryService,
    ScContent\Form\Back\CategoryForm,
    ScContent\Exception\RuntimeException,
    //
    Zend\View\Model\ViewModel;

/**
 * @author Dolphin <work.dolphin@gmail.com>
 */
class CategoryController extends AbstractBack
{
    /**
     * @var \ScContent\Service\Back\CategoryService
     */
    protected $categoryService;

    /**
     * @var \ScContent\Form\Back\CategoryForm
     */
    protected $categoryForm;

    /**
     * Add Category.
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function addAction()
    {
        $parent = $this->params()->fromRoute('parent');
        if (! is_numeric($parent)) {
            $this->flashMessenger()->addMessage(
                $this->scTranslate('The category location was not specified.')
            );
            return $this->redirect()
                ->toRoute('sc-admin/content-manager')
                ->setStatusCode(303);
        }
        try {
            $categoryId = $this->getCategoryService()->makeCategory($parent);
        } catch (RuntimeException $e) {
            $this->flashMessenger()->addMessage($e->getMessage());
            return $this->redirect()
                ->toRoute('sc-admin/content-manager')
                ->setStatusCode(303);
        }
        return $this->redirect()->toRoute(
            'sc-admin/category/edit',
            ['id' => $categoryId]
        );
    }

    /**
     * Edit Category.
     *
     * @return \Zend\Stdlib\ResponseInterface|\Zend\View\Model\ViewModel
     */
    public function editAction()
    {
        $id = $this->params()->fromRoute('id');
        if (! is_numeric($id)) {
            $this->flashMessenger()->addMessage(
                $this->scTranslate('The category ID was not specified.')
            );
            return $this->redirect()
                ->toRoute('sc-admin/content-manager')
                ->setStatusCode(303);
        }

        try {
            $category = $this->getCategoryService()->getCategory($id);
        } catch (RuntimeException $e) {
            $this->flashMessenger()->addMessage($e->getMessage());
            return $this->redirect()
                ->toRoute('sc-admin/content-manager')
                ->setStatusCode(303);
        }
        $form = $this->getCategoryForm();
        $form->setAttribute(
            'action',
            $this->url()->fromRoute('sc-admin/category/edit', ['id' => $id])
        );
        $form->bind($category);

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $this->getCategoryService()->saveContent($form->getData());
            }
        }

        return new ViewModel([
            'content' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @param  \ScContent\Service\Back\CategoryService $service
     * @return void
     */
    public function setCategoryService(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    /**
     * @return \ScContent\Service\Back\CategoryService
     */
    public function getCategoryService()
    {
        if (! $this->categoryService instanceof CategoryService) {
            $serviceLocator = $this->getServiceLocator();
            $this->categoryService = $serviceLocator->get(
                'ScService.Back.Category'
            );
        }
        return $this->categoryService;
    }

    /**
     * @param  \ScContent\Form\Back\CategoryForm $form
     * @return void
     */
    public function setCategoryForm(CategoryForm $form)
    {
        $this->categoryForm = $form;
    }

    /**
     * @return \ScContent\Form\Back\CategoryForm
     */
    public function getCategoryForm()
    {
        if (! $this->categoryForm instanceof CategoryForm) {
            $formElementManager = $this->getServiceLocator()->get(
                'FormElementManager'
            );
            $this->categoryForm = $formElementManager->get(
                'ScForm.Back.Category'
            );
        }
        return $this->categoryForm;
    }
}
