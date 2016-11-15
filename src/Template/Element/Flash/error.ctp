<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="message error" onclick="this.classList.add('hidden');">
    <div class="ui negative message">
        <i class="close icon"></i>
        <div class="header">
            <?= $message ?>
        </div>
    </div>
</div>
