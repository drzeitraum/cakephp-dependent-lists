<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dependents Controller
 */
class DependentsController extends AppController
{

    /**
     * initialize method
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Classifiers');
        $this->loadModel('Products');
        $this->loadComponent('Dependents');
    }

    /**
     * Index method
     */
    public function index()
    {

        if ($this->getRequest()->getParam('isAjax')) {

            # data from product
            $product_id = $this->getRequest()->getQuery('product_id');
            $depend_id = $this->getRequest()->getQuery('depend_id');
            $entity = $this->getRequest()->getQuery('entity');

            # sessions
            $session = $this->getRequest()->getSession();
            $session->write('tg.' . $entity, $depend_id);
            // clear if classifier is classifier_product
            if ($entity == 'classifier_product') {
                $session->delete('tg');
            }

            if ($product_id and isset($this->Dependents->classifiers['classifier_product'][$product_id])) {

                # array for a classifiers
                $classifiers_products = $this->Dependents->classifiers['classifier_product'][$product_id];
                if ($session->read('tg') !== null) {
                    foreach ($session->read('tg') as $k => $v) {
                        if (isset($this->Dependents->classifiers[$k][$v]) and $entity != 'classifier_product') {
                            $classifiers_products = array_merge($classifiers_products, $this->Dependents->classifiers[$k][$v]);
                        }
                    }
                }

                # classifiers
                foreach ($classifiers_products as $value) {
                    $classifier = $this->Classifiers->find('all')->select(['model', 'entity', 'description'])->where(['id' => $value])->first();
                    $labels[$classifier->entity]['entity'] = $classifier->entity;
                    $labels[$classifier->entity]['description'] = $classifier->description;
                    $classifiers[$classifier->entity] = $this->Products->{$classifier->model}->find('list')->order('name');
                }

            }

            $this->set(compact('product_id', 'depend_id', 'entity', 'classifiers', 'labels', 'session'));

        }

    }

}
