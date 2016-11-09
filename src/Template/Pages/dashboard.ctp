<div id="content">
    <div class="col-md-5 col-sm-12">
        <div id="comments"></div>
    </div>
</div>



<script>
    $(function () {
        var commentsUrl = '<?= $this->Url->build(['controller' => 'Comments', 'action' => 'commentbox']); ?>';
        $('#comments').load(commentsUrl);
    })
</script>