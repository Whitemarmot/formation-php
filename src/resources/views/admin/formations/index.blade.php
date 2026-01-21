@extends('admin.layout')

@section('title', 'Formations')
@section('page-title', 'Gestion des formations')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-gray-600">{{ $formations->count() }} formation(s)</p>
        <a href="{{ route('admin.formations.create') }}"
           class="bg-accent hover:bg-accent/90 text-white px-4 py-2 rounded-lg transition">
            <i class="fas fa-plus mr-2"></i>Nouvelle formation
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Formation</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Niveau</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ventes</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($formations as $formation)
                    <tr class="hover:bg-gray-50 {{ $formation->trashed() ? 'bg-red-50' : '' }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($formation->cover_image)
                                    <img src="{{ Storage::url($formation->cover_image) }}"
                                         alt="{{ $formation->name }}"
                                         class="w-12 h-12 rounded object-cover mr-4">
                                @else
                                    <div class="w-12 h-12 rounded bg-gray-200 flex items-center justify-center mr-4">
                                        <i class="fas fa-book text-gray-400"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $formation->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $formation->page_count ?? '?' }} pages</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $formation->level == 1 ? 'bg-green-100 text-green-800' : '' }}
                                {{ $formation->level == 2 ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $formation->level == 3 ? 'bg-purple-100 text-purple-800' : '' }}">
                                Niveau {{ $formation->level }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if($formation->sale_price)
                                <span class="text-gray-400 line-through text-sm">{{ $formation->price }} &euro;</span>
                                <span class="text-accent font-bold">{{ $formation->sale_price }} &euro;</span>
                            @else
                                <span class="font-medium">{{ $formation->price }} &euro;</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-medium">{{ $formation->sales_count ?? 0 }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @if($formation->trashed())
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Supprimee</span>
                            @elseif($formation->is_active)
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                @if($formation->trashed())
                                    <form action="{{ route('admin.formations.restore', $formation->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800" title="Restaurer">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.formations.show', $formation) }}"
                                       class="text-gray-600 hover:text-gray-800" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.formations.edit', $formation) }}"
                                       class="text-blue-600 hover:text-blue-800" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.formations.toggle-active', $formation) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="{{ $formation->is_active ? 'text-yellow-600 hover:text-yellow-800' : 'text-green-600 hover:text-green-800' }}"
                                                title="{{ $formation->is_active ? 'Desactiver' : 'Activer' }}">
                                            <i class="fas {{ $formation->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.formations.destroy', $formation) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Supprimer cette formation ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Aucune formation. <a href="{{ route('admin.formations.create') }}" class="text-accent">Creer la premiere</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
