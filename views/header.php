
<?php
$nav = GetPrimaryNavigationItems();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta name='Author' content='Adam Kelley'>
        <title>Earth Sketch</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/CSS/main.css" type="text/css" rel ="stylesheet">
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js" ></script>
        
    </head>
  
    <body>
        <header>
            <div id="banner">
                <h1>earth sketch</h1>
            </div>
            
            <nav>
                <ul>
                    <?php foreach ($nav as $action => $text) : ?>
                    <li id="topnav">
                        <a href="/index.php?action=<?php echo $action ?>" title="<?php echo $text; ?>"><?php echo $text ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </header>
        <div id="content">



