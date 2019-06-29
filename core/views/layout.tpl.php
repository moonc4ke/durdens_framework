<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php print $view['title']; ?></title>

    <!-- Stylesheet (Head) -->
    <?php if ($view['stylesheets'] ?? false): ?>
        <?php foreach ($view['stylesheets'] as $stylesheet): ?>
            <link rel="stylesheet" type="text/css" href="<?php print $stylesheet; ?>">
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Scripts (Head) -->
    <?php if ($view['scripts']['head'] ?? false): ?>
        <?php foreach ($view['scripts']['head'] as $script): ?>
            <script type="text/javascript" src="<?php print $script; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<!-- Scripts (Body Start) -->
<?php if ($view['scripts']['body_start'] ?? false): ?>
    <?php foreach ($view['scripts']['body_start'] as $script): ?>
        <script type="text/javascript" src="<?php print $script; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Header -->
<?php if ($view['header'] ?? false): ?>
    <div class="header-wrapper">
        <?php print $view['header']; ?>
    </div>
<?php endif; ?>

<!-- Content -->
<?php if ($view['content'] ?? false): ?>
    <div class="content-wrapper">
        <?php print $view['content']; ?>
    </div>
<?php endif; ?>

<!-- Footer -->
<?php if ($view['footer'] ?? false): ?>
    <div class="footer-wrapper">
        <?php print $view['footer']; ?>
    </div>
<?php endif; ?>

<!-- Scripts (Body End) -->
<?php if ($view['scripts']['body_end'] ?? false): ?>
    <?php foreach ($view['scripts']['body_end'] as $script): ?>
        <script type="text/javascript" src="<?php print $script; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>