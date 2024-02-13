<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include('shared/header.php'); 
    $title = 'World Languages and Speakers';
    
    include('shared/db.php');

    $sql = "SELECT * FROM Language";
    $cmd = $db->prepare($sql);

    $cmd->execute();
    $Language = $cmd->fetchAll();

    echo '<h1>Language Table</h1>';
    echo '<table><thead><th>Language</th><th>Native Speakers</th><th>Country</th><th>linguistic age</th></thead>';

    foreach ($Language as $Languages) {
        echo '<tr>
        <td>' . $Languages['Language'] . '</td>
        <td>' . $Languages['NativeSpeakers'] . '</td>
        <td>' . $Languages['Country'] . '</td>
        <td>' . $Languages['linguisticage'] . '</td>
        </tr>';
          }

    echo '</table>';

    $db = null;
    ?>
</body>
</html>