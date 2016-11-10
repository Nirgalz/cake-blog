<div class="col-md-8">
    <div class="ui attached message">
        <div class="header">
            Add an article
        </div>
        <p>Additional message</p>
    </div>
    <?= $this->Form->create($article, ['class' => 'ui form attached fluid segment']) ?>
        <legend><?= __('Add Article') ?></legend>
        <div class="field">
        <?= $this->Form->input('title', ['class' => 'form-control']); ?>
            </div>
    <div class="field">

   <?= $this->Form->input('body', ['class' => 'form-control']); ?>
        </div>
    <div class="field">

    <?= 'Published'; ?>
        <?=$this->Form->checkbox('published', ['class' => 'form-control']); ?>
        </div>

    <div class="field">

        <?php
        echo $this->Form->input('tags._ids', ['options' => $tags]);
        ?>
        </div>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default']) ?>
    <?= $this->Form->end() ?>
</div>

