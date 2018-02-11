@extends('layouts.seekerapp')
@push('css')
    <style>
        #board {
            display: table;
            margin: 0;
            padding: 0;
            border-spacing: 5px;
        }
        .section {
            display: table-cell;
            margin: 0;
            border: 1px solid #666;
            padding: 5px;
            width: 500px;
        }
        .section.droppable {
            border: 1px dashed #666;
        }
        .section > h1 {
            margin: 0;
            border-bottom: 1px solid #999;
            padding: 0;
            font-size: 12pt;
            text-align: center;
        }
        .card-kanban {
            display: inline-block;
            vertical-align: top;
            margin: 10px 5px;
            padding: 10px;
            width: 100px;
            height: 100px;
            color: black;
            background: #ff8;
            cursor: move;
            text-align: center;
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            box-shadow: 2px 2px 2px #eee;
        }
        .wrap-word{
            max-width:40em;
            word-wrap:break-word;
        }
        .card-block{
            border:1px solid rgba(0,0,0,.15);
        }
    </style>
@endpush
@section('content')
@inject('modules','App\Http\Controllers\ModuleController')
<div class="container-fluid">
   <h3><b>{{ ucfirst($project->title) }}</b></h3>
    <div class="card-mt-15">
        <div class="card-block">
            <small><b>Project ID: {{ $project->id }}</b></small>
            <small class="pull-right">{{ Carbon\Carbon::parse($proposal->created_at)->diffForHumans() }}</small>
            <p class="card-text">Development Type {{ $project->category }}</p>
            @if($project->category == 'Mobile')
            <p class="card-text">Runs On {{ $project->type }}
            @else
            @if($project->category == 'Web')
           <br>Operating System {{ $project->os }}</p>
            @else
            @if($project->category == 'MobileWeb')
            <p class="card-text">Runs On {{ $project->type }}
            <br>Operating System {{ $project->os }}</p>
            @endif
            @endif
            @endif
           
           
            <h4 class="card-title"><b>Project Description</b></h4>
            <p class="card-text wrap-word">{{ $project->details }}</p>
            
        </div>
    </div>
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-3 col-xs-6 b-r"><strong>Project Name</strong>
                <br><p class="text-muted">{{ ucfirst($project->title) }}</p>
                </div>
                <div class="col-md-3 col-xs-6 b-r"><strong>Developer</strong>
                <br><p class="text-muted">{{ $proposal->firstname }} {{ $proposal->lastname }}</p>
                </div>
                <div class="col-md-3 col-xs-6 b-r"><strong>Bid</strong>
                <br><p class="text-muted"><span>&#8369;</span> {{ $proposal->price }} in {{ $proposal->daysTodo }} days</p>
                </div>
            </div>
        </div>
    </div>
    <h2 class="m-t-15">PROJECT PROGRESS</h2>
    <div id="board">
        <div id="todo" class="section">
            <h1>To Do</h1>
            @foreach($todo as $todos)
            <div id="c2" onclick="toggleModal(this,{{ $todos->module_id }})" data-name="{{ $todos->module_name }}" class="card-kanban">{{ $todos->module_name }}</div>
            <!-- <div id="c3" class="card"><em>Retire!</em></div> -->
            @endforeach
        </div>
        <div id="doing" class="section">
            <h1>Doing</h1>
            @foreach($doing as $doings)
            <div id="c1"  onclick="toggleModal(this,{{ $doings->module_id }})" data-name="{{ $doings->module_name }}" class="card-kanban">{{ $doings->module_name }}</div>
            @endforeach
        </div>
        <div id="done" class="section">
            <h1>Done</h1>
            @foreach($done as $dones)
            <div id="c3"  onclick="toggleModal(this,{{ $dones->module_id }})" data-name="{{ $dones->module_name }}" class="card-kanban">{{ $dones->module_name }}</div>
            @endforeach
        </div>
    </div>
    <div class="modal fade" id="toggleModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
                    <h3>View Module</h3>
                </div>
                <div class="modal-body">
                    <div id="data"></div>
                    <a href="#" id="addComment" class="pull-right">Add comment</a>
                    <div class="form-group" id="commentDiv">
                    <form method="post">
                    <textarea name="progress-comment" id="progress-comment" class="form-control progress-comment" style="height:auto;border:1px solid rgba(0,0,0,.25)" cols="4" rows="4" placeholder="Write a comment"></textarea>
                    <button type="button" class="btn btn-info wew pull-right m-t-10">Add Comment</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(function(){
        $('#commentDiv').hide();
        $('#addComment').click(function(){
            $('#commentDiv').show();
        });
        $('.modal').on('hidden.bs.modal', function(){
            $('.progress-comment').val('');
            $('#commentDiv').hide();
            // console.log('hidden');
        });
    });
