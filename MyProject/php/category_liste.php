<?php

use MyProject\php\cat\Cats;
use MyProject\php\cat\row\Category;

include "setup.php";
is_logged_in();
include "header.php";

?>
<h1>Categories</h1>

<?php

echo "<table border='1'>";

    echo "<thead>";
    echo "<th>Titel</th>";
    echo "</thead>";
    echo "<tbody>";

    $category = new Cats();
    $allCats = $category->allCats();

    foreach ($allCats as $titel) {
        echo "<tr>";
        echo "<td>" . $titel->titel . "</td>";
      


        echo "<td>" . "<a href='category_bearbeiten.php?id={$titel->id}'>Edit</a>" ;

    echo "</tr>";
    }
echo "</tbody>";
echo "</table>";

include "footer.php";

