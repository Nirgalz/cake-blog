<div class="col-md-8">
    <?= $this->Form->create($article, ['class' => 'ui form']) ?>
    <fieldset>
        <legend><?= __('Add Article') ?></legend>
        <?php
        echo $this->Form->input('title', ['class' => 'form-control']);
        echo $this->Form->input('body', ['class' => 'form-control']);
        echo 'Published ?';
        ?>
        <div class="inline field">
            <div class="ui toggle checkbox">
                <label>Published ?</label>
                <input id="published" name="published" type="checkbox" class="hidden" value="0">

            </div>
        </div>

<?php
        echo $this->Form->input('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-default']) ?>
    <?= $this->Form->end() ?>
</div>


<script>
    $('.ui.checkbox')
        .checkbox()
    ;
    $('.checkbox').on('click', function () {
        var check = $('#published');
        if (check.val() == 0 ) {
            check.val(1);
        } else if (check.val() == 1 ) {
            check.val(0);
        }


            console.log($('#published').val());
    })
</script>