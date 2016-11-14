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
        <div class="ui comments">
            <div class="comment">
                <a class="avatar">
                    <?= $this->Html->image('../files/Users/photo/' . $user->photo) ?>
                </a>
                <div class="content">
                    <a class="author"><?=$user->username?></a>

                </div>
            </div>
            <br>
        </div>
    </div>
</div>
<div class="ui grid">
    <div class="eight wide column">

        <h4 class="ui top attached inverted header">Last Articles</h4>
        <div class="ui attached segment bottom">
            <table class="ui selectable celled table">
                <tbody>

                <?php foreach ($user->articles as $article) : ?>
                    <tr><td class="article-btn" id="article-btn-<?= $article->id ?>"><?= $article->title ?></td></tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>

    </div>

    <div id="picture-profile" class="eight wide column">

        <h4 class="ui top attached inverted header">Last comments</h4>
        <div class="ui attached segment bottom">
            <table class="ui selectable celled table">
                <tbody>

                <?php foreach ($user->comments as $comment) : ?>
                    <tr><td class="comment-btn" id="comment-btn-<?= $comment->article_id ?>">Article : <?= $comment->article->title ?></td></tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>

    </div>
</div>


<style>
    .comment-btn,.article-btn {
        cursor: pointer;
    }
</style>

<script>

    $('.article-btn').on('click', function () {
        var id = $(this).attr('id').split('-');
        window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "view"])?>' + '/' + id[2];
    })

    $('.comment-btn').on('click', function () {
        var id = $(this).attr('id').split('-');
        window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "view"])?>' + '/' + id[2];
    })
</script>
