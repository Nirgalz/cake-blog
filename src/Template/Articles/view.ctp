<?php

function spaceKiller($blackHole)
{
    return str_replace(" ", "-", $blackHole);
}

function authEditComment($childComment, $loggedUser)
{

    if (isset($loggedUser)) {
        if ($loggedUser['role'] === 'admin' || $loggedUser['id'] === $childComment->user_id) {
            return '<a id="toggle-edit-' . $childComment->id . '" class="reply edit-comment"><i class="ui icon edit"></i>Edit</a>
                        <a onclick="submitDelete(' . $childComment->id . ')" id="delete-' . $childComment->id . '" class="reply delete-comment"><i class="ui icon remove">Delete</i></a>';
        }
    } else return '';
}


function nestedComments($childComments, $comment, $loggedUser)
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
                        <p>' . h($childComment->body) . '</p>
                    </div>
                    <div class="actions">
                        <a id="toggle-comment-' . $childComment->id . '" class="reply add-comment"><i class="ui icon reply"></i>Reply</a>
                        ' . authEditComment($childComment, $loggedUser) . '
                        
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
                <form id="form-edit-' . $childComment->id . '" class="ui reply form hideit"
                                              style="display: none;">
                                            <div class="field">
                                                <textarea id="edit-' . $childComment->id . '">' . h($childComment->body) . '</textarea>
                                            </div>
                                            <div onclick="submitEdit(' . $childComment->id . ')"
                                                 class="ui blue labeled submit icon button">
                                                <i class="icon edit"></i> Edit Comment
                                            </div>
                                        </form>
      
        ';
            foreach ($childComments as $child) {
                if ($child->comment_id == $childComment->id) {

                    nestedComments($childComments, $childComment, $loggedUser);
                    break;
                }
            }

        }
    }
    echo '</div>';
}

;
?>

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

        <button id="toggle-comment-<?= $article->id ?>" class="ui icon circular  button view-comment">
            <i class="icon large comments"></i>
            <?= count($article->comments) ?>
        </button>
    <?php endif; ?>

    <button id="toggle-article-<?= $article->id ?>" class="add-comment ui icon button circular"
            title="Comment">
        <i class="icon large reply"></i>
    </button>

    <div class="ui icon circular top left pointing dropdown button pull-right">
        <i class="share large alternate icon"></i>
        <div class="menu">
            <!--facebook shit needs api key-->
            <!-- <div class="ui facebook button item sharer button"
                                 data-sharer="facebook"
                                 data-url="http://mysite<? /*= $this->Url->build(["controller" => "Articles", "action" => "view", $article->id])*/ ?>">
                                <i class="facebook icon"></i>
                                Facebook
                            </div>-->

            <div class="ui fluid twitter button item sharer button"
                 data-sharer="twitter" data-title="<?= $article->title ?>"
                 data-hashtags="<?php foreach ($article->tags as $tag): ?><?= $tag->name ?>,<?php endforeach; ?>"
                 data-url="http://mysite<?= $this->Url->build(["controller" => "Articles", "action" => "view", $article->id]) ?>">
                <i class="twitter icon"></i>
                Twitter
            </div>
            <div class="ui fluid mail button item sharer button"
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
        <div id="show-comment-<?= $article->id ?>" class="ui hidethat comments">
            <h3 class="ui dividing header"></h3>
            <?php foreach ($article->comments as $comment) : ?>
                <?php if ($comment->comment_id == null) : ?>
                    <div class="comment">
                        <a class="avatar">
                            <?= $this->Html->image('../files/Users/photo/' . $comment->user->photo) ?>
                        </a>
                        <div class="content">
                            <a class="author"><?= spaceKiller($comment->user->username); ?></a>
                            <div class="metadata">
                                <span class="date"><?= $comment->created ?></span>
                            </div>
                            <div class="text">
                                <p><?= h($comment->body) ?></p>
                            </div>
                            <div class="actions">
                                <a id="toggle-comment-<?= $comment->id ?>" class="reply add-comment"><i
                                        class="ui icon reply"></i>Reply</a>
                                <?php if (isset($loggedUser)): ?>
                                    <?php if ($loggedUser['id'] === $comment->user_id || $loggedUser['role'] === 'admin'): ?>
                                        <a id="toggle-edit-<?= $comment->id ?>"
                                           class="reply edit-comment"><i
                                                class="ui icon edit"></i>Edit</a>
                                        <?= $this->Form->postLink('<i class="icon remove"></i>Delete', ['controller' => 'Comments', 'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => '', 'escape' => false, 'title' => 'delete']) ?>
                                    <?php endif; ?>
                                <?php endif; ?>

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
                        <form id="form-edit-<?= $comment->id ?>" class="ui reply form hideit"
                              style="display: none;">
                            <div class="field">
                                                <textarea
                                                    id="edit-<?= $comment->id ?>"><?= h($comment->body) ?></textarea>
                            </div>
                            <div onclick="submitEdit(<?= $comment->id ?>)"
                                 class="ui blue labeled submit icon button">
                                <i class="icon edit"></i> Edit Comment
                            </div>
                        </form>
                        <?php nestedComments($childComments, $comment, $loggedUser) ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    /*******************************
           Overrides
*******************************/

    .ui.comments .comment {
        border-radius: 0.5em;
        box-shadow: 0px 1px 1px 1px rgba(0, 0, 0, 0.1);
    }

    .ui.comments .comment .comments .comment {
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: none;
    }
</style>

<?= $this->Html->script('../semantic-ui/dist/semantic.min.js') ?>

<script>


    $(function () {
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
