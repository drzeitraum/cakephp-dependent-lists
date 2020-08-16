<? if (isset($classifiers)) { ?>
    <? foreach ($classifiers as $key => $value) { ?>

        <div class="form-group">
            <?= $this->Form->control($labels[$key]['entity'] . '_id', [
                'label' => $labels[$key]['description'],
                'class' => 'form-control',
                'entity' => $labels[$key]['entity'],
                'empty' => '---не выбрано---',
                'options' => $value,
                'default' => $entity == $labels[$key]['entity'] ? $depend_id : $session->read('tg.' . $key),
                'onchange' => "dependentsLists(this);"
            ]) ?>
        </div>

    <? } ?>
<? } ?>
