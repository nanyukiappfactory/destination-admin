
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Destination Laikipia</title>
    </head>

    <body class="text-center">
        <?php echo form_open($this->uri->uri_string());?>
            <img class="mb-4" src="<?php echo base_url();?>/assets/images/logo.jpg" alt="" width="72" height="72">           
            <h1 class="h3 mb-3 font-weight-normal">Sign in</h1>         
            <input type="text" id="inputUsername" name="admin_username" class="form-control" placeholder="Admin" required autofocus>           
            <input type="password" id="inputPassword" name="admin_password" class="form-control" placeholder="Password" required>           
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
         <?php echo form_close();?>
    </body>
</html>
