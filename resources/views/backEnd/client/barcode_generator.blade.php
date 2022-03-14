<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Barcode Generator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row">
      <h1 class="text-center">Barcode Generator</h1>
      <div class="col-md-6 m-auto">
        <form action="{{ url('barcode_generate') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="">Store Code</label>
            <input type="text" name="store_code" id="store_code" class="form-control">
          </div>
          <input type="submit" value="Generate" class="btn btn-primary">

        </form>
      </div>
    </div>
  </div>
</body>

</html>
