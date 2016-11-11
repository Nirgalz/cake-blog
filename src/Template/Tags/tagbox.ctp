<h4 class="ui top attached inverted header">Tags</h4>

    <div class="ui attached bottom segment">
        <ul>
            <?php foreach ($tags as $tag) : ?>
            <li><a href="" id="tag-btn-<?= $tag->id ?>"><?= $tag->name?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
