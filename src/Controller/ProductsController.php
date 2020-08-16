<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Products Controller
 */
class ProductsController extends AppController
{

    /**
     * initialize method
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Dependents');
        $this->loadModel('Classifiers');
    }

    /**
     * Edit method
     */
    public function edit($id = null)
    {

        $product = $this->Products->get($id, [
            'contain' => [
                'ClassifierProducts',
                'ClassifierAppliances',
                'ClassifierBrands',
                'ClassifierComputers',
                'ClassifierElectricTools',
                'ClassifierFurnitures',
                'ClassifierGadgets',
                'ClassifierLaptops'
            ]
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect($this->referer());
            }
        }

        $classifierProducts = $this->Products->ClassifierProducts->find('list', ['limit' => 200]);

        # classifiers
        if (isset($product->classifier_product->id)) {

            // expand array of classifiers from Dependents component
            $classifiers_products = $this->Dependents->classifiers['classifier_product'][$product->classifier_product->id];
            foreach ($classifiers_products as $value) {
                $classifier = $this->Classifiers->find('all')->select(['model', 'entity', 'description'])->where(['id' => $value])->first();
                if (isset($product->{$classifier->entity}->id)) {
                    if (isset($this->Dependents->classifiers[$classifier->entity][$product->{$classifier->entity}->id])) {
                        $classifiers_products = array_merge($classifiers_products, $this->Dependents->classifiers[$classifier->entity][$product->{$classifier->entity}->id]);
                    }
                }
            }

            // prepare array classifiers for first load forms
            foreach ($classifiers_products as $value) {
                $classifier = $this->Classifiers->find('all')->select(['model', 'entity', 'description'])->where(['id' => $value])->first();
                $labels[$classifier->entity]['entity'] = $classifier->entity;
                $labels[$classifier->entity]['description'] = $classifier->description;
                $classifiers[$classifier->entity] = $this->Products->{$classifier->model}->find('list')->order('name');
            }

        }

        $this->set(compact('product', 'classifierProducts', 'labels', 'classifiers'));

    }

}
