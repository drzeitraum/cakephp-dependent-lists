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
