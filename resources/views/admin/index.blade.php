@extends('layouts.dashboard')

@section('content')

<div className="py-12">
    <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 text-gray-900">
                <a href="/admin/products">
                    Products
                </a>
            </div>
        </div>

        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 text-gray-900">
                <a href="{{ route('categories.index') }}">
                    Categories
                </a>
            </div>
        </div>

        <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 text-gray-900">
                <a href="{{ route('attributes.index') }}">
                    Attributes
                </a>
            </div>
        </div>
    </div>
</div>

@endsection