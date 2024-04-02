    <?php 
    //including the shared header
    include('shared/header.php'); 
    $title = 'World Languages and Speakers';
    
    //including the shared Database
    include('shared/db.php');

    //set up query to fetch show data
    $sql = "SELECT * FROM Language";
    $cmd = $db->prepare($sql);

    // runnig query and storing results 
    $cmd->execute();
    $Language = $cmd->fetchAll();

    //Showing the Language list
    echo '<h1>Language Table</h1>';
    echo '<table><thead><th>Language</th><th>Photo</th><th>Native Speakers</th><th>Country</th><th>linguisticage</th>';
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
            echo '<img src="img/uploads/' . $Languages['photo'] . '" />';
        }
        echo '</td>
        <td>' . $Languages['NativeSpeakers'] . '</td>
        <td>' . $Languages['Country'] . '</td>
        <td>' . $Languages['linguisticage'] . '</td>';
        if (!empty($_SESSION['username'])) {
            echo '<td class="actions">
                <a href="edit-language.php?languageId=' . $Languages['languageId'] . '">
                    Edit
                </a>&nbsp;
                <a href="delete-language.php?languageId=' .$Languages['languageId'] . '" onclick="return confirmDelete();">
                    Delete
                </a>
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