<div class="col-md-8">
    <?= $this->Form->create($article) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
        echo $this->Form->input('title', ['class' => 'form-control']);
        echo $this->Form->input('body', ['class' => 'form-control']);
        echo 'Published ?';
        echo $this->Form->checkbox('published', ['class' => 'form-control'], ['label' => 'Published ?']);
        echo $this->Form->input('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default']) ?>
    <?= $this->Form->end() ?>
</div>
