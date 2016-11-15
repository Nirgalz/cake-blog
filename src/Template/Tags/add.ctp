<div class="ui attached message">
    <div class="header">
        Add an Tag
    </div>
</div>
    <?= $this->Form->create($tag, ['class' => 'ui form attached fluid segment']) ?>

        <?php
            echo $this->Form->input('name', ['class' => 'form-control']);
        ?>
    <?= $this->Form->button(__('Submit'), ['class' => 'ui blue button']) ?>
    <?= $this->Form->end() ?>

