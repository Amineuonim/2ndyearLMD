


<!DOCTYPE html>
<html>
<head>
    <title>Main page</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>


    <div id="upperbar">
        <p class="text">Welcome Back !</p>
    </div>

    <div id="menu" class ="hidden">
        
        <button class="menu_icon" id ="openterminal">open terminal</button>
        <button class="menu_icon" id="openlogs">logs</button>
        <a href="signup.html" class="menu_icon">add users</a>
    </div>    

    <div id="terminal">
    <form method="POST" action="">
        <label for="command">Enter command:</label>
        <input type="text" id="command" name="command" required>
        <input type="submit" value="Execute">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $command = $_POST["command"];

            $output = shell_exec($command);

            echo "<pre>$output</pre>";
        }
        ?>
    </div>

    <div id = "logs">
    <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Session (Date)</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = 'localhost';
                $database = 'web';
                $dbUsername = 'omni';
                $dbPassword = 'q';

                try {
                    // Create a new PDO instance for database connection
                    $pdo = new PDO("pgsql:host=$host;dbname=$database", $dbUsername, $dbPassword);

                    // Set PDO error mode to exception
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Prepare and execute SQL query to select all rows from the logs table
                    $stmt = $pdo->query('SELECT * FROM logs');

                    // Check if rows are found
                    if ($stmt->rowCount() > 0) {
                        // Fetch and display each row in the HTML table
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['session'] . '</td>'; // Assuming 'session' is the date column
                            echo '<td>' . $row['username'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="3">No logs found.</td></tr>';
                    }
                } catch (PDOException $e) {
                    // Print any errors encountered during database connection or query execution
                    echo '<tr><td colspan="3">Error: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <button id="menu_button">menu</button>

    <div class = "mainD">
        <div class ="childdiv">
        <?php
        $output = shell_exec('free -m | awk \'NR==2 {total=$2; used=$3; printf "Using %.1fMB out of %.1fMB (%.1f%%)\n", used, total, (used/total)*100}\'');

        echo $output;
        echo"\n";
        ?>

    <div class="childdiv">
    <?php

        // Get CPU info
        $cpu_info = shell_exec('lscpu | grep "Model name"');
        echo "<h2>CPU Info:</h2>";
        echo "<pre>$cpu_info</pre>";

        // Check for GPU info (NVIDIA)
        $nvidia_gpu_info = shell_exec('nvidia-smi 2>&1');
        if (strpos($nvidia_gpu_info, 'command not found') === false) {
            echo "<h2>NVIDIA GPU Info:</h2>";
            echo "<pre>$nvidia_gpu_info</pre>";
        } else {
            echo "<h2>NVIDIA GPU Info:</h2>";
            echo "<p>NVIDIA GPU information not available</p>";
        }

        // Check for GPU info (AMD)
        $amd_gpu_info = shell_exec('rocm-smi 2>&1');
        if (strpos($amd_gpu_info, 'command not found') === false) {
            echo "<h2>AMD GPU Info:</h2>";
            echo "<pre>$amd_gpu_info</pre>";
        } else {
            echo "<h2>AMD GPU Info:</h2>";
            echo "<p>AMD GPU information not available</p>";
        }

        // Get OS info
        $os_info = shell_exec('lsb_release -a');
        echo "<h2>OS Info:</h2>";
        echo "<pre>$os_info</pre>";

        // Get kernel version
        $kernel_version = shell_exec('uname -r');
        echo "<h2>Kernel Version:</h2>";
        echo "<pre>$kernel_version</pre>";
        ?>
    </div>

        </div>
    </div>

    <script>
        
 document.getElementById('menu_button').addEventListener('click', function() {
  var menu = document.getElementById('menu');
  menu.classList.toggle('show'); // Toggle the 'show' class
 
  var terminal = document.getElementById('terminal');
    if (terminal.classList.contains('show')) {
        terminal.classList.remove('show');
    }
    var loggs = document.getElementById('logs');
    if (loggs.classList.contains('show')) {
        loggs.classList.remove('show');
    }

 });


  document.getElementById('openterminal').addEventListener('click', function() {
  var menu = document.getElementById('terminal');
  menu.classList.toggle('show')
});

document.getElementById('openlogs').addEventListener('click', function() {
  var menu = document.getElementById('logs');
  menu.classList.toggle('show')
});

</script>


</body>
</html>
