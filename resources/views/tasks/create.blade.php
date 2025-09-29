<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Создать новую задачу
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Контейнер с белым фоном -->
            <div style="max-width: 600px; margin: 0 auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                
                <a href="{{ route('tasks.index') }}" style="display: inline-block; margin-bottom: 20px; color: #3b82f6; text-decoration: none; font-weight: 500;">
                    ← Назад к списку
                </a>

                @if($errors->any())
                    <div style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; padding: 16px; margin: 16px 0; border-radius: 8px;">
                        <strong style="display: block; margin-bottom: 8px;">⚠️ Исправьте ошибки:</strong>
                        <ul style="list-style: disc; margin-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Название задачи:*</label>
                        <input type="text" name="title" value="{{ old('title') }}" 
                               style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px;" 
                               placeholder="Что нужно сделать?" required>
                    </div>
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #374151;">Описание:</label>
                        <textarea name="description" 
                                  style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 16px; height: 120px; resize: vertical;" 
                                  placeholder="Подробное описание (необязательно)">{{ old('description') }}</textarea>
                    </div>
                    
                    <button type="submit" 
                            style="background: #10b981; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.2s;">
                        💾 Сохранить задачу
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>