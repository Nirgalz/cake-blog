<h3 class="ui top attached inverted header">
    Users
</h3>
<div class="ui attached segment">
<?= $this->Html->link('<i class="icon large user"></i>New User', ['action' => 'add'], ['class' => 'ui button', 'escape' => false]) ?>

    <table cellpadding="0" cellspacing="0" class="ui very basic table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role') ?></th>

                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->email) ?></td>

                <td><?= h($user->created) ?></td>
                <td><?= h($user->modified) ?></td>
                <?php if ($user->role == 'admin'): ?>
                <td><button id="admin-<?= $user->id?>" title="admin" class="ui purple icon button pub-btn"><i class="icon doctor large"></i></button>
                    <?php endif; ?>
                    <?php if ($user->role == 'guest'): ?>
                <td><button id="guest-<?= $user->id?>" title="guest" class="ui olive icon button pub-btn"><i class="icon user large"></i></button>
                    <?php endif; ?>
                <td class="actions">
                    <?= $this->Html->link('<i class="icon unhide large"></i>', ['action' => 'view', $user->username], ['class' => 'ui icon circular button teal', 'escape' => false, 'title' => 'view']) ?>
                    <?= $this->Html->link('<i class="icon edit large"></i>', ['action' => 'edit', $user->id], ['class' => 'ui icon circular button yellow', 'escape' => false, 'title' => 'edit']) ?>
                    <?= $this->Form->postLink('<i class="icon remove large"></i>', ['action' => 'delete', $user->id],['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'ui icon circular button orange', 'escape' => false, 'title' => 'delete']) ?>
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
            var roleState = data[0];
            var userId = data[1];

            if (roleState == 'admin') {
                $(this).removeClass('purple').addClass('loading').children().removeClass('doctor');

                var datajax = {
                    role: 'guest'
                };
                var newState = 'guest-' + userId;
                var buttonClass = 'olive';
                var iconClass = 'user';
                var title = 'guest';
            } else if (roleState == 'guest') {
                $(this).removeClass('olive').addClass('loading').children().removeClass('user');
                var datajax = {
                    role: 'admin'
                };
                var newState = 'admin-' + userId;
                var buttonClass = 'purple';
                var iconClass = 'doctor';
                var title = 'admin'
            }


            $.ajax({
                type: 'post',
                url: '<?= $this->Url->build(["controller" => "Articles", "action" => "changerole"])?>' + '/' + userId,
                data: datajax,
                success: function () {
                    button.children()
                        .addClass(iconClass);
                    button.removeClass('loading')
                        .addClass(buttonClass)
                        .attr('id', newState)
                        .attr('title', title);
                }

            })
        })
    })
</script>