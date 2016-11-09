<?php
function nestedComments($childComments, $comment)
{
    echo '<div class="comments">';
    foreach ($childComments as $childComment) {
        if ($childComment->comment_id == $comment->id) {
            echo '
            <div class="comment">
                <a class="avatar">
                    <img src="/images/avatar/small/jenny.jpg">
                </a>
                <div class="content">
                    <a class="author">' . $childComment->user->username . '</a>
                    <div class="metadata">
                        <span class="date">' . $childComment->created . '</span>
                    </div>
                    <div class="text">
                        <p>' . $childComment->body . '</p>
                    </div>
                    <div class="actions">
                        <a id="comment-' . $childComment->id . '" class="reply">Reply</a>
                    </div>
                </div>
            </div>
      
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
            <div id="article-<?= $article->id ?>" class="add-comment btn btn-default">Comment</div>
        </div>

        <?php if (!empty($article->comments)) : ?>
            <div class="ui comments">
                <h3 class="ui dividing header">Comments</h3>
                <?php foreach ($article->comments as $comment) : ?>
                    <?php if ($comment->comment_id == null) : ?>
                        <div class="comment">
                            <a class="avatar">
                                <img src="/images/avatar/small/elliot.jpg">
                            </a>
                            <div class="content">
                                <a class="author"><?= $comment->user->username ?></a>
                                <div class="metadata">
                                    <span class="date"><?= $comment->created ?></span>
                                </div>
                                <div class="text">
                                    <p><?= $comment->body ?></p>
                                </div>
                                <div class="actions">
                                    <a id="article-<?= $comment->article_id ?>" class="reply">Reply</a>
                                </div>
                            </div>
                            <?php nestedComments($childComments, $comment) ?>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <form class="ui reply form hidden">
                    <div class="field">
                        <textarea></textarea>
                    </div>
                    <div class="ui blue labeled submit icon button">
                        <i class="icon edit"></i> Add Reply
                    </div>
                </form>
            </div>
        <?php endif; ?>


    </div>
<?php endforeach; ?>

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
