<?php

$cakeDescription = 'Blog';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('../semantic-ui/dist/semantic.min.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>


    <?= $this->Html->script('jquery.min.js') ?>

    <?= $this->Html->script('bootstrap.min.js') ?>

<style>
    #dash {
        cursor: pointer;
    }
</style>
</head>
<body>
<div class="ui left demo vertical inverted sidebar labeled icon menu">
    <?= $this->Html->link('<i class="home icon"></i>Dashboard', ['controller' => 'Pages', 'action' => 'display', 'dashboard'], ['class' => 'item', 'escape' => false]); ?>

    <?= $this->Html->link('<i class="add square icon"></i>Add Article', ['controller' => 'Articles', 'action' => 'add'], ['class' => 'item', 'escape' => false]) ?>


    <?= $this->Html->link('<i class="newspaper icon"></i>Articles', ['controller' => 'Articles', 'action' => 'adindex'], ['class' => 'item', 'escape' => false]) ?>


    <?= $this->Html->link('<i class="comments outline icon"></i>Comments', ['controller' => 'Comments', 'action' => 'index'], ['class' => 'item', 'escape' => false]) ?>


    <?= $this->Html->link('<i class="tags icon"></i>Tags', ['controller' => 'Tags', 'action' => 'index'], ['class' => 'item', 'escape' => false]) ?>


    <?= $this->Html->link('<i class="user icon"></i>Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'item', 'escape' => false]) ?>


</div>
<div class="pusher">

    <div class="ui large menu stackable container inverted">
        <?php if (isset($loggedUser) && $loggedUser['role'] === 'admin') : ?>

            <a id="dash" class="navbar-brand">Dashboard</a>
        <?php endif; ?>

        <?= $this->Html->link('Home', ['controller' => 'Articles', 'action' => 'index'], ['class' => 'item active']) ?>

        <a class="item">
            About
        </a>
        <a class="item">
            Contact
        </a>


        <?php if (!isset($loggedUser)): ?>
            <div class="right menu">
                <div class="item">
                    <div class="ui inverted button">
                        <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'login', 'class' => 'ui primary button']) ?>
                    </div>
                </div>
                <div class="item">
                    <div class="ui inverted button">
                        <?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'register']) ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>

        <?php if (isset($loggedUser)): ?>

            <div class="right menu">
                <div id="drop" class="ui dropdown item ">
                    <?= $loggedUser['username'] ?> <i class="dropdown icon"></i>
                    <div class="menu">
                        <?= $this->Html->link('Profile', ['controller' => 'Users', 'action' => 'edit', $loggedUser['id']], [ 'class' => 'profile-btn item']) ?>
                        <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'],  ['class' => 'profile-btn item']) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>


<?= $this->Flash->render() ?>


<div class="container clearfix">

    <?= $this->fetch('content') ?>
</div>

<footer>
</footer>
</div>
<?= $this->Html->script('../semantic-ui/dist/semantic.min.js') ?>

<script>


    $(function () {
        //menu dropdown
        $('.ui.dropdown').dropdown({
            on: 'hover'
        });

        //dropdown links
        $('.profile-btn').on('click', function () {
            window.location = $(this).attr('href');
        });

        //dash link
        $('#dash').on('click', function () {
            $('.ui.labeled.icon.sidebar')
                .sidebar('toggle')
            ;
        });


    })

</script>


</body>
</html>
