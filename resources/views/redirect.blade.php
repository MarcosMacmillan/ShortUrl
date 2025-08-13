{{-- resources/views/redirect.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting...</title>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let countdown = 3;
            const counterEl = document.getElementById('counter');

            const timer = setInterval(() => {
                countdown--;
                counterEl.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(timer);
                    window.location.href = "{{ $finalUrl }}";
                }
            }, 1000);
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-900 text-white">
    <div class="text-center">
        <h1 class="text-3xl font-bold mb-4">We are taking you to the destination...</h1>
        <p class="mb-6">Wait <span id="counter">3</span> seconds</p>
        <div class="w-12 h-12 border-4 border-white border-t-transparent rounded-full animate-spin mx-auto"></div>
    </div>
</body>
</html>
