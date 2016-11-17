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
    <?= $this->Html->css('semantic.min.css') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>


    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('semantic.min.js') ?>

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

            <a id="dash" class="item blue">Dashboard</a>
        <?php endif; ?>

        <?= $this->Html->link('Home', ['controller' => 'Articles', 'action' => 'home'], ['id' => 'home-nav', 'class' => 'item navb']) ?>

        <?= $this->Html->link('Articles', ['controller' => 'Articles', 'action' => 'blogindex'], ['id' => 'blog-nav', 'class' => 'item navb']) ?>

<!--
        <?= $this->Html->link('About', ['controller' => 'Pages', 'action' => 'display', 'about'], ['id' => 'about-nav', 'class' => 'item navb']) ?>

-->

        <?= $this->Html->link('Contact', ['controller' => 'Contact', 'action' => 'index'], ['id' => 'contact-nav', 'class' => 'item navb']) ?>



        <?php if (!isset($loggedUser)): ?>
                <div class="item right">
                    <div class="ui category small search">
                        <div class="ui icon input">
                            <input id="search-form" class="prompt" type="text" placeholder="Search the blog...">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </div>

                <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'login'], ['class' => 'item']) ?>


                <?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'register'], ['class' => 'item']) ?>


        <?php endif; ?>

        <?php if (isset($loggedUser)): ?>

                <div class="item right">
                    <div class="ui category small search">
                        <div class="ui icon input">
                            <input id="search-form" class="prompt" type="text" placeholder="Search the blog...">
                            <i class="search icon"></i>
                        </div>
                    </div>
                </div>
                <div id="drop" class="ui simple dropdown item ">
                    <?= $loggedUser['username'] ?> <i class="dropdown icon"></i>
                    <div class="menu">
                        <?= $this->Html->link('Profile', ['controller' => 'Users', 'action' => 'edit', $loggedUser['id']], ['class' => 'profile-btn item']) ?>
                        <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'profile-btn item']) ?>
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
<?= $this->Html->script('../sharer/sharer.min.js') ?>


<script>


    $(function () {

        function activateNavMenu() {
            var url = window.location.pathname;
            if (url.startsWith('/about')) {
                var menuItem = $('#about-nav');
            } else if (url.startsWith('/contact')) {
                var menuItem = $('#contact-nav');
            } else  if (url.startsWith('/articles')) {
                var menuItem = $('#blog-nav');
            } else  if (url.startsWith('/')) {
                var menuItem = $('#home-nav');
            }

            menuItem.addClass('active');
        }
        activateNavMenu();



        //search form
        $('#search-form').keypress(function (e) {
            var search = $('#search-form').val();
            if (e.which == 13) {
                window.location = '<?= $this->Url->build(["controller" => "Articles", "action" => "search"])?>' + '/' + search;

            }
        });


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
