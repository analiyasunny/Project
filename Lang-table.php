<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/site.css">
</head>
<body>
    <?php 
    //including the shared header
    include('shared/header.php'); 
    $title = 'World Languages and Speakers';
    
    try {
    //including the shared Database
    include('shared/db.php');

    //set up query to fetch show data
    $sql = "SELECT * FROM Language";
    $cmd = $db->prepare($sql);

    // running query and storing results 
    $cmd->execute();
    $Language = $cmd->fetchAll();
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}

    //Showing the Language list
    echo '<h1>Language Table</h1>';
    echo '<table>
            <colgroup>
                <col />
                <col />
                <col />
                <col />
                <col />
                <col />
            </colgroup>
            <thead>
                <th>Language</th>
                <th>Photo</th>
                <th>Native Speakers</th>
                <th>Country</th>
                <th>Linguistic Age</th>'; // Changed 'linguisticage' to 'Linguistic Age'
                if (!empty($_SESSION['username'])) {
                    echo '<th>Actions</th>';
                }
    echo '</thead>';          
    // looping through the data result from the query, and displaying each Language name
    foreach ($Language as $Languages) {
        echo '<tr>
                <td>' . $Languages['Language'] . '</td>
                <td>';
                if ($Languages['photo'] != null) {
                    echo '<img src="img/uploads/' . $Languages['photo'] . '" class="thumbnail" />';
                }
        echo    '</td>
                <td>' . $Languages['NativeSpeakers'] . '</td>
                <td>' . $Languages['Country'] . '</td>
                <td>' . $Languages['linguisticage'] . '</td>'; // Changed 'linguisticage' to 'Linguistic Age'
                if (!empty($_SESSION['username'])) {
                    echo '<td class="actions">
                            <a href="edit-language.php?languageId=' . $Languages['languageId'] . '">Edit</a>&nbsp;
                            <a href="delete-language.php?languageId=' .$Languages['languageId'] . '" onclick="return confirmDelete();">Delete</a>
                          </td>';
                }
        echo '</tr>';
    }

    // end of the list
    echo '</table>';

    //disconnect
    $db = null;
    ?>
</body>
</html>
