<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="/img/bidprologo.png" type="image/x-icon">
    <title>BidPro</title>
    <style>
        .wew:hover{
            cursor:pointer;
        }
        .img{
            height:150px;
            width:200px;
            -o-object-fit:contain;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/seeker/seeker.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    @include('inc.seekerNav')
    @yield('content')
    
</body>
<script>
     @if(count($errors))
            $('#myModal').modal('show');
            $('#myModal').data('bs.modal').handleUpdate();
     @endif
    </script>
    <script>
    @if(count($errors))
        $('#profileImage').modal('show');
        $('#profileImage').data('bs.modal').handleUpdate();
    @endif
    </script>
    <script>
        var maxChar = 255;
        $('#charLeft').text(maxChar + ' characters left');
        $('#details').keyup(function(){
            var textLength = $(this).val().length;
            if(textLength >= maxChar){
                $('#charLeft').text('You have reached the limit of ' + maxChar + ' characters');
            } else {
                var count = maxChar - textLength;
                $('#charLeft').text(count + ' characters left');
            }
        });
    </script>
    <script>
        $('#cost').change(function(){
            this.value = parseFloat(this.value).toFixed(2);
        });
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
   <script>
        $('#newDP').on('click', function(){
            $('#previewImage').attr('src', $('#imageSrc').attr('src'));
            $('#profileImage').modal('show');
        });
   </script>
   <script>
    $(document).ready(function(){
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show');
    });
   </script>
   <script>
    $(function(){
        var addDiv = $('#addInput');
        var i = $('#addInput p').length + 1;

        $('#addNew').on('click', function(){
            $('<p><input type="text" id="pNew" name="pNew[]" placeholder="New skill" class="form-control form-control-line"/><a href="#" id="remNew">Remove</a> </p>').appendTo(addDiv);
            i++;
            return false;
        });

        $('#addInput').on('click','#remNew', function(){
            if( i > 2){
                $(this).parents('p').remove();
                i--;
            }
            return false;
        });
    });

  
   </script>
   <script>
        var loadImage = function(event){
            var image = document.getElementById('previewImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
   </script>
</html>