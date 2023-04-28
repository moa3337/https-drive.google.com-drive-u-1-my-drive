<x-mail::message>
# {{ $published_text }}
## {{ $project->title }}
 
{{ $project->getAbstract(100) }}

@if ($project->published)
    <x-mail::button :url="'http://localhost:5174/projects/' . $project->slug">
        <!--env('APP_FRONTEND_URL') . '/projects/' . $project->slug-->    
        View project
    </x-mail::button>
@endif
 
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

<!--
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-color: grey;
        }
    </style>
</head>
<body>
    <h1>{{ $published_text }}</h1>
    <h2>{{ $project->title }}</h2>  
</body>
</html>
-->
