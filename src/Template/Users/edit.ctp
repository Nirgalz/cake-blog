<style>
    img {
        width: 50%;
    }
    #picture-profile {
        text-align: center;
    }
</style>


<div class="ui attached message">
    <div class="header">
      Edit your profile
    </div>
</div>
<?= $this->Form->create($user, ['class' => 'ui form attached fluid segment', 'type' => 'file']) ?>
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

    <div id="picture-profile" class="eight wide column">
        <?= $this->Html->image('../files/Users/photo/' . $user->photo) ?>
        <?php echo $this->Form->input('photo', ['type' => 'file']); ?>
        <?php echo $this->Form->input('photo_dir', ['type' => 'hidden']); ?>
    </div>
</div>
<?= $this->Form->button(__('Submit'), ['class' => 'ui blue submit button']) ?>
<?= $this->Form->end() ?>
