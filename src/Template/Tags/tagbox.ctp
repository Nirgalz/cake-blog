
<h4 class="ui top attached inverted header">Filter by Tags</h4>
<div class="ui attached segment bottom">
    <table class="ui selectable celled table">
        <tbody>
        <?php foreach ($tags as $tag) : ?>
            <tr><td class="tag-btn" id="tag-btn-<?= $tag->id ?>"><?= $tag->name?> (<?= count($tag->articles)?>)</td></tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>

<style>
    .tag-btn {
        cursor: pointer;
    }
</style>

<script>
    $('.tag-btn').on('click', function () {
        var id = $(this).attr('id').split('-');
        window.location = '/articles/blogindex/' + id[2];
    })
</script>