@extends('admin.layout')

@section('title', 'Nouvelle formation')
@section('page-title', 'Nouvelle formation')

@section('content')
    <div class="max-w-4xl">
        <div class="mb-6">
            <a href="{{ route('admin.formations.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>Retour aux formations
            </a>
        </div>

        <form action="{{ route('admin.formations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Basic Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Informations generales</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Sous-titre</label>
                        <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">
                    </div>

                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau *</label>
                        <select name="level" id="level" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">
                            <option value="1" {{ old('level') == 1 ? 'selected' : '' }}>Niveau 1 - Debutant</option>
                            <option value="2" {{ old('level') == 2 ? 'selected' : '' }}>Niveau 2 - Intermediaire</option>
                            <option value="3" {{ old('level') == 3 ? 'selected' : '' }}>Niveau 3 - Expert</option>
                        </select>
                    </div>

                    <div>
                        <label for="page_count" class="block text-sm font-medium text-gray-700 mb-1">Nombre de pages</label>
                        <input type="number" name="page_count" id="page_count" value="{{ old('page_count') }}" min="0"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">
                    </div>

                    <div class="md:col-span-2">
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Description courte</label>
                        <textarea name="short_description" id="short_description" rows="2"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description complete *</label>
                        <textarea name="description" id="description" rows="6" required
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Tarification</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Prix (EUR) *</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01" min="0" required
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">Prix promo (EUR)</label>
                        <input type="number" name="sale_price" id="sale_price" value="{{ old('sale_price') }}" step="0.01" min="0"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Ordre d'affichage</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">
                    </div>
                </div>
            </div>

            <!-- Files -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Fichiers</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-1">Image de couverture</label>
                        <input type="file" name="cover_image" id="cover_image" accept="image/*"
                               class="w-full border border-gray-300 rounded-lg p-2">
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG. Max 2 Mo.</p>
                    </div>

                    <div>
                        <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">Fichier PDF</label>
                        <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                               class="w-full border border-gray-300 rounded-lg p-2">
                        <p class="mt-1 text-xs text-gray-500">PDF uniquement. Max 50 Mo.</p>
                    </div>
                </div>
            </div>

            <!-- Options -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Options</h3>

                <div class="space-y-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-accent focus:ring-accent">
                        <span class="ml-2 text-sm text-gray-700">Formation active (visible sur le site)</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-accent focus:ring-accent">
                        <span class="ml-2 text-sm text-gray-700">Mise en avant sur la page d'accueil</span>
                    </label>
                </div>
            </div>

            <!-- SEO -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">SEO</h3>

                <div class="space-y-4">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta title</label>
                        <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" maxlength="255"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta description</label>
                        <textarea name="meta_description" id="meta_description" rows="2" maxlength="500"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-accent focus:border-accent">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.formations.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-accent text-white rounded-lg hover:bg-accent/90 transition">
                    <i class="fas fa-save mr-2"></i>Creer la formation
                </button>
            </div>
        </form>
    </div>
@endsection
