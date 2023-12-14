@extends('layouts.app')

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="form-group">
            <h4>Type by Username</h4>
            <input type="search" name="search" id="search" placeholder="Search the user..." class="form-control">
        </div>

        <div id="search-list"></div>

    </div>

    <script defer>
        $(document).ready(function() {
            
            $('#search').on('keyup', function(){
                var query = $(this).val();

                $.ajax({
                    url: "find",
                    type: "GET",
                    data: {'search' : query},
                    
                    success: function(data){
                        $('#search-list').html(data);
                    }
                })
            });
        });
    </script>
    
</body>

@endsection
