<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta token="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite with ajax love</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
    <div class="container">
        @yield('container')
    </div>

    <script src="{{ asset('js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('js/jquery.livequery.js') }}"></script>
	
    <script>
    
        $('.not-favorited').livequery(function(){
            
            
            $(this).click(function(e) {

            e.preventDefault();    
            var postID   =  $(this).data('id');
            var token = "{{ csrf_token() }}";
            var d = {postid: postID, _token: token};
                        
            $.post('{{ url('favorites') }}', d,

            function(response){

                //console.log(response);
                
                $('#like-stat-'+postID).html(response);
                
                $('#like-panel-'+postID).html('<a href="#" data-id="'+postID+'" class="favorited"><i class="fa fa-heart"></i></a>');

            });
        });
        }); 


        $('.favorited').livequery(function(){
            
            
            $(this).click(function(e) {

            e.preventDefault();    
            var postID   =  $(this).data('id');
            var token = "{{ csrf_token() }}";
            var d = {postid: postID, _token: token};
                        
            $.post('{{ url('favorites-delete') }}', d,

            function(response){

                //console.log(response);
                
                $('#like-stat-'+postID).html(response);
                
                $('#like-panel-'+postID).html('<a href="#" data-id="'+postID+'" class="not-favorited"><i class="fa fa-heart"></i></a>');

            });
        });
        }); 

	    
    </script>

</body>
</html>