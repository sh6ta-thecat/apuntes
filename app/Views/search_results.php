<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results</h2>
    <a href="/conecter/dashboard">Back to Dashboard</a>
    <ul>
        <?php if (count($users) > 0): ?>
            <?php foreach ($users as $user): ?>
                <li><a href="/conecter/@<?php echo $user['name']; ?>"><?php echo $user['name']; ?></a></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No users found</li>
        <?php endif; ?>
    </ul>
</body>
</html>
