<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Thread</title>
</head>
<body>
    <div class="thread">
        <h1>Create a New Thread:</h1>
        <form action="process_thread.php" method="POST" class="create_t_form">
            
            <input type="text" class="input1" id="threadTitle" name="threadTitle" placeholder="Thread Title" required>
            
            
            <textarea id="threadContent" name="threadContent" placeholder="Thread content" required rows="10"></textarea> <br>

            <div class="check"> <label for="myCheckbox">Make This Thread General(for all Users)
                <input type="checkbox" id="myCheckbox" name="myCheckbox" value="true">
                </label>
            </div>


            
            
            <button type="submit" class="submit-btn">Submit Thread</button>
        </form>
    </div>
</body>
</html>
