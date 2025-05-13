<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Live Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">

        <div class="text-center mt-5 b-4">
            <h2>PHP MySQL Live Search</h2>
        </div>

        <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Search... ">
    </div>

    <div id="search_result"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $("#live_search").keyup(function(){

                var input = $(this).val();
                // alert(input);
                if(input != ""){
                    $.ajax({

                        url:"livesearch.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data){
                            $("#search_result").html(data);
                        }
                    });
                } else {

                    $("#search_result").css("display","none")
                }
            });
        });
    </script>
</body>
</html>