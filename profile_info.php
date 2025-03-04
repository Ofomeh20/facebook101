<!DOCTYPE html>
<html>
  <head>
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width,user-scalable= no">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
    <div class="container py-3">
      <h1 class="text-center">Additional information:</h1>
      <form method="POST" class="row col-9 mx-auto">

        <label class="my-2">Gender:</label>
        <select class="form-control col-9 me-1 input" name="gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label class="my-2">Relationship status:</label>
        <select class="form-control col-9 input" name="rel-status">
          <option>Single</option>
          <option>Taken</option>
          <option>Married</option>
          <option>Others</option>
        </select>
        
        <label class="my-1">Location:</label>
        <input type="text" class="form-control col-9 input" name="location">
        
        <button type="submit" class="btn btn-primary my-4">Submit</button>
      </form>
    </div>
  </body>
</html>