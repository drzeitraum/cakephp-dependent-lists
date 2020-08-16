<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\ClassifierProductsTable&\Cake\ORM\Association\BelongsTo $ClassifierProducts
 * @property \App\Model\Table\ClassifierAppliancesTable&\Cake\ORM\Association\BelongsTo $ClassifierAppliances
 * @property \App\Model\Table\ClassifierBrandsTable&\Cake\ORM\Association\BelongsTo $ClassifierBrands
 * @property \App\Model\Table\ClassifierComputersTable&\Cake\ORM\Association\BelongsTo $ClassifierComputers
 * @property \App\Model\Table\ClassifierElectricToolsTable&\Cake\ORM\Association\BelongsTo $ClassifierElectricTools
 * @property \App\Model\Table\ClassifierFurnituresTable&\Cake\ORM\Association\BelongsTo $ClassifierFurnitures
 * @property \App\Model\Table\ClassifierGadgetsTable&\Cake\ORM\Association\BelongsTo $ClassifierGadgets
 * @property \App\Model\Table\ClassifierLaptopsTable&\Cake\ORM\Association\BelongsTo $ClassifierLaptops
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ClassifierProducts', [
            'foreignKey' => 'classifier_product_id',
        ]);
        $this->belongsTo('ClassifierAppliances', [
            'foreignKey' => 'classifier_appliance_id',
        ]);
        $this->belongsTo('ClassifierBrands', [
            'foreignKey' => 'classifier_brand_id',
        ]);
        $this->belongsTo('ClassifierComputers', [
            'foreignKey' => 'classifier_computer_id',
        ]);
        $this->belongsTo('ClassifierElectricTools', [
            'foreignKey' => 'classifier_electric_tool_id',
        ]);
        $this->belongsTo('ClassifierFurnitures', [
            'foreignKey' => 'classifier_furniture_id',
        ]);
        $this->belongsTo('ClassifierGadgets', [
            'foreignKey' => 'classifier_gadget_id',
        ]);
        $this->belongsTo('ClassifierLaptops', [
            'foreignKey' => 'classifier_laptop_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['classifier_product_id'], 'ClassifierProducts'));
        $rules->add($rules->existsIn(['classifier_appliance_id'], 'ClassifierAppliances'));
        $rules->add($rules->existsIn(['classifier_brand_id'], 'ClassifierBrands'));
        $rules->add($rules->existsIn(['classifier_computer_id'], 'ClassifierComputers'));
        $rules->add($rules->existsIn(['classifier_electric_tool_id'], 'ClassifierElectricTools'));
        $rules->add($rules->existsIn(['classifier_furniture_id'], 'ClassifierFurnitures'));
        $rules->add($rules->existsIn(['classifier_gadget_id'], 'ClassifierGadgets'));
        $rules->add($rules->existsIn(['classifier_laptop_id'], 'ClassifierLaptops'));

        return $rules;
    }
}
