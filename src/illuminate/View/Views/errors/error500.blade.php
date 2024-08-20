<html>
    <head>
        <title>Server Error | 500</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>  

        <div class="h-100 d-flex row align-items-center justify-content-center">
            <div class="col-12 text-center">

                <h1 class="display-1">Error</h1>
                <h2 class="display-4">500</h2>
                <p>An error occurred while processing your request.</p>
            
            </div>

            @if($debug)
            <div class="col-12 text-bg-danger rounded" style="width: 100rem;">
                <h2 class="display-5">Error Details:</h2>
                <hr>
                <pre class="px-5"> 
                    <strong>Message:</strong> <code>{{$exception->getMessage()}}</code>
                    <strong>File:</strong> <code>{{$exception->getFile()}}</code> <strong>at line</strong> <code>({{$exception->getLine()}})</code>
                    <strong>Code:</strong> <code>{{$exception->getCode()}}</code>
                    <strong>Type:</strong> <code>{{get_class($exception)}}</code>
                    <strong>Trace:</strong> <code>{{$exception->getTraceAsString()}}</code>
                </pre>
            </div>
            @endif
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>