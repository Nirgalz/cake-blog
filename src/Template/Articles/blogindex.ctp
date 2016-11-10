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
                        <a id="toggle-comment-' . $childComment->id . '" class="reply add-comment">Reply</a>
                    </div>
                </div>
            </div>
            <form id="form-comment-'. $childComment->id.'" class="ui reply form hideit" style="display: none;">
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
            <div id="toggle-article-<?= $article->id?>" class="add-comment btn btn-default">Reply</div>
        </div>
        <form id="form-article-<?= $article->id?>" class="ui reply form hideit" style="display: none;">
            <div class="field">
                <textarea id="article-<?= $article->id ?>"></textarea>
            </div>
            <div onclick="submitComment(<?= $article->id ?>, null)" class="ui blue labeled submit icon button">
                <i class="icon edit"></i> Add Reply
            </div>
        </form>

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
                                    <a id="toggle-comment-<?= $comment->id?>" class="reply add-comment">Reply</a>
                                </div>
                            </div>
                            <form id="form-comment-<?= $comment->id?>" class="ui reply form hideit" style="display: none;">
                                <div class="field">
                                    <textarea id="comment-<?= $comment->id?>"></textarea>
                                </div>
                                <div onclick="submitComment(<?= $article->id?>, <?= $comment->id ?>)" class="ui blue labeled submit icon button">
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

<script>



    $(function () {
        //toggles add comment forms
        $('.add-comment').on('click', function () {
            var data = $(this).attr('id').split('-');
            var form = $('#form-'+data[1] +'-' + data[2] + '');
            if (!(form.attr('style') == 'display: none;')) {
                form.addClass('hideit').hide('slow');
            } else {
                form.removeClass('hideit').show('slow');
                $('.hideit').hide('slow');
                form.addClass('hideit');
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
        console.log(data);
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