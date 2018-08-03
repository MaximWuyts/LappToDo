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
            <div class="row">
                    
                    @if(!Auth::check())
                    <h1 style="font-family: 'Raleway'; text-align:center; margin-top: 100px; color:#636b6f">U moet ingelogd zijn om taken te kunnen zien!</h1>
                    <div class="col-md-2 col-md-offset-5" style="margin-top:20px;">
                    <a href="{{ route('login')}}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register')}}" class="btn btn-primary">Registreer</a>
                    </div>
                    @endif
                </div>
            @if(Auth::check())
            <div class="col-md-offset-2 col-md-8">
            <div class="row">
                    <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <p class="pull-right" style="margin-top:20px; margin-right:20px;">Ingelogd als <b>{{Auth::user()->name}} </b><button type="submit" class="btn btn-warning">Uitloggen</button></p>
                    </form>
                    <h1 style="margin-left:15px; margin-top:20px; color:#636b6f; font-family: 'Raleway';">Todo Lijst</h1>
                   
            </div>

            <!-- SUCCES message Tonen -->
            @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{Session::get('success')}}</strong>
            </div>
            @endif
            <!-- errors tonen -->
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
            
            <div class="row" style="margin-top:25px;">
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
            <table class="table" style="margin-top:10px;">
                <thead>
                    <th>Taak #</th>
                    <th>Beschrijving</th>
                    <th>Deadline</th>
                    <th>Voltooien</th>
                    <th>Bewerken</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($createdTasks as $createdTask)
                    <tr>
                        @if($createdTask->done === 0)
                        <th>{{ $createdTask->id }}</th>
                        <td>{{ $createdTask->name }}</td>
                        <td>{{ $createdTask->deadline }}</td>
                       
                        <td>
                            <form action="{{ url('tasks/taskDone/' . $createdTask->id) }}" method="POST">
                                <input type="submit" class="btn btn-success" value="Done">
                                @csrf
                            </form>
                        </td>
                        <td><a href="{{ route('tasks.edit',['tasks'=>$createdTask->id])}}" class="btn btn-primary">Bewerk</td>
                        
                            <td>
                            <form action="{{ route('tasks.destroy',['tasks'=>$createdTask->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">

                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                        @endif
                    </tr>
                       
                    @endforeach 
                </tbody>
            </table>
            @endif

            <h3 style="margin-left:15px; margin-top:30px; color:#636b6f; font-family: 'Raleway';">Voltooide Taken</h3>
            @if(count($createdTasks) > 0)
            <table class="table" style="margin-top:10px;">
                <thead>
                    <th>Taak #</th>
                    <th>Beschrijving</th>
                    <th>Deadline</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($createdTasks as $createdTask)
                    <tr>
                        @if($createdTask->done === 1)
                        <th>{{ $createdTask->id }}</th>
                        <td>{{ $createdTask->name }}</td>
                        <td>{{ $createdTask->deadline }}</td>
                        <td>
                            <form action="{{ route('tasks.destroy',['tasks'=>$createdTask->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </td>
                        @endif
                    </tr>
                       
                    @endforeach 
                </tbody>
            </table>
            @endif
            @endif
        </div>
    </div>    
</body>
</html>