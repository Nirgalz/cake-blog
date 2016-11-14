<h4 class="ui top attached inverted header">Last comments</h4>
<div class="ui attached segment bottom">
    <table class="ui selectable celled table">
        <tbody>

        <?php foreach ($comments as $comment) : ?>
            <tr><td class="comment-btn" id="comment-btn-<?= $comment->article_id ?>">Article : <?= $comment->article->title ?> - comment
                    :<?= $comment->body ?></td></tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>

<style>
    .comment-btn {
        cursor: pointer;
    }
</style>

<script>
    $('.comment-btn').on('click', function () {
        var id = $(this).attr('id').split('-');
        window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "view"])?>' + '/' + id[2];
    })
</script>