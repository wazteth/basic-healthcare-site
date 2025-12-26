<?php

// Get all blog posts
$sql = "SELECT * FROM blog_posts";
$result = mysqli_query($con, $sql);

// Display all blog posts
if (mysqli_num_rows($result) > 0) {
    while ($post = mysqli_fetch_assoc($result)) {
        echo "<h2>" . $post['title'] . "</h2>";
        echo "<p>" . $post['content'] . "</p>";
        echo "<p>Posted on " . $post['date_posted'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "No blog posts found.";
}
