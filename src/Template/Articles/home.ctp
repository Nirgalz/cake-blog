<h3 class="ui top attached header">Benvenidos</h3>
<div class="ui attached segment">

    <div class="ui grid">
        <div class="eight wide column">
            <h4 class="ui top attached inverted header">A propos</h4>
            <div class="ui attached segment bottom">
                <p>
                    This blog is about so many cool stuff !
                    <br>
                    Click on any article and you won't believe what you're about to see !
                </p>

            </div>
        </div>
        <div class="eight wide column">
            <h4 class="ui top attached inverted header">Statistiques</h4>
            <div class="ui attached segment bottom">
                <table class="ui celled table">
                    <tbody>

                            <tr><td ><?= count($articles)?> articles </td></tr>
                            <tr><td ><?= count($users)?> users </td></tr>
                            <tr><td ><?= count($comments)?> comments </td></tr>


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>