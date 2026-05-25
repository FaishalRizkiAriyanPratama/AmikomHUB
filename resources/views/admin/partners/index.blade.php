@extends('layouts.admin')

@section('title', 'Partner - Admin')
@section('page_title', 'Kelola Partner')
@section('page_subtitle', 'Daftar seluruh partner.')

@section('content')

<div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h2 class="text-2xl font-black text-slate-800">
                Data Partner
            </h2>

            <p class="text-slate-500 mt-1">
                Kelola seluruh partner yang terdaftar
            </p>
        </div>

        <a href="{{ route('admin.partners.create') }}"
           class="px-6 py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">
            + Tambah Partner
        </a>

    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-700 font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <form method="GET" action="{{ route('admin.partners.index') }}" class="mb-6">
        <div class="flex gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari partner..."
                class="flex-1 px-5 py-4 rounded-2xl border border-slate-200"
            >

            <button class="px-6 py-4 bg-slate-800 text-white rounded-2xl font-bold">
                Cari
            </button>
        </div>
    </form>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>
                <tr class="border-b border-slate-100">
                    <th class="text-left py-4 px-4">Logo</th>
                    <th class="text-left py-4 px-4">Nama Partner</th>
                    <th class="text-left py-4 px-4">Tanggal</th>
                    <th class="text-left py-4 px-4">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($partners as $partner)
                <tr class="border-b border-slate-100">

                    <td class="py-4 px-4">
                        <img src="{{ $partner->logo_url }}"
                             class="w-16 h-16 rounded-2xl object-cover">
                    </td>

                    <td class="py-4 px-4 font-bold">
                        {{ $partner->name }}
                    </td>

                    <td class="py-4 px-4">
                        {{ $partner->created_at->format('d M Y') }}
                    </td>

                    <td class="py-4 px-4 flex gap-2">

                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                           class="px-4 py-2 bg-yellow-500 text-white rounded-xl">
                            Edit
                        </a>

                        <form action="{{ route('admin.partners.destroy', $partner->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus partner ini?')"
                                    class="px-4 py-2 bg-red-600 text-white rounded-xl">
                                Delete
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-10">
                        Belum ada partner
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection