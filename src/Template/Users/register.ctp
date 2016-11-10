
<div class="ui attached message">
    <div class="header">
        Welcome to our site!
    </div>
    <p>Fill out the form below to sign-up for a new account</p>
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
<div class="ui bottom attached warning message">
    <i class="icon help"></i>
    Already signed up? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Login here</a> instead.
</div>