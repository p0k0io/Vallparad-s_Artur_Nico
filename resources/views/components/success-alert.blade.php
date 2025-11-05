<script>
    document.addEventListener('DOMContentLoaded', () => {
        const alertBox = document.getElementById('success-alert');

        if (alertBox) {
            setTimeout(() => {
                alertBox.remove();
            }, 3000); 
        }
    });
</script>

<div class="fixed bottom-5 right-5 z-50 flex items-center justify-center">
    <div 
        id="success-alert"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-full relative shadow-lg"
        role="alert"
    >
        <span class="block sm:inline">{{$slot}}</span>
    </div>
</div>
