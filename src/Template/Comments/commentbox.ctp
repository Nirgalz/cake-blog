<h4 class="ui top attached inverted header">Last comments</h4>
<div class="ui attached segment bottom">
    <ul>
        <?php foreach ($comments as $comment) : ?>
            <li><a href="" id="comment-btn-<?= $comment->id ?>">Article : <?= $comment->article->title?> - comment :<?= $comment->body ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
