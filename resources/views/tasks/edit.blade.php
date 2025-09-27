<!DOCTYPE html>
<html>
<head>
    <title>Редактировать задачу</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1>✏️ Редактировать задачу</h1>
        
        <a href="{{ route('tasks.index') }}" style="display: inline-block; margin-bottom: 20px;">← Назад к списку</a>

        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0;">
                <ul>
                    @foreach($errors->any() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
</body>
</html>