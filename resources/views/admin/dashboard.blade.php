<h1>Halaman Admin</h1>
<p>Selamat datang, {{ auth()->user()->name }} (Role: {{ auth()->user()->role }})</p>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">Logout</button>
</form>
