</body>

</html>
<script src="<?= base_url() ?>/assets/js/<?= $javascript ?>.js"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>


<?php if (isset($_SESSION['error'])): ?>
    <?php $error = $_SESSION['error']; unset($_SESSION['error']); ?>

    <!-- Modal Tailwind CSS -->
    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 animate-fadeIn">
            <h2 class="text-xl font-semibold text-red-600 mb-4">Erro</h2>
            <p class="text-gray-700 mb-6"><?= htmlspecialchars($error) ?></p>
            <div class="flex justify-end">
                <button onclick="closeModal()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <script>
    function closeModal() {
        document.getElementById('errorModal').style.display = 'none';
    }
    </script>
<?php endif; ?>