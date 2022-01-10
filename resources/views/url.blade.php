<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Url Shortener</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

</head>
<body>
<form id="shortener" action="{{route('createUrl')}}" method="post">
    {{csrf_field()}}
    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h1>Url Shortener</h1>
            </div>
            <div class="col-6 ">
                <div class="form-control">
                    <label for="url" class="">Enter Url To Short:</label>
                    <input type="text" name="url" class="form-control"/>
                </div>
            </div>
            <div class="col-6"></div>
            <div class="col-6 result"></div>
            <div class="col-6"></div>
            <div class="col-6">
                <button type="submit" class="btn btn-success">Shorten</button>
            </div>

        </div>
    </div>
</form>
<script>
    $('#shortener').submit(function(e){
       e.preventDefault();

       $.ajax({
          url    : $(this).prop('action'),
          method : 'POST',
          data   : $(this).serializeArray().reduce((a,e) => {
              a[e.name]=e.value;
              return a;
          },{}),
          success: function(res){

              $('.result').html(
                  '<span class="text-success">Your url : <span class="text-primary">'+
                  res.short_url+
                  '</span></span>'
              );
          },
          error: function(err){
              $('.result').html(
                  '<span class="text-danger">Your url : <span class="text-error">'+
                  err.responseJSON.message+
                  '</span></span>'
              );
              console.log();
          }
       });
    });
</script>
</body>
</html>
