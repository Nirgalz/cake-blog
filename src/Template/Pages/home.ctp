<div class="row">
    <div class="col-md-8 col-sm-12">
        <div id="articles"></div>
    </div>
    <div class="col-md-4 col-sm12">
        <div id="tags"></div>
        <div id="comments"
    </div>
</div> 


<script>
    $(function () {

        //loads articles list
        var articleUrl = '<?= $this->Url->build(['controller' => 'Articles', 'action' => 'blogindex']); ?>';
        $('#articles').load(articleUrl);

        //loads tags list
        var tagsUrl = '<?= $this->Url->build(['controller' => 'Tags', 'action' => 'index']); ?>';
        $('#tags').load(tagsUrl);

        //loads last comments
        var commentsUrl = '<?= $this->Url->build(['controller' => 'Comments', 'action' => 'index']); ?>';
        $('#comments').load(commentsUrl);
    })
</script>