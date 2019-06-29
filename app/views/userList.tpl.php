<section class="user-list content container-fluid">
    <h1>User List:</h1>
    <?php foreach ($view['users'] as $user): ?>
        <ul>
            <li>
                <div>Email: <?php print $user->getEmail(); ?></div>
                <div>Full name: <?php print $user->getFullName(); ?></div>
                <div>Photo:</div>
                <img src="<?php print $user->getPhoto(); ?>" alt="<?php print $user->getFullName(); ?> User Photo">
            </li>
        </ul>
    <?php endforeach; ?>
</section>