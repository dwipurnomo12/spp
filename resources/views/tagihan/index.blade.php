@extends('layouts.main')

@section('content')
    tagihan {{ auth()->user()->siswa->nm_siswa }}
@endsection
