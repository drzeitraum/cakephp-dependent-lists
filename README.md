# CakePHP 3.x dependents lists in selectors ([DEMO](https://kotlyarov.us/cakephp-dependents-lists/products/edit/1))

This is an example of how to generate infinite dependent lists in CakePHP 3.x.
Most of the of work will be performed on the server side. This is may be convenient if the classifier tables will be a large number of rows.
For example, I will use an online store.

## First let's create our tables in the database:

`products` - catalog;
`classifiers` -  list of all classifiers;
`classifier_appliances`, `classifier_brands`, `classifier_computers`, `classifier_electric_tools`, `classifier_furnitures`,  `classifier_gadgets`, `classifier_laptops`, `classifier_products` - tables that store values of classifiers.
To view all the content, use the `db. sql` file from the repository.

### Baking models for `Products` and `Classifiers`:

```php
bin/cake bake model Products;
bin/cake bake model Classifiers;

```

### Next, need an array that will store the dependencies of all classifiers.
Creating the `DependentsComponent.php` component in `/src/Controller/Component/`:

```php
<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Dependents component
 */
class DependentsComponent extends Component
{

    public $classifiers = [

        // 1. Type of product
        'classifier_product' => [
            // Computers
            1 => [
                3, // Name of brand
                4 // Type of computer
            ],
            // Gadgets
            2 => [
                3, // Name of brand
                7 //Type of gadget
            ],
            // Appliances
            3 => [
                3 // Name of brand
            ],
            // Electric tools
            4 => [
                3 // Name of brand
            ],
            // Furnitures
            5 => [
                6 //Type of furnitures
            ]
        ],

        // 4. Type of computer
        'classifier_computer' => [
            // Laptops
            2 => [
                8 // Type of laptop
            ]
        ]

    ];

}

```

You can add an infinite number of classifiers and link them in a single array. The array structure is as follows:

```php
'<name of the classifier>'  => [
    <value of the classifier> => [
        <id of the classifier from a table classifiers>
    ]
]

```

### Creating the `DependentsController.php` controller in `/src/Controller/`.

I will use sessions for ease of use, so that I can go back to the selector I selected but closed earlier. Initially, it will be bound to the main classifier "product type" `classifier_product`, then the remaining dependencies will be collected from the `products` catalog table and from the `classifiers` dependency array.

```php
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

```

### The view `index.ctp` in `/src/Template/Dependents/`:

```html
<? if (isset($classifiers)) { ?>
    <? foreach ($classifiers as $key => $value) { ?>
        <?= $this->Form->control($labels[$key]['entity'] . '_id', [
            'label' => $labels[$key]['description'],
            'entity' => $labels[$key]['entity'],
            'empty' => '---не выбрано---',
            'options' => $value,
            'default' => $entity == $labels[$key]['entity'] ? $depend_id : $session->read('tg.' . $key),
            'onchange' => "dependentsLists(this);"
        ]) ?>
    <? } ?>
<? } ?>

```

### Create `ProductsController` in `/src/Controller/`:

```php
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

```

### And view of controller `edit.ctp` in `/src/Template/Products/`:

```html
<?= $this->Form->create($product]) ?>
<?= $this->Form->control('name', ['label' => 'Name']) ?>
<?= $this->Form->control('classifier_product_id', [
    'label' => 'Type of Product',
    'entity' => 'classifier_product',
    'options' => $classifierProducts,
    'onchange' => 'dependentsLists(this);',
    'empty' => '---not selected---'
    ])
?>
<span id="dependents-lists">
    <? if (isset($classifiers) and $this->getRequest()->getParam('action') === 'edit') { ?>
        <? foreach ($classifiers as $key => $value) { ?>
            <?= $this->Form->control($labels[$key]['entity'] . '_id', [
                'label' => $labels[$key]['description'],
                'entity' => $labels[$key]['entity'],
                'empty' => '---not selected---',
                'options' => $value,
                'default' => $product->{$labels[$key]['entity'] . '_id'},
                'onchange' => "dependentsLists(this);"
            ]) ?>
        <? } ?>
    <? } ?>
</span>
<?= $this->Form->button('Save') ?>
<?= $this->Form->end() ?>

```

## Simple Jquery function for AJAX requests:

```js
function dependentsLists(_this) {

    var elem = $('#dependents-lists');

    $.ajax({
        beforeSend: function () {
            elem.css({'opacity': '0.7'});
        },
        url: '/cakephp-dependents-lists/dependents/', //change this path to the name of your Dependents controller
        data: ({
            product_id: $('#classifier-product-id').val(),
            depend_id: $(_this).val(),
            entity: $(_this).attr('entity')
        }),
        success: function (responce) {
            elem.html(responce);
        },
        complete: function () {
            elem.css({'opacity': '1'});
        }
    });

}

```

# CakePHP 3.x dependents lists in selectors ([DEMO](https://kotlyarov.us/cakephp-dependents-lists/products/edit/1))