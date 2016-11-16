<?php

function spaceKiller($blackHole) {
    return str_replace(" ", "-", $blackHole);
}

function nestedComments($childComments, $comment)
{
    echo '<div class="comments">';
    foreach ($childComments as $childComment) {
        if ($childComment->comment_id == $comment->id) {
            echo '
            <div class="comment">
                <a class="avatar">
                    <img src="/blog/files/Users/photo/' . $childComment->user->photo . '">
                </a>
                <div class="content">
                    <a class="author">' . spaceKiller($childComment->user->username) . '</a>
                    <div class="metadata">
                        <span class="date">' . $childComment->created . '</span>
                    </div>
                    <div class="text">
                        <p>' . $childComment->body . '</p>
                    </div>
                    <div class="actions">
                        <a id="toggle-comment-' . $childComment->id . '" class="reply add-comment">Reply</a>
                    </div>
                </div>
            </div>
            <form id="form-comment-' . $childComment->id . '" class="ui reply form hideit" style="display: none;">
                    <div class="field">
                        <textarea id="comment-' . $childComment->id . '"></textarea>
                    </div>
                    <div onclick="submitComment(' . $childComment->article_id . ', ' . $childComment->id . ')" class="ui blue labeled submit icon button">
                        <i class="icon edit"></i> Add Reply
                    </div>
                </form>
      
        ';
            foreach ($childComments as $child) {
                if ($child->comment_id == $childComment->id) {

                    nestedComments($childComments, $childComment);
                    break;
                }
            }

        }
    }
    echo '</div>';
}

;
?>


<div class="row">
    <div class="col-md-8 col-sm-12">
        <div id="articles">

            <?php foreach ($articles as $article) : ?>

                <h3 class="ui top attached inverted header">
                    <?= $article->title ?>
                    <p class="pull-right">
                        <?= $article->created ?>
                    </p>
                </h3>
                <div class="ui attached segment">
                    <div class="ui comments">

                        <div class="comment">
                            <a class="avatar">
                                <?= $this->Html->image('../files/Users/photo/' . $article->user->photo) ?>
                            </a>
                            <div class="content">
                                <a class="author"><?= spaceKiller($article->user->username); ?></a>

                            </div>
                        </div>

                        <br>
                </div>


                </div>
                <div class="ui attached segment">
                    <?= $article->body ?>
                </div>

                <div class="ui  attached segment">

                    <?php if (!empty($article->comments)): ?>

                        <button id="toggle-comment-<?= $article->id ?>" class="ui  button view-comment">
                            <i class="icon comments"></i>
                            <?= count($article->comments) ?> Comments
                        </button>
                    <?php endif; ?>
                    <button id="toggle-article-<?= $article->id ?>" class="add-comment ui button">
                        <i class="icon reply"></i> Reply
                    </button>


                    <div class="ui icon top left pointing dropdown button pull-right">
                        <i class="share alternate icon"></i> Share
                        <div class="menu">
                            <!--facebook shit needs api key-->
                            <!-- <div class="ui facebook button item sharer button"
                                 data-sharer="facebook"
                                 data-url="http://mysite<? /*= $this->Url->build(["controller" => "Articles", "action" => "view", $article->id])*/ ?>">
                                <i class="facebook icon"></i>
                                Facebook
                            </div>-->

                            <div class="ui twitter button item sharer button"
                                 data-sharer="twitter" data-title="<?= $article->title ?>"
                                 data-hashtags="<?php foreach ($article->tags as $tag): ?><?= $tag->name ?>,<?php endforeach; ?>"
                                 data-url="http://mysite<?= $this->Url->build(["controller" => "Articles", "action" => "view", $article->id]) ?>">
                                <i class="twitter icon"></i>
                                Twitter
                            </div>
                            <div class="ui mail button item sharer button"
                                 data-sharer="email" data-title="<?= $article->title ?>"
                                 data-url="http://mysite<?= $this->Url->build(["controller" => "Articles", "action" => "view", $article->id]) ?>"
                                 data-subject="<?= $article->title ?>">
                                <i class="mail icon"></i>
                                Email
                            </div>

                        </div>
                    </div>


                    <form id="form-article-<?= $article->id ?>" class="ui reply form hideit" style="display: none;">
                        <div class="field">
                            <textarea id="article-<?= $article->id ?>"></textarea>
                        </div>
                        <div onclick="submitComment(<?= $article->id ?>, null)"
                             class="ui blue labeled submit icon button">
                            <i class="icon edit"></i> Add Reply
                        </div>
                    </form>


                    <?php if (!empty($article->comments)) : ?>
                        <div id="show-comment-<?= $article->id ?>" class="ui hidethat comments" style="display: none;">
                            <h3 class="ui dividing header"></h3>
                            <?php foreach ($article->comments as $comment) : ?>
                                <?php if ($comment->comment_id == null) : ?>
                                    <div class="comment">
                                        <a class="avatar">
                                            <?= $this->Html->image('../files/Users/photo/' . $comment->user->photo) ?>
                                        </a>
                                        <div class="content">
                                            <a class="author"><?=spaceKiller($comment->user->username); ?></a>
                                            <div class="metadata">
                                                <span class="date"><?= $comment->created ?></span>
                                            </div>
                                            <div class="text">
                                                <p><?= $comment->body ?></p>
                                            </div>
                                            <div class="actions">
                                                <a id="toggle-comment-<?= $comment->id ?>" class="reply add-comment">Reply</a>
                                            </div>
                                        </div>
                                        <form id="form-comment-<?= $comment->id ?>" class="ui reply form hideit"
                                              style="display: none;">
                                            <div class="field">
                                                <textarea id="comment-<?= $comment->id ?>"></textarea>
                                            </div>
                                            <div onclick="submitComment(<?= $article->id ?>, <?= $comment->id ?>)"
                                                 class="ui blue labeled submit icon button">
                                                <i class="icon edit"></i> Add Reply
                                            </div>
                                        </form>
                                        <?php nestedComments($childComments, $comment) ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <div class="paginator">
                <ul class="pagination">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
                <p><?= $this->Paginator->counter() ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm12">

        <h4 class="ui top attached inverted header"><i class="tags icon"></i>Filter by Tags</h4>
        <div class="ui attached segment bottom">
            <table class="ui selectable celled table">
                <tbody>
                <?php foreach ($tags as $tag) : ?>
                    <tr>
                        <td class="tag-btn" id="tag-btn-<?= $tag->name ?>"><?= $tag->name ?> (<?= count($tag->articles) ?>
                            )
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>


        <h4 class="ui top attached inverted header"><i class="comments icon"></i> Last comments</h4>
        <div class="ui attached segment bottom">
            <table class="ui selectable celled table">
                <tbody>

                <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td class="comment-btn" id="<?= spaceKiller($comment->article->title) ?>">Article
                            : <?= $comment->article->title ?> - comment
                            :<?= $comment->body ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</div>


