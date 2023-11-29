<?php

require_once "App/View/header.php";
require_once "App/Controller/user.php";

if (!isset($_SESSION['USERID'])) {
    redirect('login.php');
} else {
    // Logout Button
    if (isset($_GET['action'])) {
        if ($_GET['action'] === "Logout") {
            session_destroy();
            redirect("login.php");
        }
    }

    // Get All Posts
    $myStory = new User();
    $allStories = $myStory->getPosts();

    // Insert Story
    if (isset($_POST['postStory'])) {
        if (isset($_POST['titleStory']) && isset($_POST['storyBox'])) {
            $myStory->insert($_POST['titleStory'], $_POST['storyBox']);
            redirect("index.php");
        } else {
            echo "alert('Both Title and Story Required!')";
        }
    }

    if (isset($_GET['delete'])) {
        $myStory->delete($_GET['delete']);
        redirect("index.php");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Assets/Styles/main.css">
    <link rel="stylesheet" href="Assets/Library/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Sidebar -->
    <div class="leftSidebar">
        <div class="titleBar">
            <h3><i class="fa fa-globe fa-lg"></i> StoryMie</h3>
        </div>
        <div class="card" style="width: 100%; padding-top: 20px;" onclick="switch_card('storyTime')">
            <div class="container">
                <h3>Story Time!</h3>
            </div>
        </div>

        <div class="card" style="width: 100%; padding-top: 20px;" onclick="switch_card('myLife')">
            <div class="container">
                <h3>My Life</h3>
            </div>
        </div>
        <div class="footer">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                <input class="sidebarLogout" style="border-right: 1px solid black;" type="submit" value="Settings">
                <input class="sidebarLogout" style="position: absolute;right: 0px; border-left: 1px solid black;" type="submit" name="action" value="Logout">
            </form>
        </div>
    </div>

    <!-- Section: Story Time -->
    <div class="bodyCard" id="storyTimeBtn" hidden>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h1>Hey <?php echo $_SESSION['USERNAME']; ?>! So, What Happened Today?</h1><br>
            <input class="titleStory" placeholder="Story Title" type="text" name="titleStory" id="storyTitleID">
            <textarea name="storyBox" placeholder="So what happened was..." id="storyBodyID" cols="54" rows="12"></textarea>
            <div class="writeStoryBtn">
                <input name="postStory" type="submit" value="Submit" class="myBtn" style="background-color: cadetblue; color: white"">
            </div>
        </form>
    </div>

    <!-- Section: My Life -->
    <div class=" bodyCard" id="myLife">
                <h1 style="margin-left: 42%; font-size: 30px;">My Home</h1>
                <?php foreach ($allStories as $story) : ?>
                    <div class="myLifeElements">
                        <!-- Remove Button -->
                        <a class="removeBTN" href="<?php echo $_SERVER['PHP_SELF'] . "?delete=" . $story['id'] ?>">
                            <span class="fa fa-trash fa-lg"></span>
                        </a>

                        <!-- Title -->

                        <a href="#" style="text-decoration: none; font-weight: bold; color: black;">
                            <h1><?php echo $story['title']; ?></h1>
                        </a>
                        <p class="dateTime">Date Posted: <?php echo $story['created_at']; ?></p>
                        <p style="text-align: justify;">
                            <?php echo $story['story']; ?>
                        </p>

                    </div>
                <?php endforeach; ?>
            </div>


            <script src="Assets/JS/main.js"></script>
</body>

</html>