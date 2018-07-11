<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 18:02
 */




/** get post id from the URL and check for a number value */
if(intval($url[2])) $id = $url[2];
else exit();

/** getting Post info */
$Post = $Kernel->get("Posts")->get(["id" => $id]);
$Post = $Post[0];

/** Post Author Name */
$Post["author"] = $Kernel->get("Posts")->getAuthor($id);

if($Post["author"] == $_SESSION["login"]) $isAuthor = true;
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>New Post</title>

    <!-- Basic styles -->
    <?php require_once "templates/css.php"?>

</head>

<body>

<?php require_once "templates/header.php"?>



<main>
    <div class="py-4">

        <div class="container col-md-7">
            <h1><?php echo $Post['title']; ?></h1>
            <p class="article-paragraph"><?php echo $Post["text"]; ?></p>

            <p class="author_name"><span class="trans-text"><?php echo $Local["postBy"]; ?>:</span><strong>  <a href="#"><?php echo $Post["author"] ?></a></strong>
                <span class="postdate"><?php echo substr($Post["datetime"],0,16); ?></span></p>

            <?php if($isAuthor): ?>
            <div class="reduct" style="display: inline-block">
                <a href="edit/<?php echo $Post["id"]; ?>"><button class="btn btn-outline-success"><?php echo $Local["edit"] ?></button></a>
                <button class="btn btn-outline-danger" onclick="Delete('<?php echo $Post["id"]; ?>')"><?php echo $Local["delete"] ?></button>
            </div>
             <br><br>
            <?php endif; ?>

            <div class="comments" style="text-align: center;">
                <button id="comments_button" class="btn btn-outline-primary" onclick="getComments( <?php echo $Post['id']; ?> )"><?php echo $Local["showComments"] ?></button>
                <hr>
                <div id="comments_container" class="col-md-10 center" style="display: none;text-align: left">

                    <li class="list-group-item comment_info" onclick="ShowForm()"><?php echo $Local["addComment"]; ?></li>

                    <form action="#">

                        <li id="add_comment_block" class="list-qroup-item" style="display:none;">

                            <input class="form-control" maxlength="50" id="CommentNameForm" value="<?php echo $_SESSION['login']; ?>" placeholder="<?php echo $Local["typeName"]; ?>" required>

                            <textarea class="form-control" maxlength="240" id="CommentTextForm" rows="2" placeholder="<?php echo $Local["typeCommentHere"]; ?>" required></textarea>

                            <button id="button_send_comment" onclick="SendComment('<?php echo $Post['id']; ?>')" class="btn btn-outline-success"><?php echo $Local["send"]; ?></button>

                        </li>
                    </form>


                    <ul id="comments_list" class="list-group">
                    </ul>
                </div>
            </div>
        </div>
    </div>











<?php require_once "templates/footer.php"?>





