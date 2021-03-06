<?php
    include "includes/header.php";

    $errors = [];
    if (isset($_POST["submit"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        $gender = $_POST["gender"];    
        $hobby = $_POST["hobby"];
        $major = $_POST["major"];


        if ($name == "") {
            $errors["name"] = "Name cannot be empty!";
        }

        if ($age < 15 || $age > 40) {
            $errors["age"] = "Age must be between 15 and 40!";
        }

        if ($gender != "male" && $gender != "female") {
            $errors["gender"] = "Gender out of bounds!";
        }

        if ($hobby == "") {
            $errors["hobby"] = "Hobby cannot be empty!";
        }

        if ($major == "") {
            $errors["major"] = "Major cannot be empty!";
        }



        if(empty($errors)) {
            $sql = "INSERT INTO classmates (name, age, gender, major, hobby) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sisss", $name, $age, $gender, $major, $hobby);
            $stmt->execute();
            if ($stmt->affected_rows == 1) {
                $location = "Location: classmate.php?id=" . $stmt->insert_id . "&new=true";
                header($location);
            }
        }

    }
?>

    <div class="container">

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger" role="alert">
                <pre><?php print_r($errors); ?></pre>
            </div>
        <?php endif; ?>
        <h4 class="display-4" >Add Classmate</h4>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="create.php" method="post">

                    <label for="name"> <i class="fa fa-user"></i> Classmate Name</label>
                    <input type="text" name="name" class="form-control" value="">

                    <label for="age">Classmate Age</label>
                    <input type="number" name="age" class="form-control" value="">

                    <label for="name">Major</label>
                    <select name="major" class="form-control">
                        <option value="business">Business</option>
                        <option value="computer-science">Computer Science</option>
                        <option value="chemitry">Chemistry</option>
                        <option value="design">Graphic Design</option>
                    </select>

                    <label for="hobby">Classmate Hobby</label>
                    <input type="text" name="hobby" class="form-control" value="">

                    <label for="gender">Gender</label> <br>
                    <input type="radio" name="gender" value="male" checked> Male <br>
                    <input type="radio" name="gender" value="female"> FeMale <br>

                    <button type="submit" name="submit" class="mt-2 mb-5 btn btn-lg btn-block btn-primary">Add ClassMate</button>
                </form>
            </div>  
    
        </div>

    </div>

<?php 
    include "includes/footer.php";
?>