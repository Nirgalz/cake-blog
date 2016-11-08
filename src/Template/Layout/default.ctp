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


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Accueil</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <?= $this->Html->link('Articles', ['controller' => 'Articles', 'action' => 'index'], ['class' => 'active']) ?>
                </li>
                <li>
                    <a href="">About</a>
                </li>
                <li>
                    <a href="">Contact</a>
                </li>
            </ul>
            <?php if (!isset($loggedUser)): ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?= $this->Html->link('Connection', ['controller' => 'Users', 'action' => 'login']) ?>
                    </li>
                    <li>
                        <?= $this->Html->link('Register', ['controller' => 'Users', 'action' => 'register'])?>
                    </li>
                </ul>
            <?php endif; ?>

            <?php if (isset($loggedUser)): ?>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><?= $loggedUser['username']?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?= $this->Html->link('Profile', ['controller' => 'Users', 'action' => 'view', $loggedUser['id']])?></li>
                            <li><?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'])?></li>
                        </ul>
                    </li>
                </ul>

            <?php endif; ?>

            <form class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>

<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('bootstrap.min.js') ?>
</body>
</html>
