<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="<?= h($class) ?>" onclick="this.classList.add('hidden');">
    <div class="ui info message">
        <i class="close icon"></i>
        <div class="header">
            <?= $message ?>
        </div>
    </div>
</div>
