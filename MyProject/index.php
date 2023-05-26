
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu of the Coolest Restaurant Ever by MG</title>

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/bootstrap-grid.css">

</head>
<body>
<!-- . -> class ; # -> id -->

    <header id="myheader">

        <div id="headers">
            <img src="photos/mylogo/mylogo.png" alt="Logo of C.R.E. by MG" id="mylogo" >
        </div>
        <div>
            <a href="">Home</a>
            <a href="index.html">To eat</a>
            <a href="php/myaccount.php">Account</a>
        </div>

    </header>


    <main id="mymain">

        <section class="mymenu">
            <h2 class="h2-menu">Starters</h2>
                <img src="photos/starter.jpg" alt="Starters pic" class="pic"> 
                    <table>
                        <tr>
                            <th class="h4">The Shell</th>
                            <th class="portion">1 p. </th>
                            <th class="price">- € 10</th>
                        </tr>
                        <tr>
                            <td class="descriptionmeal">One empty shell, with salad.</td>
                        </tr>
                        <tr>
                            <th class="h4">The filled Shell</th>
                            <th class="portion">1 p. </th>
                            <th class="price">- € 13</th>
                        </tr>
                        <tr>
                            <td class="descriptionmeal">One filled shell, with olive oil</td>
                        </tr>
                    </table>
                              
            <?php
            $conn = mysqli_connect("localhost", "username", "password", "database");
            
            // Check if the connection was successful
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            $sql = "SELECT `titel` FROM category WHERE id = 1";
            $result = mysqli_query($conn, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $category = $row['titel'];
            
                $sql = "SELECT * FROM product WHERE cat_id = 1";
                $result = mysqli_query($conn, $sql);
            
                if (mysqli_num_rows($result) > 0) {
                    echo "<h2 class='h2-menu'>$category</h2>";
                    echo "<img src='photos/starter.jpg' alt='Starters pic' class='pic'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th class='h4'>Name</th>";
                    echo "<th class='portion'>Portion</th>";
                    echo "<th class='price'>Price</th>";
                    echo "</tr>";
            
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='h4'>" . $row['name'] . "</td>";
                        echo "<td class='portion'>" . $row['portion'] . "</td>";
                        echo "<td class='price'>- € " . $row['price'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class='descriptionmeal'>" . $row['description'] . "</td>";
                        echo "</tr>";
                    }
            
                    echo "</table>";
                } else {
                    echo "<p>No products found in the $category category.</p>";
                }
            } else {
                echo "<p>Category not found.</p>";
            }
            
            // Close the database connection
            mysqli_close($conn);
            ?>
            
      

            <h2 class="h2-menu">Main</h2>
                <img src="photos/main.jpg" alt="Main pic" class="pic"> 
           
                    <table>
                        <tr>
                            <th class="h4">The Coolest Salad Mix</th>
                            <th class="portion">1 p. </th>
                            <th class="price">- € 15</th>
                        </tr>
                        <tr>
                            <td class="descriptionmeal">Mixed veggies salad bowl.</td>
                        </tr>
                        <tr>
                            <th class="h4">The Coolest Meat Mix</th>
                            <th class="portion">1 p. </th>
                            <th class="price">- € 18</th>
                        </tr>
                        <tr>
                            <td class="descriptionmeal">Mixed meat, veggies & fries.</td>
                        </tr>
                    </table>

            <h2 class="h2-menu">Deserts</h2>
                <img src="photos/dessert.jpg" alt="Desserts pic" class="pic"> 

                        <table>
                            <tr>
                                <th class="h4">The Apperry Sorbet</th>
                                <th class="portion">1 p. </th>
                                <th class="price">- € 8</th>
                            </tr>
                            <tr>
                                <td class="descriptionmeal">Apple & Berries mixed sorbet.</td>
                            </tr>
                            <tr>
                                <th class="h4">The Lava bomb</th>
                                <th class="portion">1 p. </th>
                                <th class="price">- € 8</th>
                            </tr>
                            <tr>
                                <td class="descriptionmeal">Choco explosion with fresh fruits.</td>
                            </tr>
                        </table>

            <h2 class="h2-menu">Drinks</h2>
                <img src="photos/cocktail.jpg" alt="Cocktails pic" class="pic"> 
    
                        <table>
                            <tr>
                                <th class="h4">Lemonish</th>
                                <th class="portion">50 cl </th>
                                <th class="price">- € 5</th>
                            </tr>
                            <tr>
                                <td class="descriptionmeal">Refreshing water with lemon and herbs.</td>
                            </tr>
                            <tr>
                                <th class="h4">Heaven</th>
                                <th class="portion">35 cl </th>
                                <th class="price">- € 8</th>
                            </tr>
                            <tr>
                                <td class="descriptionmeal">Herbal summery cocktail with lemon and vodka.</td>
                            </tr>
                        </table>
        </section>
    </main>


    <footer class="myfooter">

        <div id="footer-div">
            <a href="#">Impressum</a>
            <a href="#">About us</a>
            <a href="#">Contact</a>   
        </div>

        <p> &copy; the Coolest Restaurant Ever by Marie G. - All rights reserved. </p>

    </footer>

    <script src="JS/vendor/jquery-3.6.4.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" 
crossorigin="anonymous"></script>
    <script src="JS/main.js"></script>
    <script src="JS/product.js"></script>
    <script src="JS/index.js"></script>


    <script src="JS/vendor/bootstrap.bundle.js"></script>
</body>
</html>