<nav id="navigation" class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home">Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <?php foreach ($view as $item): ?>
                <a class="nav-item nav-link" href="<?php print $item['link']; ?>"><?php print $item['title']; ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>