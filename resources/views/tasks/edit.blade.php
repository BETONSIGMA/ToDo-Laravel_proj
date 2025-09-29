<x-app-layout>
    <x-slot name="header">
        <h2>Редактирование</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg">
                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div style="margin-bottom: 15px;">
                        <label>Название задачи:</label><br>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" 
                            style="width: 100%; padding: 8px; margin-top: 5px;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label>Описание:</label><br>
                        <textarea name="description" style="width: 100%; padding: 8px; margin-top: 5px; height: 100px;">{{ old('description', $task->description) }}</textarea>
                    </div>
                    
                    <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none;">
                        💾 Обновить задачу
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>