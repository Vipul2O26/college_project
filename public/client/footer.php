<!DOCTYPE html>
<html lang="en">
<style>
       
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; 
        }
        .content {
            flex: 1; 
        }
        footer {
            background-color: #343a40; 
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: auto; 
        }
        footer h3 {
            margin: 0;
        }
    </style>
   

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
</head>

<body>

<footer class="bg-dark text-center text-lg-start mt-auto py-3">
        <div class="container">
            <div class="text-center text-light">
                &copy; <h3><?php echo date("Y"); ?> Your Company Name. All Rights Reserved.</h3> 
            </div>
        </div>
    </footer>

</body>

</html>