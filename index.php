<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job postings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
        <h1>Job postings</h1>
        <div class="job-list">
            <!-- Incluimos el componente que parsea y renderiza las ofertas
                 proporcionadas en el feed XML -->
            <?php include("parse_jobs.php"); ?>
        </div>
    </div>
    <script>
        // Funcionalidad para mostrar y ocultar los detalles de cada oferta
        document.querySelectorAll('.detail').forEach(function(detailElement) {
            var anchor = detailElement.querySelector('.detail-anchor');
            
            anchor.addEventListener('click', function(ev) {
                ev.preventDefault();
                var content = detailElement.querySelector('.detail-content');
                content.classList.toggle('hidden');

                var indicators = detailElement.querySelectorAll('.detail-indicator');
                indicators.forEach(function(indicator) {
                    indicator.classList.toggle('hidden');
                })
            })
        });
    </script>
</body>
</html>

