  <header class="site-header">
    <nav class="nav-container">
      <a href="/" class="brand">
        <img src="images/AAULogo.png" alt="AAU" class="brand-logo">
        <span class="brand-title">AAU Clubs Platform</span>
      </a>
      <ul class="nav-menu">
        <li><a href="/">Home</a></li>
        <li><a href="/clubs" class="active">Clubs</a></li>
        <li><a href="/key-dates">Key Dates</a></li>
        <li><a href="/contact">Contact</a></li>
        
        <?php if($_SESSION['user'] ?? false): ?>
            <li><a href="/admin">Admin Panel</a></li>
            <li><form method="POST" action="/logout" class="">
                <input type="hidden" name="_method" value="DELETE">
                
                    <button >Logout</button>
                
            </form></li>
        <?php else: ?>
            <li><a href="/register" class="<?=urlIs('/register') ? 'bg-red-300 text-white' : 'text-white-400' ?> hover:text-gray-200 hover:underline hover:bg-blue-700 px-4 py-3 rounded-md">Register</a></li>
            <li><a href="/login" class="<?=urlIs('/login') ? 'bg-red-300 text-white' : 'text-white-400' ?> hover:text-gray-200 hover:underline hover:bg-blue-700 px-4 py-3 rounded-md">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
