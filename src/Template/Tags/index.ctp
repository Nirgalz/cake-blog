
    <h3 class="ui top header attached inverted"><?= __('Tags') ?></h3>
    <div class="ui attached segment">
    <button id="add-tag" class="ui button"><i class="icon tags"></i>Add a Tag</button>
<br>
        <br>
    <table cellpadding="0" cellspacing="0" class="table table-responsive table-hover">

        <tbody>
            <?php foreach ($tags as $tag): ?>
            <tr>
                <td><?= $this->Html->link('<i class="icon large tag"></i>'.$tag->name, ['controller' => 'Articles', 'action' => 'blogindex', $tag->name], ['class' => 'ui button large icon','escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="icon remove large"></i>', ['action' => 'delete', $tag->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tag->id),'class' => 'ui button icon circular orange', 'escape' => false, 'title' => 'delete']) ?>

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
    $('#add-tag').on('click', function () {
        window.location = '<?= $this->Url->build(["controller" => "Tags", "action" => "add"])?>';

    })
</script>