</script>
<script>
    function toggleModal(event,id,dataname){
        console.log($(event).data('name'));
        var tableName = $(event).data('name');
        // var myId = id;
        // console.log(name);
        $.ajax({
            type: "get",
            url: "{{ route('viewModule',['module_id']) }}",
            data: {module_id: id},
            dataType: 'json',
            cache:false,
            success: function(response){
                 console.log(response);
                 var myData = `<table class="table table-bordered table-striped" width="100%"><h2>`+tableName+`</h2><tr><th>Done</th><th>Percent Done</th></tr>`;
                 for(var i = 0; i < response.length; i++ ){
                $.each(response[i], function(key,value){
                    if(key == 'description' ){
                    myData += '<tr><td>'+ value +'</td>';
                }
                if(key == 'percentDone' ){
                    myData += `<td>
                        <label class="text-dark">`+value+`% Complete</label>
                    <div class="progress h-100">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-value="12%" aria-valuemin="0" aria-valuemax="100" style="width:`+value+`%">
                        <span>`+value+`% Complete</span>
                        </div>
                    </div>
                    </td></tr>`;
                }
                });
                 }
                 myData += '</table>';
                $('#data').html(myData);
                $('#toggleModal').modal('show');
            }
        });
    }
</script>
<script>
        var cards = document.querySelectorAll('.card');
        for (var i = 0, n = cards.length; i < n; i++) {
            var card = cards[i];
            card.draggable = true;
        };
        var board = document.getElementById('board');
        var hideMe;
        board.onselectstart = function(e) {
            e.preventDefault();
        }
        board.ondragstart = function(e) {
            console.log('dragstart');
            hideMe = e.target;
            e.dataTransfer.setData('card', e.target.id);
            e.dataTransfer.effectAllowed = 'move';
        };
        board.ondragend = function(e) {
            e.target.style.visibility = 'visible';
        };
        var lastEneterd;
        board.ondragenter = function(e) {
            console.log('dragenter');
            if (hideMe) {
                hideMe.style.visibility = 'hidden';
                hideMe = null;
            }
            // Save this to check in dragleave.
            lastEntered = e.target;
            var section = closestWithClass(e.target, 'section');
            // TODO: Check that it's not the original section.
            if (section) {
                section.classList.add('droppable');
                e.preventDefault(); // Not sure if these needs to be here. Maybe for IE?
                return false;
            }
        };
        board.ondragover = function(e) {
            // TODO: Check data type.
            // TODO: Check that it's not the original section.
            if (closestWithClass(e.target, 'section')) {
                e.preventDefault();
            }
        };
        board.ondragleave = function(e) {
            // FF is raising this event on text nodes so only check elements.
            if (e.target.nodeType === 1) {
                // dragleave for outer elements can trigger after dragenter for inner elements
                // so make sure we're really leaving by checking what we just entered.
                // relatedTarget is missing in WebKit: https://bugs.webkit.org/show_bug.cgi?id=66547
                var section = closestWithClass(e.target, 'section');
                if (section && !section.contains(lastEntered)) {
                    section.classList.remove('droppable');
                }
            }
            lastEntered = null; // No need to keep this around.
        };
        board.ondrop = function(e) {
            var section = closestWithClass(e.target, 'section');
            var id = e.dataTransfer.getData('card');
            if (id) {
                var card = document.getElementById(id);
                // Might be a card from another window.
                if (card) {
                    if (section !== card.parentNode) {
                        // section.appendChild(card);
                        console.log(section.id);
                        if(section.id == 'done'){
                          alert(section.id);
                          section.appendChild(card);
                        }
                        if(section.id == 'doing'){
                          alert(section.id);
                          section.appendChild(card);
                        }
                        if(section.id == 'todo'){
                          alert(section.id);
                          section.appendChild(card);
                        }
                    }
                } else {
                    alert('couldn\'t find card #' + id);
                }
            }
            section.classList.remove('droppable');
            e.preventDefault();
        };
        function closestWithClass(target, className) {
            while (target) {
                if (target.nodeType === 1 &&
                    target.classList.contains(className)) {
                    return target;
                }
                target = target.parentNode;
            }
            return null;
        }
    </script>
@endpush