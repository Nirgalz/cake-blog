<!--<script src="https://npmcdn.com/nlp_compromise@latest/builds/nlp_compromise.min.js"></script>
-->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({
        selector:'textarea',
        height : 400
    });
</script>


<div class="col-md-12">
    <div class="ui attached message">
        <div class="header">
            Add an article
        </div>
        <p>Additional message</p>
    </div>
    <?= $this->Form->create($article, ['class' => 'ui form attached fluid segment', 'name' => 'article']) ?>
        <div class="field">
        <?= $this->Form->input('title', ['class' => 'form-control']); ?>
            </div>


   <?= $this->Form->input('body'); ?>

    <div class="field">

    <?= 'Published'; ?>
        <?=$this->Form->checkbox('published', ['class' => 'form-control']); ?>
        </div>


    <div class="field">

        <?php
        echo $this->Form->input('tags._ids', ['options' => $tags]);
        ?>
        </div>
    <?= $this->Form->button(__('Submit'), ['class' => 'ui blue button']) ?>
    <?= $this->Form->end() ?>
</div>

<script>
    $(function () {
        $('.tag.example .ui.dropdown')
            .dropdown({
                allowAdditions: true
            })
        ;
        $('#body').removeAttr('required');

      /*  $('.button').on('click', function (e) {
            e.preventDefault();
            var text = tinymce.get('body').getContent();
        })*/
    })



</script>