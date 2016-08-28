@section('menu')
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('stock') }}"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Stock</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('employees') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees</a></li>
                    <li><a href="{{ url('jobs') }}"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Jobs</a></li>
                    <li><a href="{{ url('job-types') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Job Types</a></li>
                    <li><a href="{{ url('stock-items') }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Stock Items</a></li>
                    <li><a href="{{ url('stock-types') }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Stock Type</a></li>
                    <li><a href="{{ url('stock-usage') }}"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Stock Usage</a></li>
                </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
@endsection