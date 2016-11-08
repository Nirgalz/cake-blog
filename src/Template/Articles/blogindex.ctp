<?php foreach ($articles as $article) : ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="caption">
            <?= $article->title ?>
            <div class="pull-right">
                <?= $article->created ?>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <?= $article->body ?>
    </div>
    <div class="panel-footer">
        <div id="article-<?= $article->id?>" class="add-comment btn btn-default">Comment</div>
    </div>
</div>
<?php endforeach; ?>