
<div class="ui attached message">
    <div class="header">
        Edit your profile
    </div>
    <p>Change in the form below then submit your changes.</p>
</div>
<?= $this->Form->create($user, ['class' => 'ui form attached fluid segment']) ?>
<div class="ui grid">
    <div class="eight wide column">

        <div class="field">
            <?= $this->Form->input('username', ['placeholder' => 'Username']); ?>
        </div>
        <div class="field">
            <?= $this->Form->input('email', ['placeholder' => 'E-mail']); ?>
        </div>
        <div class="field">
            <?= $this->Form->input('password'); ?>
            <br>
        </div>
    </div>
</div>
<?= $this->Form->button(__('Submit'), ['class' => 'ui blue submit button']) ?>
<?= $this->Form->end() ?>