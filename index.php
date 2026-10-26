<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <h3 class="card-title text-center text-primary mb-4">Descubra seu Signo</h3>
                    <form id="signo-form" method="POST" action="show_zodiac_sign.php">
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label fw-semibold">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Consultar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html> 