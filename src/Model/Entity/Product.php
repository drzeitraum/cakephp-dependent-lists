<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property int|null $classifier_product_id
 * @property int|null $classifier_appliance_id
 * @property int|null $classifier_brand_id
 * @property int|null $classifier_computer_id
 * @property int|null $classifier_electric_tool_id
 * @property int|null $classifier_furniture_id
 * @property int|null $classifier_gadget_id
 * @property int|null $classifier_laptop_id
 *
 * @property \App\Model\Entity\ClassifierProduct $classifier_product
 * @property \App\Model\Entity\ClassifierAppliance $classifier_appliance
 * @property \App\Model\Entity\ClassifierBrand $classifier_brand
 * @property \App\Model\Entity\ClassifierComputer $classifier_computer
 * @property \App\Model\Entity\ClassifierElectricTool $classifier_electric_tool
 * @property \App\Model\Entity\ClassifierFurniture $classifier_furniture
 * @property \App\Model\Entity\ClassifierGadget $classifier_gadget
 * @property \App\Model\Entity\ClassifierLaptop $classifier_laptop
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'classifier_product_id' => true,
        'classifier_appliance_id' => true,
        'classifier_brand_id' => true,
        'classifier_computer_id' => true,
        'classifier_electric_tool_id' => true,
        'classifier_furniture_id' => true,
        'classifier_gadget_id' => true,
        'classifier_laptop_id' => true,
        'classifier_product' => true,
        'classifier_appliance' => true,
        'classifier_brand' => true,
        'classifier_computer' => true,
        'classifier_electric_tool' => true,
        'classifier_furniture' => true,
        'classifier_gadget' => true,
        'classifier_laptop' => true,
    ];
}
