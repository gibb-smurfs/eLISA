@extends('common.master')

@section('sidebar', 'foo')

@section('content')
        <h1>Hello, <?php echo $name; ?></h1>
@endsection
