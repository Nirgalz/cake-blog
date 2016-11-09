<div class="panel panel-default">
    <div class="panel-heading">
        Tags
    </div>
    <div class="panel-body">
        <ul>
            <?php foreach ($tags as $tag) : ?>
            <li><a href="" id="tag-btn-<?= $tag->id ?>"><?= $tag->name?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>