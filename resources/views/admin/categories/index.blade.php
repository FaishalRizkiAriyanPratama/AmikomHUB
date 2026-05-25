@extends('layouts.admin')

@section('title', 'Category - Admin')
@section('page_title', 'Kelola Category')
@section('page_subtitle', 'Daftar seluruh kategori event.')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-black text-slate-800">
                Data Category
            </h2>

            <p class="text-slate-500 mt-1">
                Kelola seluruh kategori event
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
            + Tambah Category
        </a>
    </div>

    <div class="mb-6">
        <form method="GET" action="{{ route('admin.categories.index') }}">
            <div class="flex gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kategori..."
                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >

                <button
                    type="submit"
                    class="px-6 py-4 bg-slate-800 text-white rounded-2xl font-bold hover:bg-slate-900 transition">
                    Cari
                </button>

            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-6 px-5 py-4 bg-green-100 border border-green-300 text-green-700 rounded-2xl">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">

            <thead>
                <tr class="border-b border-slate-100">
                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">ID</th>
                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">Nama Category</th>
                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">Slug</th>
                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">Created At</th>
                    <th class="text-left py-4 px-4 text-sm font-bold uppercase tracking-wide text-slate-500">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="py-5 px-4 text-slate-600 font-medium">
                            #{{ $category->id }}
                        </td>

                        <td class="py-5 px-4">
                            <h5 class="font-bold text-slate-800">
                                {{ $category->name }}
                            </h5>
                        </td>

                        <td class="py-5 px-4 text-slate-500">
                            {{ $category->slug }}
                        </td>

                        <td class="py-5 px-4 text-slate-600 font-medium">
                            {{ $category->created_at->format('d M Y') }}
                        </td>

                        <td class="py-5 px-4 flex gap-3">

                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 font-bold hover:bg-yellow-200 transition">
                                Edit
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus category ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-4 py-2 rounded-xl bg-red-100 text-red-700 font-bold hover:bg-red-200 transition">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="text-center py-20">
                            <h4 class="text-xl font-bold text-slate-700">
                                Belum Ada Category
                            </h4>

                            <p class="text-slate-500 mt-2">
                                Tambahkan kategori pertama Anda
                            </p>
                        </td>
                    </tr>

                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection