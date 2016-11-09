<div class="panel panel-default">
    <div class="panel-heading">
        Last comments
    </div>
    <div class="panel-body">
        <ul>
            <?php foreach ($comments as $comment) : ?>
                <li><a href="" id="comment-btn-<?= $comment->id ?>">Article : <?= $comment->article->title?> - comment :<?= $comment->body ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>