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

    <title>Todo Lijst Applicatie</title>
</head>
<body>
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <div class="row">
                <h1>Todo Lijst</h1>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error}}</li>
                        @endforeach    
                    </ul>
                </div>
            @endif    

            <div class="row">
            <form action="{{route('tasks.store')}}" method="POST">
                {{ csrf_field() }}

                    <div class="col-md-7">
                        <input type="text" name="newTaskName" class="form-control">
                    </div>
                    <div class="col-md-3">
                            <input type="date" name="newDeadline" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success btn-clock" value="Add Task">
                    </div>
                </form>
            </div>
            @if(count($createdTasks) > 0)
            <table class="table">
                <thead>
                    <th>Taak #</th>
                    <th>beschrijving</th>
                    <th>deadline</th>
                    <th>Bewerken</th>
                    <th>Delete</th>
                </thead>

                <tbody>
                    @foreach($createdTasks as $createdTask)
                        <th>{{ $createdTask->id }}</th>
                        <th>{{ $createdTask->name }}</th>
                        <th>{{ $createdTask->deadline }}</th>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>    
</body>
</html>