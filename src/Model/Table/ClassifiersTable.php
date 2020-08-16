<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Classifiers Model
 *
 * @method \App\Model\Entity\Classifier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Classifier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Classifier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Classifier|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Classifier saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Classifier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Classifier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Classifier findOrCreate($search, callable $callback = null, $options = [])
 */
class ClassifiersTable extends Table
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

        $this->setTable('classifiers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('model')
            ->maxLength('model', 100)
            ->requirePresence('model', 'create')
            ->notEmptyString('model');

        $validator
            ->scalar('entity')
            ->maxLength('entity', 100)
            ->requirePresence('entity', 'create')
            ->notEmptyString('entity');

        $validator
            ->scalar('description')
            ->maxLength('description', 100)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->scalar('type')
            ->maxLength('type', 100)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        return $validator;
    }
}
