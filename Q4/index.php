<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Input Form</title>
</head>
<body>
    <div>
        <h2>User Information Form</h2>
        
        <?php
        $name = $email = $age = $comments = "";
        $nameErr = $emailErr = $ageErr = "";
        $formSubmitted = false;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $formSubmitted = true;

            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            } else {
                $name = test_input($_POST["name"]);
            }
            
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }
            
            if (empty($_POST["age"])) {
                $ageErr = "Age is required";
            } else {
                $age = test_input($_POST["age"]);
                if (!is_numeric($age)) {
                    $ageErr = "Age must be a number";
                }
            }
            
            $comments = test_input($_POST["comments"] ?? "");
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>

        <?php if (!$formSubmitted || $nameErr || $emailErr || $ageErr): ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
                    <span style="color: red;"><?php echo $nameErr; ?></span>
                </div>
                <br>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                    <span style="color: red;"><?php echo $emailErr; ?></span>
                </div>
                <br>
                <div>
                    <label for="age">Age:</label>
                    <input type="text" id="age" name="age" value="<?php echo $age; ?>">
                    <span style="color: red;"><?php echo $ageErr; ?></span>
                </div>
                <br>
                <div>
                    <label for="comments">Comments:</label>
                    <textarea id="comments" name="comments" rows="4"><?php echo $comments; ?></textarea>
                </div>
                <br>
                <div>
                    <input type="submit" value="Submit">
                </div>
            </form>
        <?php else: ?>
            <div>
                <h3>Form Submitted Successfully</h3>
                <p><strong>Name:</strong> <?php echo $name; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Age:</strong> <?php echo $age; ?></p>
                <p><strong>Comments:</strong> <?php echo $comments; ?></p>
                
                <p><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">Submit another form</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>