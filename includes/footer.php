
            </div>
        <script>
            document.querySelector(".logout-form").addEventListener("submit", function (event) {
                event.preventDefault();
                const sair = confirm("Tens a certeza que queres terminar sessão?");
                if (sair) {
                    this.submit();
                }
            });
            function toggleSidebar() {
                document.getElementById("sidebar").classList.toggle("open");
                document.getElementById("overlay").classList.toggle("open");
            }
        </script>
        <script src="/gabnet-system/assets/js/functions.js"></script>
            <?php if (!empty($js_extra)): ?>
                <?php foreach ($js_extra as $js):?>
                    <script src="/gabnet-system/assets/js/<?= htmlspecialchars($js) ?>"></script>
                <?php endforeach;?>
            <?php endif; ?>
    </body>
</html>