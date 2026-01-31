<!-- resources/views/products/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('product.store') }}">
        @csrf <!-- CSRF Token for security -->

        <div>
            <label for="name">Product Name:</label>
            <input type="text"  name="name" required>
        </div>

        <div>
            <label for="detail">Detail:</label>
            <textarea id="detail" name="detail" required></textarea>
        </div>

        <!-- The Save Button -->
        <button type="submit">Save to MySQL</button>
    </form>
</body>
</html>
