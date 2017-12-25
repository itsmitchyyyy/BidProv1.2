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
    @if($errors->has('avatar'))
        $('#profileImage').modal('show');
        $('#profileImage').data('bs.modal').handleUpdate();
    @endif
    $('#profileImage').on('hidden.bs.modal', function(){
        $(this).removeData();
        $('#uploadBtn').attr('disabled','disabled');
    });
    </script>
    <script>
        $(document).ready(function(){
            $('#updatePassword').attr('disabled',true);
            $('form :input').not('#updatePassword').bind('keyup', function(){
                if($(this).val().length != 0){
                    $('#updatePassword').attr('disabled', false);
                }else{
                    $('#updatePassword').attr('disabled', true);
                }
            });
        })
    </script>
    <script>
        $('form').each(function(){
            $(this).data('serialized', $(this).serialize())
        }).on('change input', function(){
            $(this).find('#updateProfile').prop('disabled', $(this).serialize() == $(this).data('serialized'));
        }).find('#updateProfile').prop('disabled',true);
    </script>
    <!--<script>
        var button = $('#updateProfile');
        button.attr('disabled',true);
        $('form :input').not(button).bind('keyup change', function(){
            var changed = $('form :input').not(button).filter(function(){
                if(this.type == 'radio' || this.type == 'checkbox'){
                    return this.checked != $(this).data('default');
                }else{
                    return this.value != $(this).data('default');
                }
            });
            $('#updateProfile').prop('disabled', !changed.length);
        });
    </script>-->
    <!--<script>
        $(document).ready(function(){
            $('#updateProfile').attr('disabled',true);
            $('form :input').not('#updateProfile').bind('keyup change',function(){
                $('#updateProfile').attr('disabled',false);
            });
        });
    </script>-->
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
   <script>
   $('#myUpload').change(function(){
        if($(this).val()){
            $('#uploadBtn').attr('disabled',false);
        }else{
            $('#uploadBtn').attr('disabled', 'disabled');
        }
   });
   </script>
</html>