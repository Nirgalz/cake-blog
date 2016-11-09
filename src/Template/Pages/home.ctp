    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div id="articles"></div>
        </div>
        <div class="col-md-4 col-sm12">
            <div id="recherche">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Search the blog
                    </div>
                    <div class="panel-body">
                        <form class="form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
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