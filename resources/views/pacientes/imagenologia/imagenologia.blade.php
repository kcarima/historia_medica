<x-app-layout>
    @section('contenido')
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Resultados Radioimagenológicos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('css/imagenologia.css') }}" rel="stylesheet" />

    </head>
    <button type="button" class="btn btn-atras" onclick="history.back()">← Atrás</button>

    <body>
        <div class="contenedor-imagenologia">
            <!-- Botón Atrás -->

            <h1>Resultados Radioimagenológicos</h1>

            <label for="tipoResultado" class="label-tipo">Tipo de Resultado</label>
            <select name="tipo_resultado" id="tipoResultado" required>
                <option value="" disabled selected>Selecciona un tipo</option>
                <option value="radiografia">Radiografía</option>
                <option value="tomografia">Tomografía</option>
                <option value="resonancia">Resonancia Magnética</option>
                <option value="ecografia">Ecografía</option>
                <option value="otros">Otros</option>
            </select>

            <label class="label-imagenes">Adjuntar Imágenes</label>
            <button type="button" class="btn-agregar-imagen" id="btnAgregarImagen">Agregar Imagen</button>
            <input type="file" id="imagenes" accept="image/*" multiple style="display:none;" />

            <div class="preview-container" id="previewContainer"></div>

            <div class="botones">
                <button type="button" id="btnEliminar" class="btn eliminar" disabled>Eliminar</button>
                <button type="button" class="btn guardar">Guardar</button>
            </div>
        </div>

        <!-- Modal para mostrar imagen en grande -->
        <div class="modal-img-bg" id="modalImgBg">
            <div class="modal-img-content">
                <button class="modal-img-close" id="modalImgClose" title="Cerrar">×</button>
                <img id="modalImg" src="" alt="Imagen ampliada">
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnAgregarImagen = document.getElementById('btnAgregarImagen');
            const inputImagenes = document.getElementById('imagenes');
            const previewContainer = document.getElementById('previewContainer');
            const tipoResultado = document.getElementById('tipoResultado');
            const btnEliminar = document.getElementById('btnEliminar');
            // Modal
            const modalImgBg = document.getElementById('modalImgBg');
            const modalImg = document.getElementById('modalImg');
            const modalImgClose = document.getElementById('modalImgClose');

            // Almacena objetos File temporales por tipo
            let filesPorTipo = {
                radiografia: [],
                tomografia: [],
                resonancia: [],
                ecografia: [],
                otros: []
            };

            let tipoActual = "";

            tipoResultado.addEventListener('change', function () {
                tipoActual = this.value;
                renderizarImagenes();
            });

            btnAgregarImagen.addEventListener('click', () => {
                if (!tipoResultado.value) {
                    alert("Selecciona un tipo de resultado primero.");
                    return;
                }
                inputImagenes.value = '';
                inputImagenes.click();
            });

            inputImagenes.addEventListener('change', () => {
                if (!tipoActual) return;
                const files = Array.from(inputImagenes.files);
                filesPorTipo[tipoActual].push(...files);
                renderizarImagenes();
            });

            btnEliminar.addEventListener('click', () => {
                if (!tipoActual) return;
                const checks = document.querySelectorAll('.img-check:checked');
                if (checks.length === 0) return;
                // Mensaje de confirmación
                if (!confirm("¿Está seguro que desea eliminar las imágenes seleccionadas?")) return;
                let indices = Array.from(checks).map(chk => parseInt(chk.dataset.idx));
                indices.sort((a, b) => b - a);
                for (let idx of indices) {
                    filesPorTipo[tipoActual].splice(idx, 1);
                }
                renderizarImagenes();
            });

            function renderizarImagenes() {
                previewContainer.innerHTML = '';
                if (!tipoActual || filesPorTipo[tipoActual].length === 0) {
                    btnEliminar.disabled = true;
                    return;
                }
                filesPorTipo[tipoActual].forEach((file, idx) => {
                    if (!file.type.startsWith('image/')) return;
                    const reader = new FileReader();
                    reader.onload = e => {
                        const imgWrapper = document.createElement('div');
                        imgWrapper.classList.add('img-wrapper');

                        // Checkbox
                        const check = document.createElement('input');
                        check.type = 'checkbox';
                        check.classList.add('img-check');
                        check.dataset.idx = idx;

                        // Imagen
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.classList.add('preview-img');
                        img.title = "Haz clic para ampliar";

                        // Abrir modal al hacer clic en la imagen
                        img.addEventListener('click', () => {
                            modalImg.src = img.src;
                            modalImgBg.classList.add('active');
                        });

                        imgWrapper.appendChild(check);
                        imgWrapper.appendChild(img);
                        previewContainer.appendChild(imgWrapper);

                        // Habilita el botón Eliminar si hay alguna seleccionada
                        check.addEventListener('change', function() {
                            const anyChecked = document.querySelectorAll('.img-check:checked').length > 0;
                            btnEliminar.disabled = !anyChecked;
                        });
                    };
                    reader.readAsDataURL(file);
                });
                btnEliminar.disabled = true;
            }

            // Modal: cerrar al hacer clic en la X o fuera de la imagen
            modalImgClose.addEventListener('click', () => {
                modalImgBg.classList.remove('active');
                modalImg.src = "";
            });
            modalImgBg.addEventListener('click', (e) => {
                if (e.target === modalImgBg) {
                    modalImgBg.classList.remove('active');
                    modalImg.src = "";
                }
            });

            // Inicializa en vacío
            tipoResultado.value = "";
            tipoActual = "";
        });
        </script>
    </body>
    </html>
    @endsection
    </x-app-layout>
