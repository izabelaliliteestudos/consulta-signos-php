<?php 
include('layouts/header.php'); 

$data_nascimento = $_POST['data_nascimento'] ?? null;

if (!$data_nascimento) {
    header("Location: index.php");
    exit();
}

// Carregamento do ficheiro XML
$signos = simplexml_load_file("signos.xml");

// Converte a data informada para o formato MM-DD
$data_user = new DateTime($data_nascimento);
$user_mmdd = $data_user->format('m-d');

$signo_encontrado = null;

foreach ($signos->signo as $signo) {
    list($dia_ini, $mes_ini) = explode('/', (string)$signo->dataInicio);
    list($dia_fim, $mes_fim) = explode('/', (string)$signo->dataFim);

    $inicio_mmdd = sprintf('%02d-%02d', $mes_ini, $dia_ini);
    $fim_mmdd = sprintf('%02d-%02d', $mes_fim, $dia_fim);

    if ($inicio_mmdd <= $fim_mmdd) {
        if ($user_mmdd >= $inicio_mmdd && $user_mmdd <= $fim_mmdd) {
            $signo_encontrado = $signo;
            break;
        }
    } else {
        // Lógica aplicável a períodos que transpõem o ano civil
        if ($user_mmdd >= $inicio_mmdd || $user_mmdd <= $fim_mmdd) {
            $signo_encontrado = $signo;
            break;
        }
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow border-0 text-center">
                <div class="card-body p-5">
                    <?php if ($signo_encontrado): ?>
                        <h1 class="display-4 text-primary fw-bold mb-3"><?= htmlspecialchars($signo_encontrado->signoNome) ?></h1>
                        <p class="lead text-muted mb-4"><?= htmlspecialchars($signo_encontrado->descricao) ?></p>
                    <?php else: ?>
                        <p class="text-danger">Não foi possível determinar o signo correspondente à data informada.</p>
                    <?php endif; ?>
                    <a href="index.php" class="btn btn-outline-primary mt-3">Voltar à Página Inicial</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>