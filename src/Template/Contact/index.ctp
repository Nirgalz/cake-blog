
<?= $this->Form->create($contact, ['class' => 'ui form']);?>
<div class="field">
    <?= $this->Form->input('name');?>
</div>
<div class="field">

<?= $this->Form->input('email');?>
    </div>
    <div class="field">

<?= $this->Form->input('body');?>
     </div>
<?= $this->Form->button('Submit', ['class' => 'ui submit blue button']);?>
<?= $this->Form->end();
?>