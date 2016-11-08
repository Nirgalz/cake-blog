<div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('username', ['class' => 'form-control']) ?>
        <?= $this->Form->input('password', ['class' => 'form-control']) ?>
    </fieldset>
    <?= $this->Form->button(__('Login', ['class' => 'btn btn-default'])); ?>
    <?= $this->Form->end() ?>
</div>