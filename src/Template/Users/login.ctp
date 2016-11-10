

<div class="users form">
    <?= $this->Flash->render('auth') ?>

    <div class="ui attached message">
        <div class="header">
            Login
        </div>
        <p>Please enter your username and password</p>
    </div>
    <?= $this->Form->create("",['class' => 'ui form attached fluid segment']) ?>

        <div class="field">
        <?= $this->Form->input('username') ?>
        </div>
        <div class="field">
        <?= $this->Form->input('password') ?>
            </div>
    <?= $this->Form->button(__('Login'), ['class' => 'ui blue submit button']); ?>
    <?= $this->Form->end() ?>
</div>