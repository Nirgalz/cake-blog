<?= $this->Html->css('../bootstrap-fileinput/bootstrap-fileinput.css') ?>
<?= $this->Html->script('../bootstrap-fileinput/bootstrap-fileinput.js') ?>



<div class="ui attached message">
    <div class="header">
        Welcome to our site!
    </div>
    <p>Fill out the form below to sign-up for a new account</p>
</div>
<?= $this->Form->create($user, ['class' => 'ui form attached fluid segment', 'enctype' => 'multipart/form-data']) ?>
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

    <div class="eight wide column">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="input-group input-large">
                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                    <span class="fileinput-filename"> </span>
                </div>
                <span class="input-group-addon btn default btn-file">
                                                                                    <span class="fileinput-new"> Joindre un fichier </span>
                                                                                    <span class="fileinput-exists"> Modifier </span>
                                                                                    <input type="file"
                                                                                           name="upload"> </span>
                <a href="javascript:;" class="input-group-addon btn red fileinput-exists"
                   data-dismiss="fileinput">
                    Retirer </a>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->button(__('Submit'), ['class' => 'ui blue submit button']) ?>
<?= $this->Form->end() ?>
<div class="ui bottom attached warning message">
    <i class="icon help"></i>
    Already signed up? <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Login here</a> instead.
</div>