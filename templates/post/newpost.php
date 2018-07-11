<?php




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

        <div class="addpost-form">
            <form method="post" action="/post/add">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"  id="basic-addon1"><?php echo $Local["title"] ?></span>
                    </div>
                    <input class="form-control" type="text" placeholder="<?php echo $Local["title"] ?>" name="title" minlength="10" maxlength="140"  pattern="A-Za-z-А-Яа-яЁё0-9?!.,;:-\s]{10,140}" required>
                </div>
                <textarea id="summernote" name="description" minlength="100" maxlength="10000" required></textarea>
               <br>
                <button class="btn btn-outline-success" type="submit"><?php echo $Local["publish"] ?></button>
            </form>

        </div>

    </main>


<?php require_once "templates/footer.php"?>

  <!-- WYSIWYG styles and scripts -->

  <!-- include summernote css/js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

  <!-- include summernote css/js -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>



  <script>
      $('#summernote').summernote({
          placeholder: 'Type here',
          tabsize: 2,
          height: 450
      });
      $('.note-popover').css({'display': 'none'});
  </script>
