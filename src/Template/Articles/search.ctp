<div class="ui top  segment">
    <h4>Results for : <?= $search?></h4>
</div>

<div class="ui attached segment articles index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="ui selectable celled table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td class="article-btn" id="article-btn-<?= $article->id ?>"><?= h($article->title) ?></td>
                <td><?= h($article->created) ?></td>
                <td><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>

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

<style>
    .article-btn {
        cursor: pointer;
    }
</style>


<script>
    $('.article-btn').on('click', function () {
        var id = $(this).attr('id').split('-');
        window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "view"])?>' + '/' + id[2];
    });
</script>