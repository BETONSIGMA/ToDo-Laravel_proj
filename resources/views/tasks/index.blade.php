<!DOCTYPE html>
<html>
<head>
    <title>Мои задачи</title>
    <style>
        .completed { text-decoration: line-through; color: #999; }
        .task-item { border: 1px solid #ddd; padding: 10px; margin: 5px 0; }
        .success { background: #d4edda; padding: 10px; margin: 10px 0; }
    </style>
</head>

<form method="GET" action="">
    <div>
        <label>Статус:
            <select name="status_filter" onchange="this.form.submit()">
                <option value="">Все</option>
                <option value="active" {{ request('status_filter') == 'active' ? 'selected' : '' }}>Активные</option>
                <option value="completed" {{ request('status_filter') == 'completed' ? 'selected' : '' }}>Завершенные</option>
            </select>
        </label>
    </div>

    <div>
        <label>Сортировка:
            <select name="date_filter" onchange="this.form.submit()">
                <option value="desc" {{ request('date_filter', 'desc') == 'desc' ? 'selected' : '' }}>Новые сначала</option>
                <option value="asc" {{ request('date_filter') == 'asc' ? 'selected' : '' }}>Старые сначала</option>
            </select>
        </label>
    </div>
</form>

<body>
    <div style="max-width: 800px; margin: 0 auto; padding: 20px;">
        <h1>📋 Мои задачи</h1>
        

        
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('tasks.create') }}" style="background: #007bff; color: white; padding: 10px; text-decoration: none;">
            ➕ Создать новую задачу
        </a>

        <hr style="margin: 20px 0;">

        @if($tasks->count() > 0)
            @foreach($tasks as $task)
                <div class="task-item {{ $task->completed ? 'completed' : '' }}">
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
</body>
</html>