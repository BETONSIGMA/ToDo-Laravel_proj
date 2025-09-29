<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Мои задачи
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Сообщения об успехе -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Форма фильтрации -->
            <div style="background: #f8f9fa; padding: 20px; margin: 20px 0; border-radius: 8px; border: 1px solid #dee2e6;">
                <form method="GET" action="{{ route('tasks.index') }}">
                    <div style="display: flex; gap: 20px; align-items: end; flex-wrap: wrap;">
                        
                        <!-- Фильтр по статусу -->
                        <div>
                            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Статус задачи:</label>
                            <select name="status_filter" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                <option value="">Все задачи</option>
                                <option value="active" {{ request('status_filter') == 'active' ? 'selected' : '' }}>Активные</option>
                                <option value="completed" {{ request('status_filter') == 'completed' ? 'selected' : '' }}>Выполненные</option>
                            </select>
                        </div>

                        <!-- Сортировка по дате -->
                        <div>
                            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Сортировка по дате:</label>
                            <select name="date_filter" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                <option value="desc" {{ request('date_filter', 'desc') == 'desc' ? 'selected' : '' }}>Новые сверху</option>
                                <option value="asc" {{ request('date_filter') == 'asc' ? 'selected' : '' }}>Старые сверху</option>
                            </select>
                        </div>

                        <!-- Кнопка сброса -->
                        <a href="{{ route('tasks.index') }}" style="background: #6c757d; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">
                            Сбросить
                        </a>
                    </div>
                </form>
            </div>

            <!-- Основной контент -->
            <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
                
                <a href="{{ route('tasks.create') }}" style="background: #007bff; color: white; padding: 10px; text-decoration: none; display: inline-block; margin-bottom: 20px;">
                    ➕ Создать новую задачу
                </a>

                <hr style="margin: 20px 0;">

                @if($tasks->count() > 0)
                    @foreach($tasks as $task)
                        <div class="task-item {{ $task->completed ? 'completed' : '' }}" style="border: 1px solid #ddd; padding: 10px; margin: 5px 0;">
                            <h3>{{ $task->title }}</h3>
                            @if($task->description)
                                <p>{{ $task->description }}</p>
                            @endif
                            
                            <small>Создано: {{ $task->created_at->format('d.m.Y H:i') }}</small>
                            
                            <div style="margin-top: 10px;">
                                <!-- Статус -->
                                <form action="{{ route('tasks.toggle', $task) }}" method="POST" style="display: inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit">
                                        {{ $task->completed ? '❌ Отметить невыполненной' : '✅ Отметить выполненной' }}
                                    </button>
                                </form>
                                
                                <!-- Редактировать -->
                                <a href="{{ route('tasks.edit', $task) }}" style="margin: 0 10px;">✏️ Редактировать</a>
                                
                                <!-- Удалить -->
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить задачу?')">🗑️ Удалить</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>🎉 У вас пока нет задач! Создайте первую.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>