
<div class="comments index large-9 medium-8 columns content">
    <h3><?= __('Comments') ?></h3>
    <table cellpadding="0" cellspacing="0" class="ui very basic table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('article_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('comment_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $this->Number->format($comment->id) ?></td>
                <td><?= $comment->has('user') ? $this->Html->link($comment->user->username, ['controller' => 'Users', 'action' => 'view', $comment->user->username]) : '' ?></td>
                <td><?= $comment->has('article') ? $this->Html->link($comment->article->title, ['controller' => 'Articles', 'action' => 'view', $comment->article->id]) : '' ?></td>
                <td><?= $comment->has('parent_comment') ? $this->Html->link($comment->parent_comment->id, ['controller' => 'Comments', 'action' => 'view', $comment->parent_comment->id]) : '' ?></td>
                <td><?= h($comment->created) ?></td>
                <td><?= h($comment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="icon unhide large"></i>', ['action' => 'view', $comment->id], ['class' => 'ui icon circular button teal', 'escape' => false, 'title' => 'view']) ?>
                    <?= $this->Html->link('<i class="icon edit large"></i>', ['action' => 'edit', $comment->id], ['class' => 'ui icon circular button yellow', 'escape' => false, 'title' => 'edit']) ?>
                    <?= $this->Form->postLink('<i class="icon remove large"></i>', ['action' => 'delete', $comment->id],['class' => 'ui icon circular button orange', 'escape' => false, 'title' => 'delete'], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
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
