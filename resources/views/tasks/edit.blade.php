<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
     integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- bootstrap js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>

    <title>Todo List Application</title>
</head>
<body>
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="row">
                <h1 style="margin-left:15px;">Todo List</h1>
            </div>

            <!-- SUCCES display -->
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <strong>{{Session::get('success')}}</strong>
                </div>
            @endif

            <!-- error handling -->
            @if (count($errors) > 0)
                <div class="alert alert-warning">
                    <strong>Error:</strong>
                    <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error}}</li>
                    @endforeach    
                    </ul>
                </div>
            @endif   

            <!-- edit task form -->
            <div class="row">
                <form action="{{route('tasks.update',[$currentTaskEdit->id])}}" method="POST">
                    <input type="hidden" name="_method" value="PUT"> <!--change to put (html != PUT) -->
                    <div class="form-group col-md-7">
                        <input type="text" name="editedTaskName" class="form-control" value="{{ $currentTaskEdit->name}}">
                    </div>
                    <div class="form-group col-md-3">
                        <input type="date" name="editedTaskDate" class="form-control" value="{{ $currentTaskEdit->deadline}}">
                    </div>
                        <input type="submit" value="Save" class="btn btn-success">
                        <a href="{{route('tasks.index')}}" class="btn btn-primary " style="margin-left:15px; margin-top:20px;">Go back to home!</a>
                    @csrf                   
                </form>
            </div>
           
        </div>
    </div>    
</body>
</html>