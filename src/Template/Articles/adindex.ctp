
<div class="articles index large-9 medium-8 columns content">
    <h3><?= __('Articles') ?></h3>
    <table cellpadding="0" cellspacing="0" class="ui very basic table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('published') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
            <tr>
                <td><?= $this->Number->format($article->id) ?></td>
                <td><?= h($article->title) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= h($article->modified) ?></td>
                <td><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
                <?php if ($article->published == 1): ?>
                <td><button id="published-<?= $article->id?>" class="ui mini green circular icon button pub-btn"><i class="icon checkmark"></i></button>
                    <?php endif; ?>
                    <?php if ($article->published == 0): ?>
                <td><button id="draft-<?= $article->id?>" class="ui mini red circular icon button pub-btn"><i class="icon remove"></i></button>
                    <?php endif; ?>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $article->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $article->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>

<script>
    $(function () {
        $('.pub-btn').on('click', function () {
            var button = $(this);
            var data = button.attr('id').split('-');
            var articleState = data[0];
            var articleId = data[1];

            if (articleState == 'published') {
                $(this).removeClass('green').addClass('loading').children().removeClass('checkmark');

                var datajax = {
                    published: 0
                };
                var newState = 'draft-' + articleId;
                var buttonClass = 'red';
                var iconClass = 'remove';
            } else if (articleState == 'draft') {
                $(this).removeClass('red').addClass('loading').children().removeClass('remove');
                var datajax = {
                    published: 1
                };
                var newState = 'published-' + articleId;
                var buttonClass = 'green';
                var iconClass = 'checkmark';
            }


            $.ajax({
                type: 'post',
                url: '<?= $this->Url->build(["controller" => "Articles", "action" => "changepublished"])?>' + '/' + articleId,
                data: datajax,
                success: function () {
                    button.children()
                        .addClass(iconClass);
                    button.removeClass('loading')
                        .addClass(buttonClass)
                        .attr('id', newState);
                }

            })
        })
    })
</script>