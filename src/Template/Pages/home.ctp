<div class="row">
    <div class="col-md-8 col-sm-12">
        <div id="articles"></div>
    </div>
    <div class="col-md-4 col-sm12">
        <div id="recherche">
            <h4 class="ui top attached inverted header">Search the blog</h4>
            <div class="ui attached segment bottom">
                <div class="ui category search">
                    <div class="ui icon input">
                        <input class="prompt" type="text" placeholder="Search the blog...">
                        <i class="search icon"></i>
                    </div>
                    <div class="results"></div>
                </div>
            </div>
        </div>

        <div id="tags"></div>
        <div id="comments"></div>
    </div>
</div>

<script>
    $(function () {

        //loads articles list
        var articleUrl = '<?= $this->Url->build(['controller' => 'Articles', 'action' => 'blogindex']); ?>';
        $('#articles').load(articleUrl);

        //loads tags list
        var tagsUrl = '<?= $this->Url->build(['controller' => 'Tags', 'action' => 'tagbox']); ?>';
        $('#tags').load(tagsUrl);

        //loads last comments
        var commentsUrl = '<?= $this->Url->build(['controller' => 'Comments', 'action' => 'commentbox']); ?>';
        $('#comments').load(commentsUrl);
    })
</script>