<style>

    .ui.comments .comment {
        border-radius: 0.5em;
        box-shadow: 0px 1px 1px 1px rgba(0, 0, 0, 0.1);
    }

    .ui.comments .comment .comments .comment {
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: none;
    }

    .comment-btn, .tag-btn {
        cursor: pointer;
    }
</style>

<?= $this->Html->script('semantic.min.js') ?>


<script>

</script>
<script>


    $(function () {


        $('.author').on('click', function (event) {
            event.preventDefault();
            window.location = '<?= $this->Url->build(["controller" => "Users", "action" => "view"])?>' + '/'+ $(this).text();
        });


        $('.tag-btn').on('click', function () {
            var id = $(this).attr('id').split('-');
            window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "blogindex"])?>' + '/'+ id[2];
        });
        $('.comment-btn').on('click', function () {
            var id = $(this).attr('id');
            window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "view"])?>' + '/' + id;
        });


        $('.ui.dropdown').dropdown({
            on: 'hover'
        });


        //toggles add comment forms
        $('.add-comment').on('click', function () {
            var data = $(this).attr('id').split('-');
            var form = $('#form-' + data[1] + '-' + data[2] + '');
            if (!(form.attr('style') == 'display: none;')) {
                form.addClass('hideit').hide('slow');
            } else {
                form.removeClass('hideit').show('slow');
                $('.hideit').hide('slow');
                form.addClass('hideit');
            }
        });

        //toggles comments
        $('.view-comment').on('click', function () {
            var data = $(this).attr('id').split('-');
            var form = $('#show-comment-' + data[2] + '');

            if (!(form.attr('style') == 'display: none;')) {
                form.addClass('hidethat').hide('slow');
            } else {
                form.removeClass('hidethat').show('slow');
                $('.hidethat').hide('slow');
                form.addClass('hidethat');
            }
        })

    });

    //function to submit comment by ajax
    function submitComment(articleId, commentId) {
        if (commentId == null) {
            var body = $('#article-' + articleId + '').val();
        } else if (commentId != null) {
            var body = $('#comment-' + commentId + '').val();
        }

        var data = {
            article_id: articleId,
            comment_id: commentId,
            body: body
        };
        $.ajax({
            type: 'POST',
            data: data,
            url: '<?= $this->Url->build(["controller" => "Comments", "action" => "add"])?>',
            success: function () {
                location.reload();
            }
        })

    }

</script>
