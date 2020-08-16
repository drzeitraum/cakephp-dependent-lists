<?= $this->Form->create($product, ['class' => 'align-middle']) ?>
<div class="form-group">
    <?= $this->Form->control('name', ['label' => 'Name', 'class' => 'form-control']) ?>
</div>
<div class="form-group">
    <?= $this->Form->control('classifier_product_id', [
        'label' => 'Type of Product',
        'class' => 'form-control',
        'entity' => 'classifier_product',
        'options' => $classifierProducts,
        'onchange' => 'dependentsLists(this);',
        'empty' => '---not selected---']) ?>
</div>

<span id="dependents-lists">
    <? if (isset($classifiers) and $this->getRequest()->getParam('action') === 'edit') { ?>
        <? foreach ($classifiers as $key => $value) { ?>
            <div class="form-group">
                <?= $this->Form->control($labels[$key]['entity'] . '_id', [
                    'label' => $labels[$key]['description'],
                    'class' => 'form-control',
                    'entity' => $labels[$key]['entity'],
                    'empty' => '---not selected---',
                    'options' => $value,
                    'default' => $product->{$labels[$key]['entity'] . '_id'},
                    'onchange' => "dependentsLists(this);"
                ]) ?>
            </div>
        <? } ?>
    <? } ?>
</span>

<?= $this->Form->button('Save', ['class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
