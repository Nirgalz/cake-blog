<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success" onclick="this.classList.add('hidden')">
    <div class="ui positive message">
        <i class="close icon"></i>
        <div class="header">
            <?= $message ?>
        </div>
    </div>

</div>