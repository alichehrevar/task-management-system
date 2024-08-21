<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.meta')
    @include('layouts.partials.styles')
</head>
<body>
<div class="container">
    <h1>Task Management</h1>
    @include('layouts.flashMessages')
    @yield('content')
</div>
@include('layouts.partials.scripts')
</body>
</html>
