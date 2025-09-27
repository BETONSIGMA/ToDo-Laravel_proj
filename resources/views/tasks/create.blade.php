<!DOCTYPE html>
<html>
<head>
    <title>Создать задачу</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1>📝 Создать новую задачу</h1>
        
        <a href="{{ route('tasks.index') }}" style="display: inline-block; margin-bottom: 20px;">← Назад к списку</a>

        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label>Название задачи:</label><br>
                <input type="text" name="title" value="{{ old('title') }}" 
                       style="width: 100%; padding: 8px; margin-top: 5px;" 
                       placeholder="Что нужно сделать?">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label>Описание:</label><br>
                <textarea name="description" style="width: 100%; padding: 8px; margin-top: 5px; height: 100px;" 
                          placeholder="Подробное описание (необязательно)">{{ old('description') }}</textarea>
            </div>
            
            <button type="submit" style="background: #28a745; color: white; padding: 10px 20px; border: none;">
                💾 Сохранить задачу
            </button>
        </form>
    </div>
</body>
</html>