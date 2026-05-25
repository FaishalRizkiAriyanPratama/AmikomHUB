@extends('layouts.admin')

@section('title', 'Tambah Category')
@section('page_title', 'Tambah Category')
@section('page_subtitle', 'Tambahkan kategori baru')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">

    <h2 class="text-2xl font-black text-slate-800 mb-8">
        Tambah Category
    </h2>

    @if ($errors->any())
        <div class="mb-6 px-5 py-4 bg-red-100 border border-red-300 text-red-700 rounded-2xl">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="block text-slate-700 font-bold mb-3">
                Nama Category
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                required
            >
        </div>

        <div class="flex gap-4">
            <button
                type="submit"
                class="px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition">
                Simpan
            </button>

            <a href="{{ route('admin.categories.index') }}"
               class="px-6 py-4 bg-slate-200 text-slate-700 rounded-2xl font-bold">
                Kembali
            </a>
        </div>
    </form>

</div>

@endsection